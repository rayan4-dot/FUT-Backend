<?php
include('../Fut-champions/configuration/config.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUT Champions</title>
    <link rel="stylesheet" href="src/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="#">Club</a></li>
            <li><a href="nationality.php">Nationality</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="gk.php">Goalkeepers</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>FUT Champions</h1>
        <button class="btn-primary" id="addPlayerBtn">Add Club</button>

        <div class="major-goalkeepers">
            <h2>Clubs</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Logo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // fetch club

                    $sql = "SELECT club_id, name, logo FROM club";
                    $result = mysqli_query($conn, $sql);


                    if ($result && mysqli_num_rows($result) > 0) {
                        // display

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td><img src='{$row['logo']}' alt='Club Logo' style='width:50px; height:50px;'></td>
                                         <td>
                            <a href='update_club.php?id={$row['club_id']}' class='inline-block'>
                        <i class='fas fa-edit' style='color: #2e649e;'></i>
                    </a>   
                            <a href='delete_club.php?id={$row['club_id']}' class='inline-block '><i class='fa fa-trash' style='color:rgb(197, 13, 13);'></i>
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
                <h2>Add Club</h2>
                <form id="addPlayerForm" action="add_club.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Club Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    
                    <label for="image">Logo:</label>
                    <input type="file" id="image" name="myfile" required><br><br>

                    <button type="submit" class="btn-primary">Add</button>
                </form>
            </div>
        </div>

        <div class="overlay" id="modalOverlay" style="display:none;"></div>
    </div>

    <script src="src/club.js">
    </script>
</body>
</html>
