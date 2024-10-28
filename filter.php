<?php
// Function to filter input securely
function filter_input_data($data) {
    $data = trim($data);                  // Remove spaces
    $data = stripslashes($data);          // Remove backslashes
    $data = htmlspecialchars($data);      // Prevent HTML injection
    return $data;
}
?>
