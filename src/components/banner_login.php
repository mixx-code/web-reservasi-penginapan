<?php
@$page = $_GET['page'];

$imageSrc = $page == 'sign-in' ? "../../asset/img/sign-in.png" : "../../asset/img/sign-up.png";
?>

<div class="banner">
    <img src="<?php echo $imageSrc; ?>" alt="gambar" class="gambar">
</div>