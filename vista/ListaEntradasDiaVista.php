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
        <div align="center">
            <table>
                <thead>
                    <tr>
                        <th colspan="3" align="left"><a href="?c=Agenda&a=Index">Volver al calendario</a></th>
                        <th colspan="2"><a href="?c=Agenda&a=Crear&fecha=<?php echo $fecha ?>">Nueva entrada</a></th>
                    </tr>
                    <?php 
                        if(sizeof($listaEntradas) > 0)
                        {
                    ?>
                    <tr>
                        <th>Fecha</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th colspan="2" align="center"></th>
                    </tr>
                    <?php
                        }    
                    ?>
                </thead>
                <tbody>
                    <?php 
                        if(sizeof($listaEntradas) > 0)
                        {
                            foreach($listaEntradas as $entrada)
                            {
                    ?>
                    <tr>
                        <td><?php echo $entrada->fecha; ?></td>
                        <td><?php echo $entrada->titulo; ?></td>
                        <td><?php echo $entrada->descripcion; ?></td>
                        <td>
                            <a href="?c=Agenda&a=Editar&id=<?php echo $entrada->id; ?>">Editar</a>
                        </td>
                        <td>
                            <a href="?c=Agenda&a=Borrar&id=<?php echo $entrada->id; ?>&fecha=<?php echo $entrada->fecha; ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php 
                            }
                        }
                        else
                        {
                            echo "<tr><td>No hay pendientes el dia de hoy</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>