<?php
include('../Fut-champions/configuration/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $player_id = $_POST['id'];

    $player_id = mysqli_real_escape_string($conn, $player_id);

    $query = "SELECT * FROM players WHERE player_id = {$player_id}";
    $result = $conn->query($query); 
    $player = $result->fetch_assoc();

    if ($player) {
        $imagePath = "img/" . $player['playerImage'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $sql_delete = "DELETE FROM players WHERE player_id = {$player_id}";
        if ($conn->query($sql_delete) === true) { 
            
            header("Location: players.php");
            exit(); 
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Player not found!');</script>";
    }
}

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Player</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
    <h1 class="text-2xl text-white font-bold">FUT Champions Management</h1>
</header>

<div class="pt-16 px-6">
    <h1 class="pb-10 text-lg font-bold">Delete Player</h1>
    <form action="delete_players.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">

        <h1 class="text-lg font-medium mb-6">Are you sure you want to delete this player?</h1>
        <button type="submit" class="py-3 px-10 bg-red-700 rounded-md text-white font-medium mr-3">Delete</button>
        <a href="players.php" class="py-3 px-10 bg-green-700 rounded-md text-white font-medium">Cancel</a>
    </form>
</div>
</body>
</html>
