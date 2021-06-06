<?php



/* 
 * Load function based on the Ajax request 
 */ 
if(isset($_POST['func']) && !empty($_POST['func'])){ 
    switch($_POST['func']){ 
        case 'getCalender': 
            getCalender($_POST['year'],$_POST['month']); 
            break; 
        case 'getEvents': 
            getEvents($_POST['date']); 
            break; 
        default: 
            break; 
    } 
} 


$dayCount = 1; 
$eventNum = 0; 
 
echo '<section class="calendar__week">'; 
for($cb=1;$cb<=$boxDisplay;$cb++){ 
    if(($cb >= $currentMonthFirstDay || $currentMonthFirstDay == 1) && $cb <= ($totalDaysOfMonthDisplay)){ 
        // Current date 
        $currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount; 
         
        // Get number of events based on the current date 
        global $db; 
        $result = $db->query("SELECT title FROM events WHERE date = '".$currentDate."' AND status = 1"); 
        $eventNum = $result->num_rows; 
         
        // Define date cell color 
        if(strtotime($currentDate) == strtotime(date("Y-m-d"))){ 
            echo ' 
                <div class="calendar__day today" onclick="getEvents(\''.$currentDate.'\');"> 
                    <span class="calendar__date">'.$dayCount.'</span> 
                    <span class="calendar__task calendar__task--today">'.$eventNum.' Events</span> 
                </div> 
            '; 
        }elseif($eventNum > 0){ 
            echo ' 
                <div class="calendar__day event" onclick="getEvents(\''.$currentDate.'\');"> 
                    <span class="calendar__date">'.$dayCount.'</span> 
                    <span class="calendar__task">'.$eventNum.' Events</span> 
                </div> 
            '; 
        }else{ 
            echo ' 
                <div class="calendar__day no-event" onclick="getEvents(\''.$currentDate.'\');"> 
                    <span class="calendar__date">'.$dayCount.'</span> 
                    <span class="calendar__task">'.$eventNum.' Events</span> 
                </div> 
            '; 
        } 
        $dayCount++; 
    }else{ 
        if($cb < $currentMonthFirstDay){ 
            $inactiveCalendarDay = ((($totalDaysOfMonth_Prev-$currentMonthFirstDay)+1)+$cb); 
            $inactiveLabel = 'expired'; 
        }else{ 
            $inactiveCalendarDay = ($cb-$totalDaysOfMonthDisplay); 
            $inactiveLabel = 'upcoming'; 
        } 
        echo ' 
            <div class="calendar__day inactive"> 
                <span class="calendar__date">'.$inactiveCalendarDay.'</span> 
                <span class="calendar__task">'.$inactiveLabel.'</span> 
            </div> 
        '; 
    } 
    echo ($cb%7 == 0 && $cb != $boxDisplay)?'</section><section class="calendar__week">':''; 
} 
echo '</section>'; 