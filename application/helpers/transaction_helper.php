<?php



if (!function_exists('transaction')) {
     function transaction($db,$statement1,$statement2) {
         // Parse the input date using DateTime
        // Start Transaction //
        $db->trans_start(); // Start transaction

        $result1 = $statement1;
        $result2 = $statement2;

        $db->trans_complete(); // Complete the transaction
        if ($db->trans_status() === FALSE) {
            // Transaction failed, rollback
            $db->trans_rollback();
        } else {
            // Transaction successful, commit
            $db->trans_commit();
        }
        return $result1 && $result2;
        // End Transaction //
     }
 }



?>