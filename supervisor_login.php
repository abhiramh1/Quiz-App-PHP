<?php
try {
    session_start();
//database connection establishment
    $con = mysqli_connect("localhost", "root", "abhiram", "quiz_test");
    if ($_POST["login"]) {
        $userName = $_POST["user_name"];
        $password = $_POST["password"];
        $checkLogin = "select `id` from `users` where user_name='$userName' and password = '$password' and `status` = 1";
        $result = $con->query($checkLogin);
        if ($result->num_rows > 0) {
            $_SESSION['counter'] = 1; //set session variable
            $_SESSION['id'] = $userName;
            header('location:supervisor_pages/manage.php');
        } else {
            echo '<b class="warning_red"> Invalid Credentials </b>';
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php include('common/header.php') ?>
<div class="login">
    <form action="<?php $_PHP_SELF ?>" method="post">
        <input type="text" placeholder="Username" name="user_name" id="username">
        <input name="password" type="password" placeholder="Password" id="password">
        <input class="login_button" type="submit" name="login" value="Sign In">
    </form>
</div>
<?php include('common/footer.php') ?>


