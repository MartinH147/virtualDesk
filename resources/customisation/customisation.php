<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="customisation.css">
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
        <span id="backBtn" class="material-symbols-outlined">
            arrow_back
        </span>
    </a>

    <!-- Workspace -->
    <div class="workspace">
        <div class="leftside">
            <div class="clock workspaceItem">
                <p>Clock</p>
                <?php
                // echo elements based on if feature is visible or not
                $sql = "SELECT * FROM visibility";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['feature'] == 'clock') {
                        if ($row['visible'] == 0) {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="showClock" value="Show">
                            </form>';
                        } else {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="hideClock" value="Hide">
                            </form>';
                        }
                    }
                }
                ?>
            </div>
            <div class="schedule workspaceItem">
                <p>Schedule</p>
                <?php
                // echo elements based on if feature is visible or not
                $sql = "SELECT * FROM visibility";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['feature'] == 'schedule') {
                        if ($row['visible'] == 0) {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="showSchedule" value="Show">
                            </form>';
                        } else {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="hideSchedule" value="Hide">
                            </form>';
                        }
                    }
                }
                ?>
            </div>
            <div class="virtualPlant workspaceItem">
                <p>Virtual Plant</p>
                <?php
                // echo elements based on if feature is visible or not
                $sql = "SELECT * FROM visibility";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['feature'] == 'virtualPlant') {
                        if ($row['visible'] == 0) {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="showVirtualPlant" value="Show">
                            </form>';
                        } else {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="hideVirtualPlant" value="Hide">
                            </form>';
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="middle">
            <div class="progressBar workspaceItem">
                <p>Progress Bar</p>
                <?php
                // echo elements based on if feature is visible or not
                $sql = "SELECT * FROM visibility";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['feature'] == 'progressBar') {
                        if ($row['visible'] == 0) {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="showProgressBar" value="Show">
                            </form>';
                        } else {
                            echo '<form action="" method="post">
                            <input type="submit" class="showhide" name="hideProgressBar" value="Hide">
                            </form>';
                        }
                    }
                }
                ?>
            </div>
            <div class="desk">
                <div class="deskrow">
                    <div class="calculator workspaceItem">
                        <p>Calculator</p>
                        <?php
                        // echo elements based on if feature is visible or not
                        $sql = "SELECT * FROM visibility";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['feature'] == 'calculator') {
                                if ($row['visible'] == 0) {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showCalculator" value="Show">
                                    </form>';
                                } else {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideCalculator" value="Hide">
                                    </form>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="pomodoroTimer workspaceItem">
                        <p>Pomodoro Timer</p>
                        <?php
                        // echo elements based on if feature is visible or not
                        $sql = "SELECT * FROM visibility";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['feature'] == 'pomodoroTimer') {
                                if ($row['visible'] == 0) {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showPomodoroTimer" value="Show">
                                    </form>';
                                } else {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hidePomodoroTimer" value="Hide">
                                    </form>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="blankDiv"></div>
                    <div class="stickyNotes workspaceItem">
                        <p>Sticky Notes</p>
                        <?php
                        // echo elements based on if feature is visible or not
                        $sql = "SELECT * FROM visibility";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['feature'] == 'stickyNotes') {
                                if ($row['visible'] == 0) {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showStickyNotes" value="Show">
                                    </form>';
                                } else {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideStickyNotes" value="Hide">
                                    </form>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="deskrow">
                    <div class="virtualAssistant workspaceItem">
                        <p>Craig</p>
                        <?php
                        // echo elements based on if feature is visible or not
                        $sql = "SELECT * FROM visibility";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['feature'] == 'virtualAssistant') {
                                if ($row['visible'] == 0) {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showVirtualAssistant" value="Show">
                                    </form>';
                                } else {
                                    echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideVirtualAssistant" value="Hide">
                                    </form>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="deskrow"></div>
            </div>
        </div>
        <div class="rightside">
            <div class="rubcustContainer">
                <div class="rubbishBin workspaceItem">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                    <?php
                    // echo elements based on if feature is visible or not
                    $sql = "SELECT * FROM visibility";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        if ($row['feature'] == 'rubbishBin') {
                            if ($row['visible'] == 0) {
                                echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showRubbishBin" value="Show">
                                    </form>';
                            } else {
                                echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideRubbishBin" value="Hide">
                                    </form>';
                            }
                        }
                    }
                    ?>
                </div>

                <div class="view workspaceItem">
                    <span class="material-symbols-outlined">
                        image
                    </span>
                    <?php
                    // echo elements based on if feature is visible or not
                    $sql = "SELECT * FROM visibility";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        if ($row['feature'] == 'view') {
                            if ($row['visible'] == 0) {
                                echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showView" value="Show">
                                    </form>';
                            } else {
                                echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideView" value="Hide">
                                    </form>';
                            }
                        }
                    }
                    ?>
                </div>

                <div class="customisation workspaceItem">
                    <span class="material-symbols-outlined">
                        settings
                    </span>
                    <?php
                    // echo elements based on if feature is visible or not
                    $sql = "SELECT * FROM visibility";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        if ($row['feature'] == 'customisation') {
                            if ($row['visible'] == 0) {
                                echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showCustomisation" value="Show">
                                    </form>';
                            } else {
                                echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideCustomisation" value="Hide">
                                    </form>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="todoList workspaceItem">
                <p>Todo List</p>
                <?php
                // echo elements based on if feature is visible or not
                $sql = "SELECT * FROM visibility";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['feature'] == 'todoList') {
                        if ($row['visible'] == 0) {
                            echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showTodoList" value="Show">
                                    </form>';
                        } else {
                            echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideTodoList" value="Hide">
                                    </form>';
                        }
                    }
                }
                ?>
            </div>
            <div class="virtualPet workspaceItem">
                <p>Virtual Pet</p>
                <?php
                // echo elements based on if feature is visible or not
                $sql = "SELECT * FROM visibility";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if ($row['feature'] == 'virtualPet') {
                        if ($row['visible'] == 0) {
                            echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="showVirtualPet" value="Show">
                                    </form>';
                        } else {
                            echo '<form action="" method="post">
                                    <input type="submit" class="showhide" name="hideVirtualPet" value="Hide">
                                    </form>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="settings">
        <div class="themeContainer">
            <h1 class="themeHeader">Theme</h1>
            <span class="material-symbols-outlined">
                dark_mode
            </span>
            <span class="material-symbols-outlined">
                light_mode
            </span>
        </div>

        <div class="keyColourContainer">
            <h1 class="keyColourHeader">Key Colour</h1>
            <div class="keyColourRow">
                <div class="keyColour lightSeaGreen" onclick="setKeyColour(this)"></div>
                <div class="keyColour pink" onclick="setKeyColour(this)"></div>
                <div class="keyColour middleBlue" onclick="setKeyColour(this)"></div>
                <div class="keyColour lightGreen" onclick="setKeyColour(this)"></div>
            </div>
            <div class="keyColourRow">
                <div class="keyColour mahogany" onclick="setKeyColour(this)"></div>
                <div class="keyColour lightOrange" onclick="setKeyColour(this)"></div>
                <div class="keyColour fadedBlue" onclick="setKeyColour(this)"></div>
                <div class="keyColour red" onclick="setKeyColour(this)"></div>
            </div>
            <div class="keyColourRow">
                <div class="keyColour gold" onclick="setKeyColour(this)"></div>
                <div class="keyColour orange" onclick="setKeyColour(this)"></div>
                <div class="keyColour purple" onclick="setKeyColour(this)"></div>
                <div class="keyColour lightBlue" onclick="setKeyColour(this)"></div>
            </div>
        </div>

        <div class="layoutContainer">
            <h1 class="layoutHeader">Layout</h1>
            <div class="layoutBox">

            </div>
            <div class="layoutBox">

            </div>
            <div class="layoutBox">

            </div>
        </div>
    </div>

    <!-- Neutralino.js client. This file is gitignored, 
        because `neu update` typically downloads it.
        Avoid copy-pasting it. 
        -->
    <script src="js/neutralino.js"></script>

    <script src="js/customisation.js"></script>

    <?php
    // 24 if statements, two for each feature, hide and show
    // there's probably a more effecient way to do this, using a for loop or something
    
    // clock
    if ($_POST["hideClock"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='clock'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showClock"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='clock'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // schedule
    if ($_POST["hideSchedule"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='schedule'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showSchedule"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='schedule'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // virtual plant
    if ($_POST["hideVirtualPlant"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='virtualPlant'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showVirtualPlant"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='virtualPlant'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // progress bar
    if ($_POST["hideProgressBar"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='progressBar'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showProgressBar"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='progressBar'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // calculator
    if ($_POST["hideCalculator"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='calculator'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showCalculator"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='calculator'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // pomodoro timer
    if ($_POST["hidePomodoroTimer"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='pomodoroTimer'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showPomodoroTimer"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='pomodoroTimer'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // sticky notes
    if ($_POST["hideStickyNotes"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='stickyNotes'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showStickyNotes"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='stickyNotes'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // virtual assistant
    if ($_POST["hideVirtualAssistant"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='virtualAssistant'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showVirtualAssistant"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='virtualAssistant'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // rubbish bin
    if ($_POST["hideRubbishBin"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='rubbishBin'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showRubbishBin"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='rubbishBin'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // view
    if ($_POST["hideView"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='view'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showView"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='view'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // todolist
    if ($_POST["hideTodoList"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='todoList'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showTodoList"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='todoList'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }

    // virtual pet
    if ($_POST["hideVirtualPet"]) {
        $sql = "UPDATE visibility SET visible=0 WHERE feature='virtualPet'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }
    if ($_POST["showVirtualPet"]) {
        $sql = "UPDATE visibility SET visible=1 WHERE feature='virtualPet'";
        if ($result = mysqli_query($conn, $sql)) {
        } else {
            echo '<script>alert("Failed to update database.")</script>';
        }
        header("Refresh:0");
    }


    ?>
</body>

</html>