<?php



if (!function_exists('getDay')) {
     function getDay($date) {
         // Parse the input date using DateTime
         $dateTime = new DateTime($date);
 
         // Format the date as 'Y-m-d'
         $formattedDate = $dateTime->format('Y-m-d');
 
         // Get the day name using 'l' for the full day name (e.g., "Sunday")
         $day = date('l', strtotime($formattedDate));
 
         return $day;
     }
 }



?>