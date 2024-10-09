<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $song = $_POST['song'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    $sql = "UPDATE playlist SET song='$song', artist='$artist', album='$album', genre='$genre', year='$year' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT * FROM playlist WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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
    <h2>Update Song</h2>
    <form method="post">
        Song: <input type="text" name="song" value="<?php echo $row['song']; ?>" required><br><br>
        Artist: <input type="text" name="artist" value="<?php echo $row['artist']; ?>" required><br><br>
        Album: <input type="text" name="album" value="<?php echo $row['album']; ?>" required><br><br>
        Genre: 
        <select name="genre" required>
            <option value="Pop" <?php if ($row['genre'] == 'Pop') echo 'selected'; ?>>Pop</option>
            <option value="Rock" <?php if ($row['genre'] == 'Rock') echo 'selected'; ?>>Rock</option>
            <option value="Jazz" <?php if ($row['genre'] == 'Jazz') echo 'selected'; ?>>Jazz</option>
            <option value="Hip Hop" <?php if ($row['genre'] == 'Hip Hop') echo 'selected'; ?>>Hip Hop</option>
            <option value="Classical" <?php if ($row['genre'] == 'Classical') echo 'selected'; ?>>Classical</option>
            <option value="K-Pop" <?php if ($row['genre'] == 'K-Pop') echo 'selected'; ?>>K-Pop</option>
            <option value="J-Pop" <?php if ($row['genre'] == 'J-Pop') echo 'selected'; ?>>J-Pop</option>
            <option value="Metal" <?php if ($row['genre'] == 'Metal') echo 'selected'; ?>>Metal</option>
            <option value="Metal" <?php if ($row['genre'] == 'R&B') echo 'selected'; ?>>R&B</option>
            <option value="Metal" <?php if ($row['genre'] == 'OPM') echo 'selected'; ?>>OPM</option>
            <option value="EDM" <?php if ($row['genre'] == 'EDM') echo 'selected'; ?>>EDM</option>
        </select><br><br>
        Year: <input type="number" name="year" value="<?php echo $row['year']; ?>" min="1900" max="2099" step="1" required><br><br>
        <input type="submit" value="Update Song">
    </form>
    <br>
    <a href="index.php">Go back to Playlist</a>
</body>
</html>

<?php $conn->close(); ?>