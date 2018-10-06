<?php include('header.php') ?>
<?php
try {
    session_start();
//database connection establishment
    $con = mysqli_connect("localhost", "root", "abhiram", "quiz_test");
    if ($_POST["search"]) {
        $studentNameOrId = $_POST["student_name"];
        $nameSplit = explode(" ",$studentNameOrId);
        $firstName = $nameSplit[0];
        $lastName = $nameSplit[1];
        $getStudentDetails = "select `id`, `first_name`, `last_name`, `student_number`,`score`,`no_of_attempts` from `attempts` where student_number = '$studentNameOrId' 
                       or (first_name = '$firstName' and `last_name` = '$lastName')";
        $result = $con->query($getStudentDetails);

        if ($result->num_rows > 0) {
            echo "<table style='margin: 20px' border='1'>
                    <tr>
                    <th>Sl NO</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Student ID</th>
                    <th>No of Attempts</th>
                    <th>Score</th>
                    </tr>";
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
            echo '<b class="warning_red"> Student Details not found </b>';
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<div class="login">
    <form action="<?php $_PHP_SELF ?>" method="post">
        <input type="text" placeholder="Student Name / Number" name="student_name" id="username">
        <input class="login_button" type="submit" name="search" value="Search">
    </form>
</div>
<?php include('../common/footer.php') ?>


