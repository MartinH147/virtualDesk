<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do List</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Icon API -->
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

    // Create variables based on current date
    $currentDate = date("Y-m-d");
    $currentWeek = date("W");
    ?>

    <a href="../main/">
        <span id="backBtn" class="material-symbols-outlined">
            arrow_back
        </span>
    </a>
    <!-- To-do List -->
    <div class="todoList">
        <h1 class="title">TO-DO LIST</h1>
        <ul class="list">
            <div class="today">
                <h3 class="todoTimeframe">Today</h3>
                <div class="todayContents">
                    <!-- load the tasks from the database -->
                    <?php
                    // send an SQL query to the database
                    $sql = "SELECT * FROM todoList WHERE date='$currentDate'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<li id="task' . $row['id'] . '">
                            <form class="task" action="" method="post">
                            <input type="submit" name="completeTask' . $row['id'] . '" id="checkbox" onclick="taskCompleted()" value="">
                            <input type="submit" class="taskName" name="task' . $row['id'] . '" value=" ' . $row['name'] . ' ">
                            <p class="urgency">' . $row['urgency'] . '</p>
                            </form>
                            </li>';
                        }
                    } else {
                        // There is nothing in the table
                        echo "<p>No tasks!<p>";
                    }
                    ?>
                </div>
            </div>
            <div class="this week">
                <h3 class="todoTimeframe">This week</h3>
                <div class="thisweekContents">
                    <?php
                    // send an SQL query to the database
                    $sql = "SELECT * FROM todoList WHERE date>'$currentDate' and week='$currentWeek'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<li id="task' . $row['id'] . '">
                            <form class="task" action="" method="post">
                            <input type="submit" name="completeTask' . $row['id'] . '" id="checkbox" value="">
                            <input type="submit" class="taskName" name="task' . $row['id'] . '" value=" ' . $row['name'] . ' ">
                            <p class="urgency">' . $row['urgency'] . '</p>
                            </form>
                            </li>';
                        }
                    } else {
                        // There is nothing in the table
                        echo "<p>No tasks!<p>";
                    }
                    ?>
                </div>
            </div>
            <div class="later">
                <h3 class="todoTimeframe">Later</h3>
                <div class="laterContents">
                    <?php
                    // send an SQL query to the database
                    $sql = "SELECT * FROM todoList WHERE date>'$currentDate' AND NOT week='$currentWeek'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<li id="task' . $row['id'] . '">
                            <form class="task" action="" method="post">
                            <input type="submit" name="completeTask' . $row['id'] . '" id="checkbox" value="">
                            <input type="submit" class="taskName" name="task' . $row['id'] . '" value=" ' . $row['name'] . ' ">
                            <p class="urgency">' . $row['urgency'] . '</p>
                            </form>
                            </li>';
                        }
                    } else {
                        // There is nothing in the table
                        echo "<p>No tasks!<p>";
                    }
                    ?>
                </div>
            </div>
        </ul>
    </div>

    <!-- Task Card -->
    <div class="taskContainer">
        <div class="taskCard">
            <form action="" method="post" class="taskCardForm">
                <!-- php for the task card -->
                <?php
                // displaying tasks
                // program starts with no tasks being displayed
                $taskDisplaying = False;

                // display task that is clicked
                for ($x = 0; $x <= 1000; $x++) {
                    if ($_POST["task$x"]) {
                        // echo '<script>alert("Task successfully gotten")</script>';
                        $sql = "SELECT * FROM todoList WHERE id=$x";
                        if ($result = mysqli_query($conn, $sql)) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="taskCardInputs">
                                <input type="text" name="taskName" id="taskName" value="' . $row['name'] . '" placeholder="Task Name">
                                <input type="text" name="taskDate" id="taskDate" value="' . $row['date'] . '" placeholder="YYYY-MM-DD">
                                <input type="text" name="taskUrgency" id="taskUrgency" value="' . $row['urgency'] . '" placeholder="Urgency Emoji">
                                <input type="text" name="taskDetails" id="taskDetails" value="' . $row['details'] . '" placeholder="Details">
                                </div>
                                <div class="taskCardButtons">
                                <input type="submit" id="updatedelete" name="deleteTask' . $row['id'] . '" value="Delete">
                                <input type="submit" id="updatedelete" name="updateTask' . $row['id'] . '" value="Update">
                                </div>';
                                $taskDisplaying = True;
                            }
                        } else {
                            echo '<script>alert("Failed to get task info")</script>';
                        }
                    }
                }

                if ($taskDisplaying == False) {
                    // default elements
                    echo '<div class="taskCardInputs">
                    <input type="text" name="taskName" id="taskName" placeholder="Task Name">
                    <input type="text" name="taskDate" id="taskDate" placeholder="Date">
                    <input type="text" name="taskUrgency" id="taskUrgency" placeholder="Urgency">
                    <input type="text" name="taskDetails" id="taskDetails" placeholder="Details">
                    </div>
                    <div class="taskCardButtons">
                    <input type="submit" id="updatedelete" value="Delete">
                    <input type="submit" id="updatedelete" value="Update">
                    </div>';
                }

                // creating a new task
                if ($_POST['newTask']) {
                    // find the most recent id in the table
                    $sql = "SELECT * FROM todoList ORDER BY id DESC LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                    }
                    $id = $id + 1;

                    // add to todo list table
                    $sql = "INSERT INTO todoList (id, name, date, urgency, details, week) VALUES ($id, 'New Task', '$currentDate', '<>', 'Edit this task', $currentWeek)";
                    if ($result = mysqli_query($conn, $sql)) {
                    } else {
                        echo "Failed to update database";
                    }

                    header("Refresh:0");

                }
                ?>
            </form>
        </div>
        <div class="newTaskContainer">
            <form action="" method="post">
                <input type="submit" name="newTask" class="newTask" value="New Task">
            </form>
        </div>
    </div>

    <!-- non element-creating php -->
    <?php
    // updating a task
    for ($x = 0; $x <= 1000; $x++) {
        if ($_POST["updateTask$x"]) {
            //echo '<script>alert("Updating task...")</script>';
            // get all the values
            $name = $_POST['taskName'];
            $date = $_POST['taskDate'];
            $urgency = $_POST['taskUrgency'];
            $details = $_POST['taskDetails'];

            // adapted from https://sentry.io/answers/convert-a-date-format-in-php/
            $unixTime = strtotime($date);
            $week = date("W", $unixTime); // Pass the new date format as a string and the original date in Unix time
    
            $sql = "UPDATE todoList SET name='$name', date='$date', urgency='$urgency', details='$details', week='$week' WHERE id=$x";
            if ($result = mysqli_query($conn, $sql)) {
                //echo '<script>alert("Successfully updated task")</script>';
            } else {
                echo '<script>alert("Failed to update task")</script>';
            }

            header("Refresh:0");
        }
    }

    // deleting a task
    for ($x = 0; $x <= 1000; $x++) {
        if ($_POST["deleteTask$x"]) {
            $sql = "DELETE FROM todoList WHERE id=$x";
            if ($result = mysqli_query($conn, $sql)) {
            } else {
                echo '<script>alert("Failed to delete task")</script>';
            }

            header("Refresh:0");
        }
    }

    // completing a task
    for ($x = 0; $x <= 1000; $x++) {
        if ($_POST["completeTask$x"]) {

            // firstly, update the progress bar database, indicating the task is completed
            // to do this, I need to get the task name from the todo list database
            $sql = "SELECT * FROM todoList WHERE id=$x";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $taskName = $row['name'];
                echo $taskName;
            }

            $sql = "UPDATE progressBar SET completed=1 WHERE taskName='$taskName'";
            if ($result = mysqli_query($conn, $sql)) {
            } else {
                echo '<script>alert("Failed to update database")</script>';
            }

            // delete from todo list table
            $sql = "DELETE FROM todoList WHERE id=$x";
            if ($result = mysqli_query($conn, $sql)) {

            } else {
                echo '<script>alert("Failed to delete task")</script>';
            }

            header("Refresh:0");
        }
    }
    ?>

    <script src="app.js"></script>

    <!-- Neutralino.js client. This file is gitignored, 
    because `neu update` typically downloads it.
    Avoid copy-pasting it. 
    -->
    <script src="js/neutralino.js"></script>
</body>

</html>