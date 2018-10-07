<?php include('header.php') ?>
<?php require ('../config/config.php') ?>
<?php
try {
    session_start();
    if (isset($_SESSION['id'])) {
//database connection establishment
        $con = mysqli_connect(LOCAL_HOST, USER, PASSWORD, DATABASE);
        $checkLogin = "select * from `attempts`";
        $result = $con->query($checkLogin);
        echo "<table style='margin: 20px' border='1'>
            <tr>
                <th>Sl NO</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Student ID</th>
                <th>No of Attempts</th>
                <th>Score</th>
            </tr>";
        if ($result->num_rows > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['student_number'] . "</td>";
                echo "<td>" . $row['no_of_attempts'] . "</td>";
                echo "<td>" . $row['score'] . "</td>";
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        } else {
            echo "<tr>";
            echo "<td>No Data Available</td>";
            echo "</tr>";
        }
        if ($_POST['update']) {
            $studentId = $_POST['student_id'];
            $score = $_POST['score'];
            $updateQuery = "UPDATE `attempts` SET `score` = '$score' WHERE `student_number` = '$studentId'";
            $updateRecord = $con->query($updateQuery);
            if ($updateRecord === false) {
                echo "<br><b class='warning_red'> Student Record not found </b>";
            }
            header('location:update_record.php');
        }
    } else {
        echo '<h1 class="warning_red"> Un-Authorized </h1>' ;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<?php session_start();
if (isset($_SESSION['id'])) { ?>
    <div class="login">
        <form action="<?php $_PHP_SELF ?>" method="post">
            <input type="text" placeholder="StudentID" name="student_id" id="username">
            <input type="number" min="0" max="10" placeholder="New Score" name="score" id="username">
            <input class="login_button" type="submit" name="update" value="Update">
        </form>
    </div>
<?php }  ?>
<?php include('../common/footer.php') ?>


