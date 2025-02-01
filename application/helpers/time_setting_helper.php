<?php



if (!function_exists('generateTimeSlots')) {
    function generateTimeSlots($startTime, $endTime, $intervalHours) {
        $slots = [];
        $start = strtotime($startTime);
        $end = strtotime($endTime);
        $interval = $intervalHours * 3600; // Convert hours to seconds

        while ($start < $end) {
            $slotStart = date('H:i', $start);
            $slotEnd = date('H:i', $start + $interval);

            if (strtotime($slotEnd) > $end) {
                break;
            }

            $slots[] = "{$slotStart}-{$slotEnd}";
            $start += $interval;
        }

        // Add the leftover slot if any time remains
        if ($start < $end) {
            $slotStart = date('H:i', $start);
            $slotEnd = date('H:i', $end);
            $slots[] = "{$slotStart}-{$slotEnd}";
        }

        return $slots;
    }
}



?>