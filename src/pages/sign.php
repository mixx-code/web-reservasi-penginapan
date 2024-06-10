<?php @$page = $_GET['page']; ?>

<div class="sign">
    <?php include "../components/banner_login.php"; ?>
    <?php $page == 'sign-up' ? include "../components/form_sign_up.php" : include "../components/form_sign_in.php"; ?>
</div>