<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Playlist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <!-- Insert your Spotify logo image in the img tag below -->
        <img src="images/Spotify.png" alt="Spotify Logo">
    </header>

    <div class="container">
        <h2>Music Playlist</h2>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Song</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM playlist";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['song']}</td>
                            <td>{$row['artist']}</td>
                            <td>{$row['album']}</td>
                            <td>{$row['genre']}</td>
                            <td>{$row['year']}</td>
                            <td>
                                <a href='update.php?id={$row['id']}'>Edit</a> | 
                                <a href='delete.php?id={$row['id']}'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>"; // Adjusted colspan to 7
            }

            $conn->close();
            ?>
        </table>

        <br>
        <a href="create.php"><button>Add New Song</button></a>
    </div>

    <footer>
        <p>Music Playlist - Inspired by Spotify UI</p>
    </footer>
</body>
</html>