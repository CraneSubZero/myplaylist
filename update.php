<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $song = $_POST['song'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE playlist SET song=?, artist=?, album=?, genre=?, year=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $song, $artist, $album, $genre, $year, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Song updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error updating song: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Use prepared statement for SELECT as well
$sql = "SELECT * FROM playlist WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Song</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/Spotify.png" alt="Spotify Logo">
    </header>

    <div class="container">
        <h2>Update Song in Playlist</h2>
        
        <div class="warning-box">
            <p><strong>⚠️ Note:</strong> You are about to update song details. Please review your changes before submitting.</p>
        </div>

        <form method="post" onsubmit="return confirmUpdate()">
            <label for="song">Song Title:</label>
            <input type="text" name="song" id="song" value="<?php echo htmlspecialchars($row['song']); ?>" required>

            <label for="artist">Artist:</label>
            <input type="text" name="artist" id="artist" value="<?php echo htmlspecialchars($row['artist']); ?>" required>

            <label for="album">Album:</label>
            <input type="text" name="album" id="album" value="<?php echo htmlspecialchars($row['album']); ?>" required>

            <label for="genre">Genre:</label>
            <select name="genre" id="genre" required>
                <option value="Pop" <?php if ($row['genre'] == 'Pop') echo 'selected'; ?>>Pop</option>
                <option value="Rock" <?php if ($row['genre'] == 'Rock') echo 'selected'; ?>>Rock</option>
                <option value="Jazz" <?php if ($row['genre'] == 'Jazz') echo 'selected'; ?>>Jazz</option>
                <option value="Hip-Hop" <?php if ($row['genre'] == 'Hip-Hop') echo 'selected'; ?>>Hip-Hop</option>
                <option value="Classical" <?php if ($row['genre'] == 'Classical') echo 'selected'; ?>>Classical</option>
                <option value="K-pop" <?php if ($row['genre'] == 'K-pop') echo 'selected'; ?>>K-pop</option>
                <option value="J-Pop" <?php if ($row['genre'] == 'J-Pop') echo 'selected'; ?>>J-Pop</option>
                <option value="Metal" <?php if ($row['genre'] == 'Metal') echo 'selected'; ?>>Metal</option>
                <option value="R&B" <?php if ($row['genre'] == 'R&B') echo 'selected'; ?>>R&B</option>
                <option value="OPM" <?php if ($row['genre'] == 'OPM') echo 'selected'; ?>>OPM</option>
                <option value="EDM" <?php if ($row['genre'] == 'EDM') echo 'selected'; ?>>EDM</option>
            </select>

            <label for="year">Year Released:</label>
            <input type="number" name="year" id="year" value="<?php echo htmlspecialchars($row['year']); ?>" min="1900" max="2099" step="1" required>

            <input type="submit" value="Update Song">
        </form>
    </div>

    <br>
    <a href="index.php" class="back-button">Go Back to My Playlist</a>

    <footer>
        <p>Music Playlist - Inspired by Spotify UI</p>
    </footer>

    <script>
    function confirmUpdate() {
        return confirm("Are you sure you want to update this song?");
    }
    </script>
</body>
</html>

<?php $conn->close(); ?>