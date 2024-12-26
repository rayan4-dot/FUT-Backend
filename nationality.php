<?php
include('../Fut-champions/configuration/config.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUT Champions - Nationalities</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="src/style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="club.php">Club</a></li>
            <li><a href="#">Nationality</a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="gk.php">Goalkeepers</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>FUT Champions - Nationalities</h1>
        <button class="btn-primary" id="addNationalityBtn">Add Nationality</button>

        <div class="nationalities">
            <h2>Nationalities</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Flag</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // fetchin nationalities from the database

                    $sql = "SELECT nationality_id, name, flag FROM nationality";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {

                        // display

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td><img src='{$row['flag']}' alt='Flag' style='width:50px; height:30px;'></td>
                                    <td>
                            <a href='update_nationality.php?id={$row['nationality_id']}' class='inline-block'>
                        <i class='fas fa-edit' style='color: #2e649e;'></i>
                    </a>   
                            <a href='delete_nationality.php?id={$row['nationality_id']}' class='inline-block '><i class='fa fa-trash' style='color:rgb(197, 13, 13);'></i>
</a>
                        </td>
                                  </tr>";
                        }
                    } 

                    ?>
                </tbody>
            </table>
        </div>

        <div id="nationalityModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Add Nationality</h2>
                <form action="add_nationality.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Nationality Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    
                    <label for="flag">Flag:</label>
                    <input type="file" id="flag" name="flag" required><br><br>

                    <button type="submit" class="btn-primary">Add</button>
                </form>
            </div>
        </div>

        <div class="overlay" id="modalOverlay" style="display:none;"></div>
    </div>

    <script src="src/nation.js">

    </script>
</body>
</html>
