<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Sticky Notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body id="body">
    <form action="" method="POST">
        <input class="stickyNotes" id="stickyNotes" type="submit" name="newNote" value="Sticky Notes">
    </form>

    <div class="notesSpace" id="notesSpace">
        <form action="" method="POST">

            <!-- adapted from https://www.w3schools.com/php/php_mysql_select.asp -->
            <?php
            // This is using SQL to interact with a MySQL database, which I can also interact with at localhost/phpmyadmin/
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sticky_notes";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // send an SQL query to the database
            $sql = "SELECT * FROM test";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<form action="" method="POST">
                    <input type="text" name="note" id="' . $row["element"] . '" value="' . $row["text"] . '" class="newNote"/>
                    <input type="submit" name="updateNotes' . $row["id"] . '" hidden>
                    </form>';
                }
            } else {
                // There is nothing in the table
                echo "0 results";
            }


            if (isset($_POST['newNote'])) {

                // find the most recent id in the database
                $sql = "SELECT * FROM test ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                }
                $id = $id + 1;

                // find the number of rows, so the notes can't exceed 5
                // from https://www.geeksforgeeks.org/how-to-count-rows-in-mysql-table-in-php/
                $sql = "SELECT * from test";
                if ($result = mysqli_query($conn, $sql)) {
                    // Return the number of rows in result set
                    $rowcount = mysqli_num_rows($result);
                }

                if ($rowcount < 5) {

                    $sql = "INSERT INTO test (id, element, text) VALUES ($id,'note$id','New Note')";
                    if ($updateDatabase = mysqli_query($conn, $sql)) {
                    } else {
                        echo "Failed to update database";
                    }

                    header("Refresh:0");

                    // $sql = "SELECT element, text FROM test WHERE id = $id";
                    // $result = mysqli_query($conn, $sql);
            
                    // if ($result->num_rows > 0) {
                    //     // output data of the new row
                    //     if ($row == $row[$id]) {
                    //         echo '<input type="text" name="note" id="' . $row["element"] . '" value="' . $row["text"] . '" class="newNote"/>';
                    //     }
                    // } else {
                    //     // There is nothing in the table
                    //     echo "0 results";
                    // }
                }
            }

            // for loop to dynamically handle the infinite number of possible submit names
            // only allows for 100 possible ids, otherwise it would be infinite and the program will break
            for ($x = 0; $x <= 100; $x++) {
                if ($_POST["updateNotes$x"]) {
                    $textContent = $_POST['note'];
                    //echo '<script>alert("New text content: ' . $textContent . '")</script>';
            
                    if ($textContent == '') {
                        $sql = "DELETE FROM test WHERE id=$x";
                        if ($result = mysqli_query($conn, $sql)) {
                        } else {
                            echo '<script>alert("Failed to delete note")</script>';
                        }
                    } else {
                        $sql = "UPDATE test SET text='$textContent' WHERE id=$x";
                        if ($result = mysqli_query($conn, $sql)) {
                        } else {
                            echo '<script>alert("Failed to update text content")</script>';
                        }
                    }

                    header("Refresh:0");
                }
            }
            ?>
            <!-- <input type="submit" name="updateNotes" hidden> -->
        </form>
    </div>
</body>

</html>