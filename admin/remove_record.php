<?php
require 'conn.php';

if (isset($_POST['store_id'])) {
    $store_id = $_POST['store_id'];

    // Perform the removal operation from the 'storage' table
    $query1 = "DELETE FROM `storage` WHERE `store_id` = '$store_id'";
    
    // Perform the removal operation from the 'storage2' table
    $query2 = "DELETE FROM `storage2` WHERE `store_id` = '$store_id'";

    $success = true; // Variable to track overall success

    // Execute the first query for storage
    if (!mysqli_query($conn, $query1)) {
        echo "Error removing record from storage: " . mysqli_error($conn);
        $success = false; // Update success status
    }

    // Execute the second query for storage2
    if (!mysqli_query($conn, $query2)) {
        echo "Error removing record from storage2: " . mysqli_error($conn);
        $success = false; // Update success status
    }

    if ($success) {
        echo "Record removed successfully from both tables.";
    }
}
?>
