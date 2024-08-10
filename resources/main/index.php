<!DOCTYPE html>
<?php
// establish connection with the database
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


// for TODO LIST and SCHEDULE
// Create variables based on current date
$currentDate = date("Y-m-d");
$currentWeek = date("W");

?>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <title>Virtual Desk</title>
  <link rel="stylesheet" href="styles.css">

  <!-- Icon API Links -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
  <!-- Left Panel of Workspace -->
  <div class="leftside">

    <!-- CLOCK -->
    <div class="clock clockVisibility">
      <div class="timeContainer">
        <h1>12:00</h1>
      </div>
      <div class="dateContainer">
        <h2>Wednesday</h2>
        <h2 class="date">25 Dec</h2>
      </div>
    </div>

    <!-- SCHEDULE -->
    <a href="../schedule/">
      <div class="scheduleContainer scheduleVisibility">
        <table class="schedule">
          <!-- load the events from the database -->
          <?php
          // send an SQL query to the database
          for ($x = 0; $x <= 1000; $x++) {
            // loads time box
            $sql = "SELECT HOUR(startTime), HOUR(finishTime) FROM schedule WHERE id=$x AND date='$currentDate'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<tr>
                          <th>' . $row['HOUR(startTime)'] . '<br>' . $row['HOUR(finishTime)'] . '</th>';
              }
            }
            // loads event
            $sql = "SELECT * FROM schedule WHERE id=$x AND date='$currentDate'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<td class="event">
                          <form class="eventForm" action="../schedule/" method="post">
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
    </a>

    <!-- VIRTUAL PLANT -->
    <div class="virtualPlantContainer virtualPlantVisibility">
      <div class="virtualPlant">
        <span class="material-symbols-outlined" id="plant">
          potted_plant
        </span>
        <h2 class="comingSoon">Coming soon...</h2>
      </div>
    </div>
  </div>


  <!-- Middle Panel of Workspace -->
  <div class="middle">

    <!-- PROGRESS BAR -->
    <a href="../todolist/">
      <div class="progressBar progressBarVisibility">
        <div class="progress"></div>
      </div>
    </a>

    <!-- Desk -->
    <div class="desk" id="desk">

      <!-- Top Area of Desk -->
      <div class="deskFeatures">

        <!-- CALCULATOR -->
        <!-- from https://www.youtube.com/watch?v=cGgLHJGyS34 -->
        <div class="calculatorContainer calculatorVisibility">
          <div class="calculator">
            <form>
              <div class="display">
                <input type="text" name="display">
              </div>
              <div class="calcRow">
                <input type="button" value="AC" onclick="display.value = ''" id="operator">
                <input type="button" value="DE" onclick="display.value = display.value.toString().slice(0, -1)"
                  id="operator">
                <input type="button" value="^" onclick="display.value += '**'" id="operator">
                <input type="button" value="÷" onclick="display.value += '/'" id="operator">
              </div>
              <div class="calcRow">
                <input type="button" value="7" onclick="display.value += '7'">
                <input type="button" value="8" onclick="display.value += '8'">
                <input type="button" value="9" onclick="display.value += '9'">
                <input type="button" value="×" onclick="display.value += '*'" id="operator">
              </div>
              <div class="calcRow">
                <input type="button" value="4" onclick="display.value += '4'">
                <input type="button" value="5" onclick="display.value += '5'">
                <input type="button" value="6" onclick="display.value += '6'">
                <input type="button" value="+" onclick="display.value += '+'" id="operator">
              </div>
              <div class="calcRow">
                <input type="button" value="1" onclick="display.value += '1'">
                <input type="button" value="2" onclick="display.value += '2'">
                <input type="button" value="3" onclick="display.value += '3'">
                <input type="button" value="-" onclick="display.value += '-'" id="operator">
              </div>
              <div class="calcRow">
                <input type="button" value="0" onclick="display.value += '0'">
                <input type="button" value="." onclick="display.value += '.'" id="operator">
                <input type="button" value="=" id="equals" onclick="display.value = eval(display.value)">
              </div>
            </form>
          </div>
        </div>

        <!-- POMODORO TIMER -->
        <!-- with help from https://www.youtube.com/watch?v=sDpfRFUcxY4 -->

        <div class="pomodoroTimer pomodoroTimerVisibility">
          <a href="../pomodoroTimer/">
            <div class="timer">
              <h1 id="timeRemaining">25:00</h1>
              <audio src=""></audio>
              <svg class="timerProgress" height="200" width="200">
                <circle class="timerProgressCircle" stroke-width="15" fill="transparent" r="80" cx="100" cy="100" />
              </svg>
            </div>
          </a>
          <div class="timerControls" id="timerControls">
            <span class="material-symbols-outlined startstop">
              play_arrow
            </span>
            <h4 class="period">Start</h4>
          </div>
        </div>

        <!-- some blank space -->
        <div class="blankSpace"></div>

        <!-- STICKY NOTES -->
        <div class="stickyNotes stickyNotesVisibility">
          <form action="" method="POST">
            <input class="stickyNotesTitle" id="stickyNotes" type="submit" name="newNote" value="Sticky">
            <input class="stickyNotesTitle" id="stickyNotes" type="submit" name="newNote" value="Notes">
          </form>
        </div>
      </div>

      <!-- VIRTUAL ASSISTANT -->
      <div class="mAIContainer virtualAssistantVisibility">
        <div class="mAI">
          <span class="material-symbols-outlined" id="mAIIcon" title="Say 'Craig' followed by your query">
            memory
          </span>
        </div>
      </div>

      <!-- STICKY NOTES -->
      <div class="notesSpace stickyNotesVisibility" id="notesSpace">
        <?php
        // Load notes from the database
        // adapted from https://www.w3schools.com/php/php_mysql_select.asp
        // send an SQL query to the database
        $sql = "SELECT * FROM stickyNotes";
        $result = $conn->query($sql);

        // if there's something in the table
        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<form action="" method="POST">
                    <input type="text" name="note" id="' . $row["element"] . '" value="' . $row["text"] . '" class="newNote"/>
                    <input type="submit" name="updateNotes' . $row["id"] . '" hidden>
                    </form>';
          }
        }

        // Create a new sticky note
        if (isset($_POST['newNote'])) {

          // find the most recent id in the database
          $sql = "SELECT * FROM stickyNotes ORDER BY id DESC LIMIT 1";
          $result = mysqli_query($conn, $sql);
          while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
          }
          $id = $id + 1;

          // find the number of rows, so the notes can't exceed 5
          // from https://www.geeksforgeeks.org/how-to-count-rows-in-mysql-table-in-php/
          $sql = "SELECT * from stickyNotes";
          if ($result = mysqli_query($conn, $sql)) {
            // Return the number of rows in result set
            $rowcount = mysqli_num_rows($result);
          }

          if ($rowcount < 5) {
            $sql = "INSERT INTO stickyNotes (id, element, text) VALUES ($id,'note$id','New Note')";
            if ($updateDatabase = mysqli_query($conn, $sql)) {
            } else {
              echo "Failed to update database";
            }

            header("Refresh:0");
          }
        }
        ?>
      </div>
    </div>
    <!-- End of Desk -->
  </div>


  <!-- Right Panel of Workspace -->
  <div class="rightside">

    <div class="topRightIcons">
      <!-- RUBBISH BIN -->
      <span id="binIcon" class="material-symbols-outlined rubbishBinVisibility topRightIcon">
        delete
      </span>

      <!-- VIEW -->
      <a href="../view/view.php">
        <span id="viewIcon" class="material-symbols-outlined viewVisibility topRightIcon">
          image
        </span>
      </a>

      <!-- CUSTOMISATION -->
      <a href="../customisation/customisation.php">
        <span id="customisationIcon" class="material-symbols-outlined customisationVisibility topRightIcon">
          settings
        </span>
      </a>

    </div>


    <!-- TODO LIST -->
    <div class="todoList todoListVisibility">
      <a href="../todolist/">
        <h1 class="todo">TO-DO</h1>
      </a>
      <ul class="list">
        <div class="today">
          <h3 class="todoTimeframe">Today</h3>
          <div class="todayContents" id="todoToday">
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
        <div class="thisweek">
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
              echo "<p>No tasks!</p>";
            }
            ?>
          </div>
        </div>
      </ul>
    </div>


    <!-- VIRTUAL PET -->
    <div class="virtualPetContainer virtualPetVisibility">
      <div class="virtualPet">
        <span class="material-symbols-outlined" id="pet">
          cruelty_free
        </span>
        <h2 class="comingSoon">Coming soon...</h2>
      </div>
    </div>
  </div>

  <!-- Non-element-specific PHP -->
  <?php
  // STICKY NOTES
  // for loop to dynamically handle the infinite number of possible submit names
  // only allows for 1000 possible ids, otherwise it would be infinite and the program will break
  for ($x = 0; $x <= 1000; $x++) {
    if (isset($_POST["updateNotes$x"])) {
      $textContent = $_POST['note'];
      //echo '<script>alert("New text content: ' . $textContent . '")</script>';
  
      if ($textContent == '') {
        $sql = "DELETE FROM stickyNotes WHERE id=$x";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
          echo '<script>alert("Failed to delete note")</script>';
        }
      } else {
        $sql = "UPDATE stickyNotes SET text='$textContent' WHERE id=$x";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
          echo '<script>alert("Failed to update text content")</script>';
        }
      }

      header("Refresh:0");
    }
  }


  // TO-DO LIST
  // completing a task
  for ($x = 0; $x <= 1000; $x++) {
    if (isset($_POST["completeTask$x"])) {
      // echo '<script>alert("Task completing... ")</script>';
  
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

  // delete tasks that are older than today
  $sql = "DELETE FROM todoList WHERE date < '$currentDate' ";
  $result = $conn->query($sql);

  header("Refresh:0");


  // CUSTOMISATION
  echo "<script>let feature = '';</script>";
  $sql = "SELECT * FROM visibility";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    if ($row['visible'] == 0) {
      echo '<script>
      feature = document.querySelector(`.' . $row['feature'] . 'Visibility`)
      feature.style.setProperty("opacity", "0")
      </script>';
    }
  }


  // PROGRESS BAR
  // clear the progress bar table of outdated info
  $sql = "DELETE FROM progressBar WHERE date < '$currentDate' ";
  $result = $conn->query($sql);
  header("Refresh:0");

  // set up the progress bar at the start of each day
  $sql1 = "SELECT * FROM progressBar";
  $result1 = $conn->query($sql1);
  // only runs if the table is empty, which should occur once each day
  if ($result1->num_rows == 0) {

    // gets today's tasks from the todo list table, and adds them to the progress bar table
    $sql2 = "SELECT * FROM todoList WHERE date='$currentDate'";
    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {
      // echo "<script>alert('ID: " . $row2['id'] . "')</script>";
      $sql3 = "INSERT INTO progressBar (taskName, date, completed) VALUES ('" . $row2['name'] . "', '" . $row2['date'] . "', 0)";
      // echo '<script>alert("SQL: ' . $sql3 . '")</script>';
      if ($result3 = mysqli_query($conn, $sql3)) {
        // echo "<script>alert('Succesfully updated database.')</script>";
      } else {
        echo "<script>alert('Failed to update database.')</script>";
      }
    }
  }

  // set progress bar variables based on data in database
  $sql = "SELECT * from progressBar";
  if ($result = mysqli_query($conn, $sql)) {
    // tasksTodo
    // this number of rows determines the number of tasks to complete for the day
    $rowcount = mysqli_num_rows($result);
    echo "<script>const tasksTodo = " . $rowcount . ";</script>";

    // tasksCompleted
    $sql = "SELECT * from progressBar WHERE completed = 1";
    $result = mysqli_query($conn, $sql);
    // this number of rows determines the number of tasks that have been completed
    $rowcount = mysqli_num_rows($result);
    echo "<script>const tasksCompleted = " . $rowcount . ";</script>";
  } else {
    echo "<script>alert('Failed to access database.')</script>";
  }

  // check if there are records in the todo list table that should also be in the progress bar table, and if so update them
  $sql1 = "SELECT * FROM todoList WHERE date='$currentDate'";
  $result1 = $conn->query($sql1);
  while ($row1 = $result1->fetch_assoc()) {
    // echo "<script>alert('Checking ID " . $row1['id'] . "')</script>";
    $sql2 = "SELECT * from progressBar WHERE taskName='" . $row1['name'] . "'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2->num_rows > 0) {
      // task is already in progress bar table
      while ($row2 = $result2->fetch_assoc()) {
        // echo "<script>alert('Task " . $row2['taskName'] . " already in database.')</script>";
      }
    } else {
      // echo "<script>alert('Else...')</script>";
      // insert task into progress bar table with completed = 0
      $sql3 = "INSERT INTO progressBar (taskName, date, completed) VALUES ('" . $row1['name'] . "', '" . $row1['date'] . "', 0)";
      // echo $sql3;
      if ($result3 = mysqli_query($conn, $sql3)) {
        // echo "<script>alert('Succesfully updated database.')</script>";
      } else {
        echo "<script>alert('Failed to update database.')</script>";
      }
    }
    // echo "<script>alert('Checking next ID...')</script>";
  }

  echo "test";



  // POMODORO TIMER
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
  let startingMinutes = ' . $row['workmins'] . ';
  </script>';

  }
  ?>

  <!-- Neutralino.js client. This file is gitignored, 
        because `neu update` typically downloads it.
        Avoid copy-pasting it. 
        -->
  <script src="js/neutralino.js"></script>


  <!-- Javascript files -->
  <script src="main.js"></script>
  <script src="../customisation/customisation.js"></script>

  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/92e2d3e91f.js" crossorigin="anonymous"></script>
</body>

</html>