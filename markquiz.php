<?php
//database connection establishment
try {
    $con = mysqli_connect("localhost", "root", "abhiram", "quiz_test");
        if (isset($_POST["submit"])) {
            $createdAt = date('Y-m-d H:i:s');
            $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $studentId = $_POST["studentid"];
            $noOfAttempts = 1;
            $score = 12;
            //check if a student exists
            $checkIfStudentExist = "SELECT `id`,`no_of_attempts` FROM `attempts` WHERE `student_number` = '$studentId'";
            $sqlSearch = $con->query($checkIfStudentExist);
            if ($sqlSearch->num_rows > 0) {
                $resultRow = $sqlSearch->fetch_assoc();
                //check whether his attempts exceeded
                if ($resultRow['no_of_attempts'] <= 3) {
                    $id = $resultRow['id'];
                    $noOfAttempts = $resultRow['no_of_attempts'] + 1;
                    $updateQuery = "UPDATE `attempts` SET `created_at`='$createdAt',`first_name`='$firstName',`last_name`='$lastName', `no_of_attempts`=$noOfAttempts,`score`= $score
                               WHERE `id` = $id";
                    $result = $con->query($updateQuery);
                } else {
                    $result = false;
                    echo 'Your Attempts Exceeded';
                }
            } else {
                //if student does not exists, then make a new entry
                $insertRecord = "insert into `attempts`(`created_at`, `first_name`, `last_name`, `student_number`, `no_of_attempts`, `score`) 
                value ('$createdAt' ,'$firstName', '$lastName', $studentId, $noOfAttempts, $score)";
                $result = $con->query($insertRecord);
            }
            if ($result) {
                $con->close();
                header('location:index.php');
            } else {
                echo 'Something went wrong';
            }
        }
} catch (Exception $e) {
    echo 'Something went wrong';
}
?>