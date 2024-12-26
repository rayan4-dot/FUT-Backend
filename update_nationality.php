<?php
include('../Fut-champions/configuration/config.php');

if (isset($_GET['id'])) {
    $nationality_id = (int)$_GET['id']; 

    $sql = "SELECT * FROM nationality WHERE nationality_id = {$nationality_id}";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $nationality = mysqli_fetch_assoc($result);

        
        if (!$nationality) {
            die("Error: Nationality not found.");
        }
    } else {
        die("Error in SQL query: " . mysqli_error($conn));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $flag = $_FILES['flag']['name'];
    
    if ($flag) {
        $flag_tmp = $_FILES['flag']['tmp_name'];
        $flag_path = "flags/$flag";
        move_uploaded_file($flag_tmp, $flag_path);

        
        $sql_update = "UPDATE nationality SET name = '{$name}', flag = '{$flag_path}' WHERE nationality_id = {$nationality_id}";
    } else {
        
        $sql_update = "UPDATE nationality SET name = '{$name}' WHERE nationality_id = {$nationality_id}";
    }

    if ($conn->query($sql_update) === true) {
        header("Location: nationality.php");
        exit(); 
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Nationality</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed">

    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Update Nationality</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Nationality Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($nationality['name']); ?>" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-4">
                <label for="flag" class="block text-lg font-medium text-gray-700">Flag:</label>
                <input type="file" id="flag" name="flag" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="<?php echo htmlspecialchars($nationality['flag']); ?>" alt="Current Flag" class="mt-4 w-20 h-12 rounded-md">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Update Nationality</button>
            </div>
        </form>
    </div>

</body>
</html>
