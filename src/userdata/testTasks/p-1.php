<?php
//php C:\OSPanel\domains\x-site.web\src\userdata\testTasks\p-1.php 2025

$year = 2020;
if(isset($argv[1]) and !empty($argv[1])){
    $year = intval($argv[1]);
}else{
    echo "error: argument 'year' didnt pass params or not correct\n";
    exit;
}

$startDate = strtotime('2020-01-01 12:00');
$finalDate = strtotime($year.'-01-01 00:00');

if($finalDate<=$startDate){
    echo "error: argument 'year' cant be less 2020, passed ".$year."\n";
    exit;
}

//time zone MSK
$startTimeZone = 3;

//cross 3 time zones
$offSetZone = 3;
$offSetZone_s = $offSetZone*60*60;

//2 hours in flight
$flightTime = 2*60*60;

//6 hours after landing
$restTime = 6*60*60;

//local airman's time zone
$curZone = $startTimeZone;

//local airman's time
$localTime = $startDate;

//flight cycles counter
$count_c = 0;

//increment $localTime counter making flights
//calc time zone and local time
while ($localTime < $finalDate){
    $localTime += $flightTime - $offSetZone_s;
    $curZone = $curZone - $offSetZone;

    //reset time zone when cross 0 meridian
    if($curZone < -12){
        $curZone = $curZone + 24;
    }

    if($localTime >= $finalDate){
        echo 'meet in flight'."\n";
    }
    $localTime += $restTime;

    if($localTime >= $finalDate){
        echo 'meet when landed: localTime='.date('Y-m-d H:i:s', $localTime).' final date='.date('Y-m-d H:i:s', $finalDate)."\n";
    }
    $count_c++;
}

echo 'finalTimeZone = '.$curZone."\n";
echo 'count flight cycles = '.$count_c."\n";

echo 'time_in_Moscow: '.date('Y-m-d H:i:s',($finalDate - ($curZone-$startTimeZone)*60*60));
