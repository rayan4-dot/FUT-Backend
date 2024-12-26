<?php
include('../Fut-champions/configuration/config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $clubName = mysqli_real_escape_string($conn, $_POST['name']);


    $logoName = $_FILES['myfile']['name'];
    $logoTmpName = $_FILES['myfile']['tmp_name'];

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $uploadFilePath = $uploadDir . basename($logoName);

    if (move_uploaded_file($logoTmpName, $uploadFilePath)) {

        $sql = "INSERT INTO club (name, logo) VALUES ('$clubName', '$uploadFilePath')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Club added successfully!');</script>";
        } else {
            echo "<script>alert('database error: " . mysqli_error($conn) . "');</script>";
        }
    }

    mysqli_close($conn);
}
?>
