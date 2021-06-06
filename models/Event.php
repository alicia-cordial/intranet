<?php

/* 
 * Generate event calendar in HTML format 
 */ 
function getCalender($year = '', $month = ''){ 
    $dateYear = ($year != '')?$year:date("Y"); 
    $dateMonth = ($month != '')?$month:date("m"); 
    $date = $dateYear.'-'.$dateMonth.'-01'; 
    $currentMonthFirstDay = date("N",strtotime($date)); 
    $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear); 
    $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 1)?($totalDaysOfMonth):($totalDaysOfMonth + ($currentMonthFirstDay - 1)); 
    $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42; 
     
    $prevMonth = date("m", strtotime('-1 month', strtotime($date))); 
    $prevYear = date("Y", strtotime('-1 month', strtotime($date))); 
    $totalDaysOfMonth_Prev = cal_days_in_month(CAL_GREGORIAN, $prevMonth, $prevYear); 
}


/* 
 * Generate months options list for select box 
 */ 
function getMonthList($selected = ''){ 
    $options = ''; 
    for($i=1;$i<=12;$i++) 
    { 
        $value = ($i < 10)?'0'.$i:$i; 
        $selectedOpt = ($value == $selected)?'selected':''; 
        $options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>'; 
    } 
    return $options; 
} 
 
/* 
 * Generate years options list for select box 
 */ 
function getYearList($selected = ''){ 
    $yearInit = !empty($selected)?$selected:date("Y"); 
    $yearPrev = ($yearInit - 5); 
    $yearNext = ($yearInit + 5); 
    $options = ''; 
    for($i=$yearPrev;$i<=$yearNext;$i++){ 
        $selectedOpt = ($i == $selected)?'selected':''; 
        $options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>'; 
    } 
    return $options; 
} 
 
/* 
 * Generate events list in HTML format 
 */ 
function getEvents($date = ''){ 
    $date = $date?$date:date("Y-m-d"); 
     
    $eventListHTML = '<h2 class="sidebar__heading">'.date("l", strtotime($date)).'<br>'.date("F d", strtotime($date)).'</h2>'; 
     
    // Fetch events based on the specific date 
    global $db; 
    $result = $db->query("SELECT title FROM events WHERE date = '".$date."' AND status = 1"); 
    if($result->num_rows > 0){ 
        $eventListHTML .= '<ul class="sidebar__list">'; 
        $eventListHTML .= '<li class="sidebar__list-item sidebar__list-item--complete">Events</li>'; 
        $i=0; 
        while($row = $result->fetch_assoc()){ $i++; 
            $eventListHTML .= '<li class="sidebar__list-item"><span class="list-item__time">'.$i.'.</span>'.$row['title'].'</li>'; 
        } 
        $eventListHTML .= '</ul>'; 
    } 
    echo $eventListHTML; 
}