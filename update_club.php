<?php
include('../Fut-champions/configuration/config.php');

if (isset($_GET['id'])) {
    $club_id =$_GET['id']; 

    
    $sql = "SELECT * FROM club WHERE club_id = {$club_id}";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $club = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $club_name = mysqli_real_escape_string($conn, $_POST['club_name']);
    $logo = $_FILES['logo']['name'];
    
    if ($logo) {
        $logo_tmp = $_FILES['logo']['tmp_name'];
        $logo_path = "../Fut-champions/logos/$logo";
        move_uploaded_file($logo_tmp, $logo_path);

        
        $sql_update = "UPDATE club SET name = '{$club_name}', logo = '{$logo_path}' WHERE club_id = {$club_id}";
    } else {
        
        $sql_update = "UPDATE club SET name = '{$club_name}' WHERE club_id = {$club_id}";
    }

    if ($conn->query($sql_update) === true) {
        
        header("Location: club.php");
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
    <title>Update Club</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed">

    <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Update Club</h1>

        <form action="update_club.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="club_name" class="block text-lg font-medium text-gray-700">Club Name:</label>
                <input type="text" id="club_name" name="club_name" value="<?php echo htmlspecialchars($club['name']); ?>" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-4">
                <label for="logo" class="block text-lg font-medium text-gray-700">Logo:</label>
                <input type="file" id="logo" name="logo" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="<?php echo htmlspecialchars($club['logo']); ?>" alt="Current Logo" class="mt-4 w-20 h-20 rounded-md">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Update Club</button>
            </div>
        </form>
    </div>

</body>
</html>
