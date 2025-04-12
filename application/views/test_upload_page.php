<?php
$log_file = "/var/www/html/itlib/avmsystem-new/debug_log.txt"; // Ensure this path is correct

function log_debug($message) {
    global $log_file;
    if (!empty($log_file)) {
        file_put_contents($log_file, "[" . date("Y-m-d H:i:s") . "] " . $message . PHP_EOL, FILE_APPEND);
    } else {
        echo "Error: Log file path is empty!";
    }
}

$file_path = "/var/www/html/itlib/avmsystem-new/public/assets/img/service_img/9998.jpg";

// Check if file exists before attempting to delete
if (!file_exists($file_path)) {
    log_debug("File not found: $file_path");
    echo "Error: File does not exist.";
    exit;
}

// Check current permissions
$permissions = substr(sprintf('%o', fileperms($file_path)), -4);
log_debug("Current permissions for $file_path: $permissions");

// Attempt to change permissions (if necessary)
if (!chmod($file_path, 0777)) {
    log_debug("Failed to change permissions to 0777.");
} else {
    log_debug("Changed permissions to 0777.");
}

// Attempt to delete with unlink()
if (unlink($file_path)) {
    log_debug("Successfully deleted: $file_path");
    echo "File deleted successfully.";
} else {
    log_debug("unlink() failed. Trying exec()...");
    
    // Try using exec() as fallback
    $output = shell_exec("rm -f " . escapeshellarg($file_path) . " 2>&1");
    
    if (file_exists($file_path)) {
        log_debug("exec() failed: $output");
        echo "Error: Could not delete the file.";
    } else {
        log_debug("exec() succeeded.");
        echo "File deleted using exec().";
    }
}

// Ensure folder permissions after deletion
$folder_path = dirname($file_path);
chmod($folder_path, 0755);
log_debug("Restored folder permissions to 0755.");
?>
    