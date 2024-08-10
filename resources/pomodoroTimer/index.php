<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Icon API -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <!-- adapted from https://www.w3schools.com/php/php_mysql_select.asp -->
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

    // send an SQL query to the database
    $sql = "SELECT * FROM pomodoroTimer";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $workmins = $row['workmins'];
        $breakmins = $row['breakmins'];
        $longbreakmins = $row['longbreakmins'];
    }

    ?>

    <a href="../main/">
        <span id="backBtn" class="material-symbols-outlined">
            arrow_back
        </span>
    </a>

    <!-- Timer -->
    <div class="pomodoroTimer">
        <div class="timer">
            <h1 id="timeRemaining">25:00</h1>
            <audio src=""></audio>
            <svg class="timerProgress" height="300" width="300">
                <circle class="timerProgressCircle" stroke-width="20" fill="transparent" r="120" cx="150" cy="150" />
            </svg>
        </div>

        <div class="timerControls" id="timerControls">
            <span class="material-symbols-outlined startstop" id="startIcon">
                play_arrow
            </span>
            <h4 class="period" id="startstopLabel">Start</h4>
        </div>
    </div>

    <!-- Settings -->
    <div class="settings">
        <h2 class="settingsHeading">Settings</h2>
        <form action="" method="post">
            <div class="settingsRow initial">
                <h5>MINUTES</h5>
            </div>
            <div class="settingsRow">
                <h3>Work</h3>
                <input class="minsInput" type="number" name="workmins" id="workmins" value="<?php echo $workmins ?>" />
            </div>
            <div class="settingsRow">
                <h3>Break</h3>
                <input class="minsInput" type="number" name="breakmins" id="breakkmins"
                    value="<?php echo $breakmins ?>" />
            </div>
            <div class="settingsRow">
                <h3>Long Break</h3>
                <input class="minsInput" type="number" name="longbreakmins" id="longbreakmins"
                    value="<?php echo $longbreakmins ?>" />
            </div>
            <div class="submitRow">
                <input class="saveTimes" type="submit" name="saveTimes" value="Save Changes">
            </div>
            <div class="description">
                <p>
                    How a Pomodoro System Works
                </p>
                <p>
                    Every cycle has a period of work then a period of break. Every 4 cycles has an additional long break
                    at
                    the end.
                </p>
            </div>
        </form>
    </div>

    <?php
    // saves the times to the database
    if ($_POST["saveTimes"]) {
        $work = $_POST['workmins'];
        $break = $_POST['breakmins'];
        $longbreak = $_POST['longbreakmins'];

        $sql = "UPDATE pomodoroTimer SET workmins='$work', breakmins='$break', longbreakmins='$longbreak' WHERE id=1";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update times")</script>';
        }

        header("Refresh:0");
    }

    // creates a function that fills an array with the times for the different periods
    $sql = "SELECT * FROM pomodoroTimer";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo '<script>
    function fillArray(periods) {
    periods.push(' . $row['workmins'] . ');
    periods.push(' . $row['breakmins'] . ');
    periods.push(' . $row['workmins'] . ');
    periods.push(' . $row['breakmins'] . ');
    periods.push(' . $row['workmins'] . ');
    periods.push(' . $row['breakmins'] . ');
    periods.push(' . $row['workmins'] . ');
    periods.push(' . $row['breakmins'] . ');
    periods.push(' . $row['longbreakmins'] . ');
    };
    </script>';
    }
    ?>

    <!-- Neutralino.js client. This file is gitignored, 
        because `neu update` typically downloads it.
        Avoid copy-pasting it. 
        -->
    <script src="js/neutralino.js"></script>

    <script src="app.js"></script>
</body>

</html>