<?php include ('common/header.php')?>
<?php require ('config/config.php') ?>
<?php
//database connection establishment
try {
    $con = mysqli_connect(LOCAL_HOST, USER, PASSWORD, DATABASE);
        if (isset($_POST["submit"])) {
            //create table in not exists
            $createTableIFNotExist = 'select `id` from `attempts` LIMIT 1';
            $tableAttempts = $con->query($createTableIFNotExist);
            if ($tableAttempts === false) {
                $createAtteptsTable = "CREATE TABLE `attempts` (
                                      `id` int(11) NOT NULL,
                                      `created_at` datetime DEFAULT NULL,
                                      `first_name` varchar(255) DEFAULT NULL,
                                      `last_name` varchar(255) DEFAULT NULL,
                                      `student_number` double DEFAULT NULL,
                                      `no_of_attempts` int(11) DEFAULT NULL,
                                      `score` int(11) DEFAULT NULL
                                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
                $createPrimaryKey = "ALTER TABLE `attempts` ADD PRIMARY KEY (`id`);";
                $alterPrimaryKey = "ALTER TABLE `attempts` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
                $createAttemptsTable = $con->query($createAtteptsTable);
                $createPrimaryKey = $con->query($createPrimaryKey);
                $alterPrimaryKey = $con->query($alterPrimaryKey);
            }
            $score = 0;
            if ($_POST['home_town'] === "2") {
                $score = $score + 1;
            }
            if ($_POST['home_country'] === "3") {
                $score = $score + 1;
            }
            if ($_POST['quantity'] === "2011") {
                $score = $score + 1;
            }
            $createdAt = date('Y-m-d H:i:s');
            $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $studentId = $_POST["studentid"];
            $noOfAttempts = 1;
            //check if a student exists
            $checkIfStudentExist = "SELECT `id`,`no_of_attempts` FROM `attempts` WHERE `student_number` = '$studentId'";
            $sqlSearch = $con->query($checkIfStudentExist);
            if ($sqlSearch->num_rows > 0) {
                $resultRow = $sqlSearch->fetch_assoc();
                //check whether his attempts exceeded
                if ($resultRow['no_of_attempts'] < 3) {
                    $id = $resultRow['id'];
                    $noOfAttempts = $resultRow['no_of_attempts'] + 1;
                    $updateQuery = "UPDATE `attempts` SET `created_at`='$createdAt',`first_name`='$firstName',`last_name`='$lastName', `no_of_attempts`=$noOfAttempts,`score`= $score
                                    WHERE `id` = $id";
                    $result = $con->query($updateQuery);
                } else {
                    $result = false;
                    echo '<br><b class="warning_red">Your Attempts Exceeded!!!!!  Please contact the Supervisor</b><br><br><a href="/quiz/index.php">Go Back</a>';
                }
            } else {
                //if student does not exists, then make a new entry
                $insertRecord = "INSERT INTO `attempts`(`created_at`, `first_name`, `last_name`, `student_number`, `no_of_attempts`, `score`) 
                VALUES ('$createdAt' ,'$firstName', '$lastName', $studentId, $noOfAttempts, $score)";
                $result = $con->query($insertRecord);
            }
            if ($result) {
                $con->close();
                header('location:index.php');
            }
        }
        } catch (Exception $e) {
    echo '<b class="warning_red">Something Went Wrong</b><br>';
}
?>