<!DOCTYPE html>

<?php
$SQLdateCookie = "SQLdate";
$dateCookie = "date";
$monthIndexCookie = "monthIndex";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Icon APIs -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


</head>

<body>
    <!-- establish connection with the database -->
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

    // set up some time variables
    date_default_timezone_set('Australia/Sydney');
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i:s");
    $futureTime = date("H:i:s");
    $futureTime = date('H:i:s', strtotime($futureTime) + 60 * 60);

    // cookies
    if (!isset($_COOKIE[$SQLdateCookie])) {
        setcookie($SQLdateCookie, $currentDate);
    } else {
        $displayDate = $_COOKIE[$SQLdateCookie];
    }
    ?>

    <a href="../main/">
        <span id="backBtn" class="material-symbols-outlined">
            arrow_back
        </span>
    </a>

    <!-- Month Card -->
    <!-- adapted from https://www.geeksforgeeks.org/how-to-design-a-simple-calendar-using-javascript/ -->
    <div class="monthCard">
        <header class="calendarHeader">
            <p class="calendarCurrentDate"></p>
            <div class="calendarNav">
                <span id="calendarPrev" class="material-symbols-outlined">
                    arrow_circle_left
                </span>
                <span id="calendarNext" class="material-symbols-outlined">
                    arrow_circle_right
                </span>
            </div>
        </header>

        <div class="calendarBody">
            <ul class="calendarWeekdays">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
            <ul class="calendarDates"></ul>
        </div>
    </div>

    <!-- Day Card -->
    <div class="dayCard">
        <h2 class="day" id="day">Wednesday 25th</h2>
        <table class="daySchedule">
            <!-- load the events from the database -->
            <?php
            // send an SQL query to the database
            for ($x = 0; $x <= 1000; $x++) {
                // loads time box
                $sql = "SELECT HOUR(startTime), HOUR(finishTime) FROM schedule WHERE id=$x AND date='$displayDate'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                        <th>' . $row['HOUR(startTime)'] . '<br>' . $row['HOUR(finishTime)'] . '</th>';
                    }
                }
                // loads event
                $sql = "SELECT * FROM schedule WHERE id=$x AND date='$displayDate'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<td class="event">
                        <form class="eventForm" action="" method="post">
                        <input class="eventName" type="submit" name="event' . $row['id'] . '" value="' . $row['name'] . '">
                        </form>
                        </td>
                        </tr>';
                    }
                }
            }
            ?>
        </table>
    </div>

    <!-- Event Card -->
    <div class="eventContainer">
        <div class="eventCard">
            <form class="eventCardForm" action="" method="post">
                <!-- php for the event card -->
                <?php
                // displaying events
                // program starts with no events being displayed in card
                $eventDisplaying = False;

                // display event that is clicked
                for ($x = 0; $x <= 1000; $x++) {
                    if ($_POST["event$x"]) {
                        // echo '<script>alert("event successfully gotten")</script>';
                        $sql = "SELECT * FROM schedule WHERE id=$x";
                        if ($result = mysqli_query($conn, $sql)) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="eventCardInputs">
                                <input type="text" name="eventName" value="' . $row['name'] . '" placeholder="Event Name">
                                <input type="text" name="eventDate" value="' . $row['date'] . '" placeholder="Date (YYYY-MM-DD)">
                                <input type="text" name="eventStartTime" value="' . $row['startTime'] . '" placeholder="Start Time (HH:MI:SS)">
                                <input type="text" name="eventFinishTime" value="' . $row['finishTime'] . '" placeholder="Finish Time (HH:MI:SS)">
                                <input type="text" name="eventDetails" value="' . $row['details'] . '" placeholder="Details">
                                </div>
                                <div class="eventCardButtons">
                                <input type="submit" class="updatedelete" name="deleteEvent' . $row['id'] . '" value="Delete">
                                <input type="submit" class="updatedelete" name="updateEvent' . $row['id'] . '" value="Update">
                                </div>';
                                $eventDisplaying = True;
                            }
                        } else {
                            echo '<script>alert("Failed to get event info")</script>';
                        }
                    }
                }

                if ($eventDisplaying == False) {
                    // default elements
                    echo '<div class="eventCardInputs">
                    <input type="text" placeholder="Event Name">
                    <input type="text" placeholder="Date (YYYY-MM-DD)">
                    <input type="text" placeholder="Start Time (HH:MI:SS)">
                    <input type="text" placeholder="Finish Time (HH:MI:SS)">
                    <input type="text" placeholder="Details">
                    </div>
                    <div class="eventCardButtons">
                    <input type="submit" class="updatedelete" value="Delete">
                    <input type="submit" class="updatedelete" value="Update">
                    </div>';
                }

                // creating a new event
                if ($_POST['newEvent']) {
                    // find the most recent id in the database
                    $sql = "SELECT * FROM schedule ORDER BY id DESC LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                    }
                    $id = $id + 1;

                    $sql = "INSERT INTO schedule (id, name, date, startTime, finishTime, details) VALUES ($id, 'New Event', '$currentDate', '$currentTime', '$futureTime', 'Edit this event')";
                    if ($result = mysqli_query($conn, $sql)) {
                    } else {
                        echo "Failed to update database";
                    }

                    header("Refresh:0");

                }
                ?>
            </form>
        </div>
        <div class="newEventContainer">
            <form action="" method="post">
                <input type="submit" name="newEvent" class="newEvent" value="New Event">
            </form>
        </div>
    </div>

    <script src="app.js"></script>

    <!-- Neutralino.js client. This file is gitignored, 
    because `neu update` typically downloads it.
    Avoid copy-pasting it. 
    -->
    <script src="js/neutralino.js"></script>



    <!-- non element-creating php -->
    <?php
    // updating an event
    for ($x = 0; $x <= 1000; $x++) {
        if ($_POST["updateEvent$x"]) {
            // get all the values
            $name = $_POST['eventName'];
            $date = $_POST['eventDate'];
            $startTime = $_POST['eventStartTime'];
            $finishTime = $_POST['eventFinishTime'];
            $details = $_POST['eventDetails'];

            $sql = "UPDATE schedule SET name='$name', date='$date', startTime='$startTime', finishTime='$finishTime', details='$details' WHERE id=$x";
            if ($result = mysqli_query($conn, $sql)) {
            } else {
                echo '<script>alert("Failed to update event")</script>';
            }

            header("Refresh:0");
        }
    }

    // deleting a event
    for ($x = 0; $x <= 1000; $x++) {
        if ($_POST["deleteEvent$x"]) {
            $sql = "DELETE FROM schedule WHERE id=$x";
            if ($result = mysqli_query($conn, $sql)) {
            } else {
                echo '<script>alert("Failed to delete event")</script>';
            }

            header("Refresh:0");
        }
    }

    if (isset($_COOKIE[$SQLdateCookie])) {
        echo "<script>displayInDayCard(" . $_COOKIE[$dateCookie] . ", months[" . $_COOKIE[$monthIndexCookie] . "])</script>";
    }

    ?>
</body>

</html>