<?php
$date_1='2018-01-04';
$time_1='14:05:00';
$date_2='2018-01-08';
$time_2='16:20:00';

$TotalFlight_Time=convert_DateTime_to_Hour($date_1,$time_1,$date_2,$time_2);
echo 'result='.$TotalFlight_Time;

function convert_DateTime_to_Hour($date_1,$time_1,$date_2,$time_2){
    $date_1_num=DateToTimeStamp($date_1.' '.$time_1);
    $date_2_num=DateToTimeStamp($date_2.' '.$time_2);
    $TotalFlight_TimeStamp=bcsub($date_2_num,$date_1_num);
    $TotalFlight_Time= TimeStamp_to_Time($TotalFlight_TimeStamp);
    $TotalFlight_Time_array=explode(':',$TotalFlight_Time);
    $TotalFlight_Time_array[0]=$TotalFlight_Time_array[0].'h';
    if($TotalFlight_Time_array[1]>'0'){
        if($TotalFlight_Time_array[1]<10){
            $TotalFlight_Time_array[1]=':0'.$TotalFlight_Time_array[1].'m';
        }else{
            $TotalFlight_Time_array[1]=':'.$TotalFlight_Time_array[1].'m';
        }
    }else{
        $TotalFlight_Time_array[1]='';
    }
    return $TotalFlight_Time_array[0].$TotalFlight_Time_array[1];
}
function DateToTimeStamp($OriginalDate,$TimeZone='Asia/Tehran')
{
    /**
     *  function description:
     *      get date example    2017-10-17 03:40:00
     *      return  TimeStamp   1508199000
     */
    if($OriginalDate!=''){
        date_default_timezone_set($TimeZone);
        $OutPutDate=new DateTime($OriginalDate);
        return $OutPutDate->getTimestamp();
    }
    else{
        return 0;
    }
}
function TimeStamp_to_Time($TimeStamp)
{
    /**
     *  function description:
     *      get TimeStamp   example    1508199000
     *      return          Time        23:45
     */
    $hours=$TimeStamp/3600;
    $minutes=($TimeStamp%3600)/60;
    return intval($hours).':'.intval($minutes);
}