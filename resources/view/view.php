<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="view.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <!-- Establish connection with the database -->
    <?php
    // This is using SQL to interact with a MySQL database, which I can also interact with at localhost/phpmyadmin/
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SDDMajorProject";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

    <a href="../main/">
        <span id="close" class="material-symbols-outlined">
            close
        </span>
    </a>

    <img class="mainImage" src="
        <?php
        $sql = "SELECT * FROM view WHERE selectedImage = 1";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo $row['link'];
        }
        ?>
        " alt="View">
    <span class="material-symbols-outlined inactive" id="changeImage">
        photo_library
    </span>
    <div class="defaultImages">

        <!-- load up all of the elements with links saved in database -->
        <?php
        $sql = "SELECT * FROM view";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<form action="" method="POST" class="imageForm">
            <input type="submit" name="imageInput' . $row['id'] . '" id="defaultImage' . $row['id'] . '" style="background:url(' . $row['link'] . '); background-repeat: no-repeat; background-size: cover;" value="">
            </form>';
        }
        ?>
        <span class="material-symbols-outlined" id="uploadImage">
            upload
        </span>
    </div>

    <script src="view.js"></script>
    <!-- Neutralino.js client. This file is gitignored, 
        because `neu update` typically downloads it.
        Avoid copy-pasting it. 
        -->
    <script src="js/neutralino.js"></script>


    <!-- update selected image -->
    <?php
    // for loop checks for each of the 7 default images
    // starts at 1 because that's what I set the first id to
    for ($x = 1; $x <= 7; $x++) {
        if (isset($_POST["imageInput$x"])) {
            // first, get the current selected image id
            $sql = "SELECT * FROM view WHERE selectedImage = 1";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $selectedImageId = $row['id'];
            }

            // then, make the current selectedImage false
            $sql = "UPDATE view SET selectedImage=0 WHERE id=$selectedImageId";
            $result = $conn->query($sql);

            // then, make the new selectedImage true
            $sql = "UPDATE view SET selectedImage=1 WHERE id=$x";
            $result = $conn->query($sql);

            // finally, refresh the page
            header("Refresh:0");
        }
    }

    ?>
</body>

</html>