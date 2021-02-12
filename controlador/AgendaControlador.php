<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    require_once 'modelo/EntradaAgenda.php';
    require_once 'controlador/interfaces/iControladorBase.php';
    require_once 'repositorios/interfaces/iRepositorioEntradas.php';
    class AgendaControlador implements iControladorBase
    {
        private $repositorioEntradas;
        
        public function __construct($iRepositorioEntradas)
        {
            $this->repositorioEntradas = $iRepositorioEntradas;
        }

        public function Index()
        {
            require_once 'herramientas/Agenda.php';
            $calendarioControl = new Agenda(date("j-m-Y"),"?c=Agenda&a=ListarAgendaDelDia&fecha=%s");
            require_once 'vista/AgendaVista.php';
        }

        public function ListarAgendaDelDia()
        {
            $fecha = date('Y-m-j');
            if(isset($_REQUEST['fecha']))
                $fecha = date('Y-m-j',strtotime($_REQUEST['fecha']));
            
            $listaEntradas = $this->repositorioEntradas->ObtenerEntradasDia($fecha);
            require_once 'vista/ListaEntradasDiaVista.php';
        }

        public function Crear()
        {
            if(
                isset($_REQUEST["fecha"]) &&
                isset($_REQUEST["titulo"]) &&
                isset($_REQUEST["descripcion"])
              )
            {
                $entrada = new EntradaAgenda();
                $entrada->fecha = $_REQUEST["fecha"];
                $entrada->titulo = $_REQUEST["titulo"];
                $entrada->descripcion = $_REQUEST["descripcion"];

                $this->repositorioEntradas->Crear($entrada);

                $this->ListarAgendaDelDia();    
            }
            else if(isset($_REQUEST["fecha"]))
            {
                $accion = "Crear";
                $entrada = new EntradaAgenda();
                $entrada->fecha = $_REQUEST["fecha"];
                require_once 'vista/EntradaVista.php';
            }
            else
            {
                $this->Index();
            }
        }

        public function Editar()
        {
            if(
                isset($_REQUEST["id"]) &&
                isset($_REQUEST["fecha"]) &&
                isset($_REQUEST["titulo"]) &&
                isset($_REQUEST["descripcion"])
                )
            {
                $entradaAActualizar = new EntradaAgenda();
                $entradaAActualizar->id = $_REQUEST["id"];
                $entradaAActualizar->fecha = $_REQUEST["fecha"];
                $entradaAActualizar->titulo = $_REQUEST["titulo"];
                $entradaAActualizar->descripcion = $_REQUEST["descripcion"];
                $this->repositorioEntradas->Actualizar($entradaAActualizar);
                $this->ListarAgendaDelDia();
            }
            else if(isset($_REQUEST["id"]))
            {
                $entrada = $this->repositorioEntradas->Obtener($_REQUEST["id"]);
                $accion = "Editar";
                require_once 'vista/EntradaVista.php';
            }
            else
            {
                $this->Index();
            }
        }

        public function Borrar()
        {
            if(isset($_REQUEST["id"]))
            {
                $this->repositorioEntradas->Eliminar($_REQUEST["id"]);
            }
            
            $this->ListarAgendaDelDia();
        }
    }
?>