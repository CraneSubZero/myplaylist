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
                            <td>" . htmlspecialchars($row['song']) . "</td>
                            <td>" . htmlspecialchars($row['artist']) . "</td>
                            <td>" . htmlspecialchars($row['album']) . "</td>
                            <td>" . htmlspecialchars($row['genre']) . "</td>
                            <td>{$row['year']}</td>
                            <td>
                                <a href='update.php?id={$row['id']}' onclick='return confirmEdit()'>Edit</a> | 
                                <a href='delete.php?id={$row['id']}' onclick='return confirmDelete(\"" . htmlspecialchars($row['song']) . "\")'>Delete</a>
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
        <a href="create.php" onclick="return confirmAdd()"><button>Add New Song</button></a>
    </div>

    <footer>
        <p>Music Playlist - Inspired by Spotify UI</p>
    </footer>

    <script>
    function confirmEdit() {
        return confirm("Are you sure you want to edit this song?");
    }
    
    function confirmDelete(songName) {
        return confirm("Are you sure you want to delete '" + songName + "'? This action cannot be undone!");
    }
    
    function confirmAdd() {
        return confirm("Are you sure you want to add a new song to your playlist?");
    }
    </script>
</body>
</html>