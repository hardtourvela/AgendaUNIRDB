<?php 
    /*
    Nombre: Oscar Arturo Vela Silva
    Profesor: Octavio Aguirre Lozano
    Materia: Computacion en el Servidor WEB
    Actividad: Laboratorio #1 Manejo de datos en el servidor e interacción con el cliente mediante una aplicación web
    */
    class Agenda
    {
        private $weekDays = array('Domingo', 'Lunes', 'Martes','Miércoles','Jueves','Viernes','Sábado');
        private $monthYear;
        private $firstDayMonthTs;
        private $weekStart;
        private $entryPageDestination;

        public $selectedDate;

        public function __construct($date, $page) {
            $this->entryPageDestination = $page;

            $dateTs = strtotime($date);
            $this->SetSelectedDate(date("Y",$dateTs), date("m",$dateTs), date("j",$dateTs));
        }

        public function GetSelectedDate()
        {
            return $this->selectedDate;
        }

        public function SetSelectedDate($yearInNumber, $monthInNumber, $dayInNumber)
        {
            $this->selectedDate = "$yearInNumber-$monthInNumber-$dayInNumber";
            $this->monthYear = "$yearInNumber-$monthInNumber";
            $this->firstDayMonthTs = strtotime($this->monthYear . "-1");
            $this->weekStart = date("w", $this->firstDayMonthTs);
        }

        public function RenderCalendar()
        {
            echo '<table>';
            $this->RenderCalendarHeader();
            $this->RenderCalendarBody();
            echo '</table>';
        }

        private function RenderCalendarHeader(){
            echo '<thead>
                    <tr>
                        <th colspan="7">' . ucfirst(strftime('%B %Y', $this->firstDayMonthTs)) . '</th>
                    </tr>
                    <tr>';
                    for($i = 0;$i < 7;$i++){
                        echo '<th>' .  $this->weekDays[$i] . '</th>'; 
                    } 
            echo   '</tr>
                </thead>';
        }

        private function RenderCalendarBody(){
            $renderStarted = false;
            $dayCounter = 1;
            $daysLeftToRender = date("t", $this->firstDayMonthTs);
            echo '<tbody>';
                        while($daysLeftToRender > 0){
                            echo '<tr>';
                            for($i = 0;$i < 7;$i++)
                            {
                                $selectedDateClass = "";

                                if($this->weekStart == $i)
                                    $renderStarted = true;

                                if(($this->monthYear . "-$dayCounter") == $this->GetSelectedDate() and $renderStarted === true)
                                    $selectedDateClass = ' class="selectedDate"';

                                echo "<td$selectedDateClass>";

                                if($daysLeftToRender > 0 and $renderStarted === true){
                                    $daysLeftToRender--;

                                    echo "<div class=\"dayHeader\">$dayCounter</div>";
                                    echo "<div class=\"dayBody\"><a href=\"" . sprintf($this->entryPageDestination, $this->monthYear . "-$dayCounter") . "\">Ir a fecha</a></div>";
                                    $dayCounter++;
                                }
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
            echo '</tbody>';
        }
    }
?>