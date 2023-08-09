<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download executed!</title>
    <link rel="stylesheet" href="style.css">
    <link href="sunlight.png" rel="icon">
</head>
<body>

<?php

    if($_POST["downloads"] == "choose") {
        echo "Download doesnt exist, please select a download!";
    } else {

        $targetDownload = $_POST['downloads'];

        echo "Download file $targetDownload";

        if(file_exists($targetDownload)){

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($targetDownload));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetDownload));

            readfile($targetDownload);
        } else {
            die('File not found.');
        }

    }

?>

</body>
</html>
