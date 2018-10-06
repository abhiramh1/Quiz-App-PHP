<?php include('header.php') ?>

<?php session_start();
if (isset($_SESSION['id'])) { ?>
   <h1>Welcome <?php echo $_SESSION['id'] ?></h1>
<?php
} else {
    echo '<h1 class="warning_red"> Un-Authorized </h1>' ;
} ?>
<?php include('../common/footer.php') ?>