<?php include ('header.php') ?>

<?php
try {
    session_start();
//database connection establishment
    $con = mysqli_connect("localhost", "root", "abhiram", "quiz_test");
        $userName = $_POST["user_name"];
        $password = $_POST["password"];
        $checkLogin = "select * from `attempts`";
        $result = $con->query($checkLogin);
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
            echo "Something went wrong";
        }

} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php include ('../common/footer.php') ?>