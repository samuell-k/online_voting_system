<?php
require_once 'conn.php';

if (isset($_POST['submit'])) {
    $stud_no = 11;
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_temp = $_FILES['file']['tmp_name'];
    $location = "files/" . $stud_no . "/" . $file_name;
    $date = date("Y-m-d H:i:s", strtotime("+8 HOURS")); // Corrected date format

    // Create directory if it doesn't exist
    $dir = "files/" . $stud_no;
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true); // Make sure to set permissions and create nested directories
    }

    // Move the uploaded file
    if (move_uploaded_file($file_temp, $location)) {
        // // Insert into the first database table
        // $insert1 = mysqli_query($conn, "INSERT INTO `storage` (filename, file_type, date_uploaded, stud_no) VALUES ('$file_name', '$file_type', '$date', '$stud_no')");
        
        // // Check if the first insert was successful
        // if ($insert1) {
            // Insert into the second database table
            $insert2 = mysqli_query($conn, "INSERT INTO `storage2` (filename, file_type, date_uploaded, stud_no) VALUES ('$file_name', '$file_type', '$date', '$stud_no')");
            
            // Check if the second insert was successful
            if ($insert2) {
                header('Location: admin_file.php'); // Redirect on success
                exit(); // Ensure script termination after redirection
            } else {
                die("Second database insert failed: " . mysqli_error($conn)); // Show error if second insert fails
            }
        // } else {
        //     die("First database insert failed: " . mysqli_error($conn)); // Show error if first insert fails
        // }
    } else {
        die("File upload failed."); // Show error if upload fails
    }
}
?>
