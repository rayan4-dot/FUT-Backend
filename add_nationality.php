<?php
include('../Fut-champions/configuration/config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    
    $flagName = $_FILES['flag']['name'];
    $flagTmpName = $_FILES['flag']['tmp_name'];

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); 
    }
    $uploadFilePath = $uploadDir . basename($flagName);

    if (move_uploaded_file($flagTmpName, $uploadFilePath)) {
        
        $sql = "INSERT INTO nationality (name, flag) VALUES ('$name', '$uploadFilePath')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Nationality added successfully!');;</script>";
        } else {
            echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }

    mysqli_close($conn);
}
?>
