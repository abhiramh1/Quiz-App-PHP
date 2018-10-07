<?php include('common/header.php') ?>
<?php require ('config/config.php') ?>
<?php
try {
    session_start();
//database connection establishment
    $con = mysqli_connect(LOCAL_HOST, USER, PASSWORD, DATABASE);
    if ($_POST["login"]) {
        $userName = $_POST["user_name"];
        $password = $_POST["password"];
        $checkLogin = "select `id` from `users` where user_name='$userName' and password = '$password' and `status` < 3";
        $result = $con->query($checkLogin);
        $checkInvalidLoginAttemptsQuery = "SELECT `id`, `status` FROM `users` WHERE user_name = '$userName'";
        $checkInvalidLoginAttempts = $con->query($checkInvalidLoginAttemptsQuery);
        $checkInvalidLoginAttemptsResult = $checkInvalidLoginAttempts->fetch_assoc();

        if ($checkInvalidLoginAttemptsResult['status'] < 3) {


            if ($result->num_rows === 0 && $checkInvalidLoginAttempts->num_rows === 1) {
                $status = $checkInvalidLoginAttemptsResult['status'] + 1;
                $updateStatusQuery = "UPDATE `users` SET `status` = $status
                                    WHERE `user_name` = '$userName'";
                $updateStatus = $con->query($updateStatusQuery);
            }
            if ($result->num_rows > 0) {
                $_SESSION['counter'] = 1; //set session variable
                $_SESSION['id'] = $userName;
                header('location:supervisor_pages/manage.php');
            } else {
                echo '<b class="warning_red"> Invalid Credentials </b>';
            }
        } else {
            echo "<br><b class='warning_red'> Account Blocked due to multiple invalid attempts Please Contact your System Administrator</b>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<div class="login">
    <form action="<?php $_PHP_SELF ?>" method="post">
        <input type="text" placeholder="Username" name="user_name" id="username">
        <input name="password" type="password" placeholder="Password" id="password">
        <input class="login_button" type="submit" name="login" value="Sign In">
    </form>
</div>
<?php include('common/footer.php') ?>


