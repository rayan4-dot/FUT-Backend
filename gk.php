<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUT Champions - Players</title>
    <link rel="stylesheet" href="src/style2.css">
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
        <h1>FUT Champions - Goalkeeper</h1>


        <div class="players">
            <h2>Goalkeepers</h2>
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Position</th>
                        <th>diving</th>
                        <th>handling</th>
                        <th>kicking</th>
                        <th>reflexes</th>
                        <th>Nationality</th>
                        <th>Club</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // fetching form db

                        // display gk
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td><img src='img/{$row['playerImage']}' alt='Player Image' style='width:50px; height:50px;'></td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['rating']}</td>
                                    <td>{$row['position']}</td>
                                    <td>{$row['diving']}</td>
                                    <td>{$row['handling']}</td>
                                    <td>{$row['kicking']}</td>
                                    <td>{$row['reflexes']}</td>
                                    <td>{$row['nationality']}</td>
                                    <td>{$row['club']}</td>
                                  </tr>";
                        }
                    

                    ?>
                </tbody>
            </table>
        </div>

    </div>


