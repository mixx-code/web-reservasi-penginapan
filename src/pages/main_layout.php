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
        case 'transactions':
            include './list_transactions.php';
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