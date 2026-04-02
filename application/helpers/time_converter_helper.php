<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      
    if ( ! function_exists('time_converter'))
    {
        function timeToMillis($time){        
            $oneHoursMillis = 3600000; //3.600.000
            $oneMinutesMillis = 60000; //60.000
            $oneSecondsMillis = 1000; //1000
    
            $result = 0;
            $explode = explode(':',$time);
            
            if(count((array)$explode) >= 3){
                $hours = $explode[0];
                $minutes = $explode[1];
                $seconds = $explode[2];
    
                $hoursToMillis = $hours * $oneHoursMillis;
                $minutesToMillis = $minutes * $oneMinutesMillis;
                $secondsToMillis = $seconds * $oneSecondsMillis;
    
                $totalMillis = $hoursToMillis + $minutesToMillis + $secondsToMillis;
    
                $result = $totalMillis;
            }
    
            return $result;
        }
    }

    if ( ! function_exists('millis_to_time'))
    {
        function millis_to_time($ms, $seconds = false){
            $total_seconds = ($ms / 1000);
    
            if($seconds){
                return $total_seconds;
            }else{
                $time = '';
                $value = array(
                    'hours' => 00,
                    'minutes' => 00,
                    'seconds' => 00
                );
    
                if($total_seconds >= 3600){
                    $totalHours = 24;
                    $value['hours'] = floor($total_seconds / 3600);
                    $total_seconds = $total_seconds % 3600;
                    $value['hours'] = ($value['hours'] >= 24) ? $value['hours'] % $totalHours : $value['hours'];
                    $value['hours'] = ($value['hours'] <= 9) ? "0".$value['hours'] : $value['hours'];
    
                    $time .= $value['hours'] . ':';
                }else{
                    $time .= '00:';
                }
    
                if($total_seconds >= 60){
                    $totalMinutes = 60;
                    $value['minutes'] = floor($total_seconds / 60);
                    $value['minutes'] = ($value['minutes'] >= 60) ? $value['minutes'] % $totalMinutes : $value['minutes'];
                    $value['minutes'] = ($value['minutes'] <= 9) ? "0".$value['minutes'] : $value['minutes'];
                    $total_seconds = $total_seconds % 60;
    
                    $time .= $value['minutes'] . ':';
                }else{
                    $time .= '00:';
                }
    
                $totalSeconds = 60;
                $value['seconds'] = floor($total_seconds);
                $value['seconds'] = ($value['seconds'] >= 60) ? $value['seconds'] % $totalSeconds : $value['seconds'];
    
                if($value['seconds'] <= 0){
                    $value['seconds'] = "00";
                }else if($value['seconds'] < 10){
                    $value['seconds'] = '0' . $value['seconds'];
                }
    
                $time .= $value['seconds'];
    
                return $time;
            }
        }
    }

    if ( ! function_exists('millis_to_minutes'))
    {
        function millis_to_minutes($millis){
            $oneMinutesMillis = 60000; //60.000
            $result = $millis * $oneMinutesMillis;
    
            return $result;
        }
    }

    if ( ! function_exists('hours_to_millis'))
    {
        function hours_to_millis($hours){
            $oneHoursMillis = 3600000; //3.600.000
            $result = $hours * $oneHoursMillis;
    
            return $result;
        }
    }

    if ( ! function_exists('millis_to_days'))
    {
        function millis_to_days($millis){
            $seconds = $millis/1000;
            $result = floor($seconds / (24*60*60));
    
            return $result;
        }
    }

    if ( ! function_exists('time_to_millis'))
    {
        function time_to_millis($time){        
            $oneHoursMillis = 3600000; //3.600.000
            $oneMinutesMillis = 60000; //60.000
            $oneSecondsMillis = 1000; //1000
    
            $result = 0;
            $explode = explode(':',$time);
            
            if(count((array)$explode) >= 3){
                $hours = $explode[0];
                $minutes = $explode[1];
                $seconds = $explode[2];
    
                $hoursToMillis = $hours * $oneHoursMillis;
                $minutesToMillis = $minutes * $oneMinutesMillis;
                $secondsToMillis = $seconds * $oneSecondsMillis;
    
                $totalMillis = $hoursToMillis + $minutesToMillis + $secondsToMillis;
    
                $result = $totalMillis;
            }
    
            return $result;
        }
    }