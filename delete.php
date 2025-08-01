<?php
include 'config.php';

$id = $_GET['id'];

// If confirmation is not set, show confirmation page
if (!isset($_GET['confirm'])) {
    // Get song details for confirmation
    $sql = "SELECT * FROM playlist WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if (!$row) {
        echo "Song not found!";
        header('Location: index.php');
        exit();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirm Delete</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header>
            <img src="images/Spotify.png" alt="Spotify Logo">
        </header>
        
        <div class="container">
            <h2>Confirm Delete</h2>
            <div class="warning-box">
                <p><strong>⚠️ Warning:</strong> Are you sure you want to delete this song?</p>
                <div class="song-details">
                    <p><strong>Song:</strong> <?php echo htmlspecialchars($row['song']); ?></p>
                    <p><strong>Artist:</strong> <?php echo htmlspecialchars($row['artist']); ?></p>
                    <p><strong>Album:</strong> <?php echo htmlspecialchars($row['album']); ?></p>
                    <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                    <p><strong>Year:</strong> <?php echo htmlspecialchars($row['year']); ?></p>
                </div>
                <p><em>This action cannot be undone!</em></p>
                
                <div class="button-group">
                    <a href="delete.php?id=<?php echo $id; ?>&confirm=yes" class="delete-btn">Yes, Delete Song</a>
                    <a href="index.php" class="cancel-btn">Cancel</a>
                </div>
            </div>
        </div>
        
        <footer>
            <p>Music Playlist - Inspired by Spotify UI</p>
        </footer>
    </body>
    </html>
    <?php
    exit();
}

// If confirmed, proceed with deletion
if ($_GET['confirm'] == 'yes') {
    $sql = "DELETE FROM playlist WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Song deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting song: " . $stmt->error . "'); window.location.href='index.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>