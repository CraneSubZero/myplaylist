<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $song = $_POST['song'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    $sql = "INSERT INTO playlist (song, artist, album, genre, year) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $song, $artist, $album, $genre, $year);

    if ($stmt->execute()) {
        echo "<script>alert('Song added successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error adding song: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Song</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/Spotify.png" alt="Spotify Logo">
    </header>

    <div class="container">
        <h2>Add New Song to Playlist</h2>
        
        <div class="warning-box">
            <p><strong>⚠️ Note:</strong> You are about to add a new song to your playlist. Please review your details before submitting.</p>
        </div>

        <form action="create.php" method="post" onsubmit="return confirmAdd()">
            <label for="song">Song Title:</label>
            <input type="text" name="song" id="song" required>

            <label for="artist">Artist:</label>
            <input type="text" name="artist" id="artist" required>

            <label for="album">Album:</label>
            <input type="text" name="album" id="album" required>

            <label for="genre">Genre:</label>
            <select name="genre" id="genre" required>
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Jazz">Jazz</option>
                <option value="Hip-Hop">Hip-Hop</option>
                <option value="Classical">Classical</option>
                <option value="K-pop">K-pop</option>
                <option value="J-Pop">J-Pop</option>
                <option value="Metal">Metal</option>
                <option value="R&B">R&B</option>
                <option value="OPM">OPM</option>
                <option value="EDM">EDM</option>
                <!-- Add more genres as you see fit -->
            </select>

            <label for="year">Year Released:</label>
            <input type="number" name="year" id="year" min="1900" max="2099" required>

            <input type="submit" value="Add Song">
        </form>
    </div>

    <br>
        <a href="index.php" class="back-button">Go Back to My Playlist</a>
    </div>

    <footer>
        <p>Music Playlist - Inspired by Spotify UI</p>
    </footer>

    <script>
    function confirmAdd() {
        return confirm("Are you sure you want to add this song to your playlist?");
    }
    </script>
</body>
</html>