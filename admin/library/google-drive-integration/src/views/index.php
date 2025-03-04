<?php
require_once __DIR__ . '/../models/DriveModel.php';

$driveModel = new DriveModel();
$files = $driveModel->getFiles();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Google Drive File Viewer</title>
</head>
<body>
    <div class="container">
        <h1>Google Drive Files</h1>
        <div id="file-list">
            <?php if (!empty($files)): ?>
                <ul>
                    <?php foreach ($files as $file): ?>
                        <li>
                            <?php if (strpos($file['mimeType'], 'image/') === 0): ?>
                                <img src="https://drive.google.com/uc?id=<?php echo $file['id']; ?>" alt="<?php echo $file['name']; ?>">
                            <?php else: ?>
                                <img src="../public/file-icon.png" alt="File Icon">
                            <?php endif; ?>
                            <div class="file-name"><?php echo $file['name']; ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No files found in Google Drive.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../public/js/main.js"></script>
</body>
</html>