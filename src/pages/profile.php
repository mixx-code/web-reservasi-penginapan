<?php

// // Check if the user is already logged in
// if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
//     // Redirect to the dashboard or desired page
//     header("Location: ../pages/main_layout.php?page=availability");
//     exit();
// }

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $sql = "SELECT * FROM tbl_user WHERE id_user = $id_user";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
}
?>


<div class="form-profile">
    <h1 class="title">Sign Up</h1>
    <form action="../config/proses/edit_profile.php" method="post">
        <input type="hidden" class="form-input" placeholder="Full Name" required name="id_user" maxlength="100" value="<?= $row['id_user'] ?>">
        <input type="text" class="form-input" placeholder="Full Name" required name="fullname" maxlength="100" value="<?= $row['fullname'] ?>">
        <input type="text" class="form-input" placeholder="Username" required name="username" maxlength="15" value="<?= $row['username'] ?>">
        <input type="password" class="form-input" placeholder="Password baru" name="password" maxlength="12"">
        <input type=" email" class="form-input" placeholder="Email" required name="email" maxlength="100" value="<?= $row['email'] ?>">
        <input type="tel" class="form-input" placeholder="Phone" required name="phone" maxlength="15" value="<?= $row['phone'] ?>">
        <button type="submit" class="btn-submit">Edit Profile</button>
    </form>
</div>