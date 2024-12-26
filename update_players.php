<?php
include('../Fut-champions/configuration/config.php');

if (isset($_GET['id'])) {
    $player_id = $_GET['id'];

    $sql = "SELECT * FROM players WHERE player_id = {$player_id}";
    $result = mysqli_query($conn, $sql);
    $player = mysqli_fetch_assoc($result);
}

$nationalities = mysqli_query($conn, "SELECT * FROM nationality");
$clubs = mysqli_query($conn, "SELECT * FROM club");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rating = $_POST['rating'];
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $pace = $_POST['pace'];
    $shooting = $_POST['shooting'];
    $passing = $_POST['passing'];
    $dribbling = $_POST['dribbling'];
    $defending = $_POST['defending'];
    $physical = $_POST['physical'];
    $nationality_id = $_POST['nationality_id'];
    $club_id = $_POST['club_id'];

    $playerImage = $_FILES['playerImage']['name'];
    if ($playerImage) {
        $playerImage_tmp = $_FILES['playerImage']['tmp_name'];
        $playerImage_path = "img/$playerImage";
        move_uploaded_file($playerImage_tmp, $playerImage_path);

        $sql_update = "UPDATE players SET 
            name = '{$name}', rating = {$rating}, position = '{$position}', pace = {$pace}, 
            shooting = {$shooting}, passing = {$passing}, dribbling = {$dribbling}, 
            defending = {$defending}, physical = {$physical}, nationality_id = {$nationality_id}, 
            club_id = {$club_id}, playerImage = '{$playerImage}' 
            WHERE player_id = {$player_id}";
    } else {

        $sql_update = "UPDATE players SET 
            name = '{$name}', rating = {$rating}, position = '{$position}', pace = {$pace}, 
            shooting = {$shooting}, passing = {$passing}, dribbling = {$dribbling}, 
            defending = {$defending}, physical = {$physical}, nationality_id = {$nationality_id}, 
            club_id = {$club_id} 
            WHERE player_id = {$player_id}";
    }

    if (mysqli_query($conn, $sql_update)) {
        header("Location: players.php"); 
        exit();
    } else {
        die("Error: " . mysqli_error($conn)); 
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed">

    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Update Player</h1>
        
        <form action="" method="POST" enctype="multipart/form-data">

        <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Player Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $player['name']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="playerImage" class="block text-lg font-medium text-gray-700">Photo:</label>
                <input type="file" id="playerImage" name="playerImage" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="img/<?php echo $player['playerImage']; ?>" alt="Player Image" class="mt-4 w-32">
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-lg font-medium text-gray-700">Rating:</label>
                <input type="number" id="rating" name="rating" min="1" max="99" value="<?php echo $player['rating']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="position" class="block text-lg font-medium text-gray-700">Position:</label>
                <input type="text" id="position" name="position" value="<?php echo $player['position']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="pace" class="block text-lg font-medium text-gray-700">Pace:</label>
                <input type="number" id="pace" name="pace" min="1" max="99" value="<?php echo $player['pace']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="shooting" class="block text-lg font-medium text-gray-700">Shooting:</label>
                <input type="number" id="shooting" name="shooting" min="1" max="99" value="<?php echo $player['shooting']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="passing" class="block text-lg font-medium text-gray-700">Passing:</label>
                <input type="number" id="passing" name="passing" min="1" max="99" value="<?php echo $player['passing']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="dribbling" class="block text-lg font-medium text-gray-700">Dribbling:</label>
                <input type="number" id="dribbling" name="dribbling" min="1" max="99" value="<?php echo $player['dribbling']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="defending" class="block text-lg font-medium text-gray-700">Defending:</label>
                <input type="number" id="defending" name="defending" min="1" max="99" value="<?php echo $player['defending']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="physical" class="block text-lg font-medium text-gray-700">Physical:</label>
                <input type="number" id="physical" name="physical" min="1" max="99" value="<?php echo $player['physical']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="nationality_id" class="block text-lg font-medium text-gray-700">Nationality:</label>
                <select id="nationality_id" name="nationality_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <?php while ($nationality = mysqli_fetch_assoc($nationalities)): ?>
                        <option value="<?php echo $nationality['nationality_id']; ?>" <?php echo $player['nationality_id'] == $nationality['nationality_id'] ? 'selected' : ''; ?>>
                            <?php echo $nationality['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="club_id" class="block text-lg font-medium text-gray-700">Club:</label>
                <select id="club_id" name="club_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <?php while ($club = mysqli_fetch_assoc($clubs)): ?>
                        <option value="<?php echo $club['club_id']; ?>" <?php echo $player['club_id'] == $club['club_id'] ? 'selected' : ''; ?>>
                            <?php echo $club['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Update Player</button>            </div>
        </form>
    </div>

</body>
</html>
