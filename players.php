<?php
include('../Fut-champions/configuration/config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rating = (int)$_POST['rating'];
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $pace = (int)$_POST['pace'];
    $shooting = (int)$_POST['shooting'];
    $passing = (int)$_POST['passing'];
    $dribbling = (int)$_POST['dribbling'];
    $defending = (int)$_POST['defending'];
    $physical = (int)$_POST['physical'];
    $nationality_id = (int)$_POST['nationality_id'];
    $club_id = (int)$_POST['club_id'];
    $playerImage = $_FILES['playerImage']['name'];
    $playerImage_tmp = $_FILES['playerImage']['tmp_name'];
    move_uploaded_file($playerImage_tmp, "img/$playerImage");

    // if($position=="GK"){
    //     $sql = "INSERT INTO `gk`(`name`,`postion`,`rating`,`diving`, `handling`, `kicking`, `reflexes`,`Positioning`,`speed`,`nationality_id`, `club_id`,`playerImage`) VALUES (
    //         '{$name}','{$position}',{$rating}, {$pace}, {$shooting}, {$passing}, {$dribbling}, {$defending}, {$physical}, {$nationality_id}, {$club_id}, '{$playerImage}'
    //     )";
    // }else{

    $sql = "INSERT INTO players (
        name, rating, position, pace, shooting, passing, dribbling, defending, physical, nationality_id, club_id, playerImage
    ) VALUES (
        '{$name}', {$rating}, '{$position}', {$pace}, {$shooting}, {$passing}, {$dribbling}, {$defending}, {$physical}, {$nationality_id}, {$club_id}, '{$playerImage}'
    )";
    // }
   

    if (mysqli_query($conn, $sql)) {
        echo "Player added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUT Champions - Players</title>
    <link rel="stylesheet" href="src/style2.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="club.php">Club</a></li>
            <li><a href="nationality.php">Nationality</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="gk.php">Goalkeepers</a></li>

        </ul>
    </div>

    <div class="main-content">
        <h1>FUT Champions - Players</h1>
        <button class="btn-primary" id="addPlayerBtn">Add Player</button>

        <div class="players">
            <h2>Players</h2>
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Position</th>
                        <th>Pace</th>
                        <th>Shooting</th>
                        <th>Passing</th>
                        <th>Dribbling</th>
                        <th>Defending</th>
                        <th>Physical</th>
                        <th>Nationality</th>
                        <th>Club</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // fetching form db

                    $sql = "SELECT p.*, n.name AS nationality, c.name AS club 
                            FROM players p
                            LEFT JOIN nationality n ON p.nationality_id = n.nationality_id
                            LEFT JOIN club c ON p.club_id = c.club_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {

                        // display player
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td><img src='img/{$row['playerImage']}' alt='Player Image' style='width:50px; height:50px;'></td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['rating']}</td>
                                    <td>{$row['position']}</td>
                                    <td>{$row['pace']}</td>
                                    <td>{$row['shooting']}</td>
                                    <td>{$row['passing']}</td>
                                    <td>{$row['dribbling']}</td>
                                    <td>{$row['defending']}</td>
                                    <td>{$row['physical']}</td>
                                    <td>{$row['nationality']}</td>
                                    <td>{$row['club']}</td>
                                      <td>
                            <a href='update_players.php?id={$row['player_id']}' class='inline-block'>
                        <i class='fas fa-edit' style='color: #2e649e;'></i>
                    </a>   
                            <a href='delete_players.php?id={$row['player_id']}' class='inline-block '><i class='fa fa-trash' style='color:rgb(197, 13, 13);'></i>
</a>
                        </td>
                                  </tr>";
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>

        <div id="playerModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Add Player</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="name">Player Name:</label>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="playerImage">Photo:</label>
                    <input type="file" id="playerImage" name="playerImage" required><br><br>

                    <label for="rating">Rating:</label>
                    <input type="number" id="rating" name="rating" min="1" max="99" required><br><br>

                    <label for="pace">Pace:</label>
                    <input type="number" id="pace" name="pace" min="1" max="99" required><br><br>

                    <label for="shooting">Shooting:</label>
                    <input type="number" id="shooting" name="shooting" min="1" max="99" required><br><br>

                    <label for="passing">Passing:</label>
                    <input type="number" id="passing" name="passing" min="1" max="99" required><br><br>

                    <label for="dribbling">Dribbling:</label>
                    <input type="number" id="dribbling" name="dribbling" min="1" max="99" required><br><br>

                    <label for="defending">Defending:</label>
                    <input type="number" id="defending" name="defending" min="1" max="99" required><br><br>

                    <label for="physical">Physical:</label>
                    <input type="number" id="physical" name="physical" min="1" max="99" required><br><br>

                    <label for="nationality_id">Nationality:</label>
                    <select id="nationality_id" name="nationality_id" required>
                        <option value="" disabled selected>Select Nationality</option>
                        <?php
                    
                        // fetching nationalities from  db

                        $sql = "SELECT nationality_id, name FROM nationality";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['nationality_id']}'>{$row['name']}</option>";
                        }
                        ?>
                        
                    </select><br><br>

                    <label for="club_id">Club:</label>
                    <select id="club_id" name="club_id" required>
                        <option value="" disabled selected>Select Club</option>
                        <?php
                        //for clubs
                        
                        $sql = "SELECT club_id, name FROM club";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['club_id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select><br><br>

                    <label for="position">Position:</label>
                    <select id="position" name="position" required>
                        <option value="" disabled selected>Select Position</option>
                        <option value="ST">Striker</option>
                        <option value="RW">Right Wing</option>
                        <option value="LW">Left Wing</option>
                        <option value="CM">Central Midfielder</option>
                        <option value="DM">Defensive Midfielder</option>
                        <option value="RB">Right-back</option>
                        <option value="LB">Left-back</option>
                        <option value="CB">Center-back</option>
                        <option value="GK">Goalkeeper</option>
                    </select><br><br>

                    <button type="submit" class="btn-primary">Add</button>
                </form>
            </div>
        </div>

        <div class="overlay" id="modalOverlay" style="display:none;"></div>
    </div>

    <script src="src/player.js">
    </script>


</body>
</html>
