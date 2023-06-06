<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>File Browser</title>
</head>
<body>
    <div class="container">
        <h1>File Browser</h1>
        <div>
            <?php
            // PHP code from above goes here
            ?>
            <?php
$directory = './'; // Specify the directory path here, './' represents the current directory

// Check if a folder is requested
if (isset($_GET['folder'])) {
    $requestedFolder = $_GET['folder'];
    $directory .= $requestedFolder . '/';
}

// Get all files and folders in the directory
$items = scandir($directory);

// Remove "." and ".." from the list
$items = array_diff($items, array('.', '..'));

// Function to determine the Bootstrap icon class based on the file extension
if (!function_exists('getFileIconClass')) {
    function getFileIconClass($filename) {
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $iconClass = '';
        switch ($fileExtension) {
            case 'txt':
                $iconClass = 'bi-file-text-fill';
                break;
            case 'pdf':
                $iconClass = 'bi-file-pdf-fill';
                break;
            case 'doc':
            case 'docx':
                $iconClass = 'bi-file-word-fill';
                break;
            case 'xls':
            case 'xlsx':
                $iconClass = 'bi-file-excel-fill';
                break;
            case 'ppt':
            case 'pptx':
                $iconClass = 'bi-file-ppt-fill';
                break;
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                $iconClass = 'bi-file-image-fill';
                break;
            default:
                $iconClass = 'bi-file-earmark-fill';
                break;
        }
        return $iconClass;
    }
}

// Output the list of files and folders
foreach ($items as $item) {
    $path = $directory . $item;
    if (is_dir($path)) {
        echo "<a href='?folder=$item'><i class='bi bi-folder-fill'></i> $item</a> [Folder]<br>";
    } else {
        $fileIconClass = getFileIconClass($item);
        echo "<a href='$path' download><i class='bi $fileIconClass'></i> $item</a><br>";
    }
}
?>

        </div>
    </div>
    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
