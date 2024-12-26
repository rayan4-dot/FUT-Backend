<?php
include('../Fut-champions/configuration/config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nationality_id = $_POST['id'];

    $nationality_id = mysqli_real_escape_string($conn, $nationality_id);

    $query = "SELECT * FROM nationality WHERE nationality_id = {$nationality_id}";
    $result = $conn->query($query); 
    $nationality = $result->fetch_assoc(); 

    if ($nationality) {
        $sql_delete = "DELETE FROM nationality WHERE nationality_id = {$nationality_id}";
        if ($conn->query($sql_delete) === true) { 
            
            header("Location: nationality.php");
            exit(); 
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Nationality not found!');</script>";
    }
}

$conn->close(); 
?>


<?php 
include('../Fut-champions/configuration/config.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Nationality</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
    <h1 class="text-2xl text-white font-bold">FUT Champions Management</h1>
</header>

<div class="pt-16 px-6">
    <h1 class="pb-10 text-lg font-bold">Delete Nationality</h1>
    <form action="delete_nationality.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">

        <h1 class="text-lg font-medium mb-6">Are you sure you want to delete this nationality?</h1>
        <button type="submit" class="py-3 px-10 bg-red-700 rounded-md text-white font-medium mr-3">Delete</button>
        <a href="nationality.php" class="py-3 px-10 bg-green-700 rounded-md text-white font-medium">Cancel</a>
    </form>
</div>
</body>
</html>
