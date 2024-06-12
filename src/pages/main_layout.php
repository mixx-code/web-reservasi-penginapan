<?php include "../components/header.php"; ?>
<?php include "../components/navbar.php"; ?>
<?php
@$page = $_GET['page'];
// echo $page;
if (!empty($page)) {
    // @$id = $_GET['id'];
    switch ($page) {
        case 'availability':
            include './availability.php';
            break;
        case 'about':
            include './about.php';
            break;
        case 'contact':
            include './contact.php';
            break;
        case 'profile':
            // Check if user is logged in
            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
                include './profile.php';
            } else {
                echo "<script>alert('Anda belum melakukan Login, silahkan login terlebih dahulu !!'); window.location.href='./main_layout.php?page=sign-in';</script>";
                exit();
            }
            break;
        case 'transactions':
            // Check if user is logged in
            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
                include './list_transactions.php';
            } else {
                echo "<script>alert('Anda belum melakukan Login, silahkan login terlebih dahulu !!'); window.location.href='./main_layout.php?page=sign-in';</script>";
                exit();
            }
            break;
        case 'detail-transaction':
            // Check if user is logged in
            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
                include './detail_transaction.php';
            } else {
                echo "<script>alert('Anda belum melakukan Login, silahkan login terlebih dahulu !!'); window.location.href='./main_layout.php?page=sign-in';</script>";
                exit();
            }
            break;
        case 'sign-up':
            include './sign.php';
            break;
        case 'sign-in':
            include './sign.php';
            break;
        default:
            include './availability.php';
            break;
    }
} else {
    include './availability.php';
}
?>

<?php
if ($page != 'sign-up' && $page != 'sign-in') {
    include "../components/footer.php";
} else {
    '';
}
?>
