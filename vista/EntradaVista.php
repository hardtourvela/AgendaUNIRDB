<!--
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
-->
<!DOCTYPE>
<html>
    <head>
    </head>
    <body>
        <form action="?c=Agenda&a=<?php echo $accion; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $entrada->id; ?>" />
            <div align="center">
                <table>
                    <tr>
                        <td>Fecha</td><td><input type="datetime-local" required name="fecha" value="<?php echo date('Y-m-d\TH:i:s',strtotime($entrada->fecha)); ?>" /></td>
                    </tr>
                    <tr>
                        <td>Titulo</td><td><input type="text" required name="titulo" value="<?php echo $entrada->titulo; ?>"/></td>
                    </tr>
                    <tr>
                        <td>Descripcion</td><td><textarea name="descripcion"><?php echo $entrada->descripcion; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="<?php echo $accion; ?>"/></td>
                        <td><a href="?c=Agenda&a=ListarAgendaDelDia&fecha=<?php echo $entrada->fecha; ?>">Cancelar</a></td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>