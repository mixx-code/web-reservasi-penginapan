<?php include "../config/koneksi.php"; ?>
<?php
// Memeriksa apakah pengguna sudah login
// Memeriksa apakah pengguna sudah login
if (isset($_SESSION['username']) && isset($_SESSION['id_user']) && isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];
    $isLogin = true;
} else {
    $isLogin = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/form_sign.css">
    <link rel="stylesheet" href="../../asset/css/sign.css">
    <link rel="stylesheet" href="../../asset/css/main.css">
    <link rel="stylesheet" href="../../asset/css/navbar.css">
    <link rel="stylesheet" href="../../asset/css/banner_login.css">
    <link rel="stylesheet" href="../../asset/css/hero.css">
    <link rel="stylesheet" href="../../asset/css/content.css">
    <link rel="stylesheet" href="../../asset/css/footer.css">
    <link rel="stylesheet" href="../../asset/css/about.css">
    <link rel="stylesheet" href="../../asset/css/contact.css">
    <link rel="stylesheet" href="../../asset/css/transaction.css">
    <link rel="stylesheet" href="../../asset/css/form_profile.css">
    <title></title>
</head>

<body>
    <div class="main">