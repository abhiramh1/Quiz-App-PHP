<?php include ('header.php') ?>
<?php require ('../config/config.php') ?>
<?php
try {
    session_start();
    if (isset($_SESSION['id'])) {
//database connection establishment
        $con = mysqli_connect(LOCAL_HOST, USER, PASSWORD, DATABASE);
        $checkLogin = "select * from `attempts` WHERE no_of_attempts = 1 AND score = 3";
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
    } else {
        echo '<h1 class="warning_red"> Un-Authorized </h1>' ;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php include ('../common/footer.php') ?>