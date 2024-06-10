<?php
@$page = $_GET['page'];

if ($page != 'sign-up' && $page != 'sign-in') {


?>
    <nav>
        <div class="logo-menu">
            <a href=""><img src="../../asset/img/logo.png" alt="logo" class="logo"></a>
            <div class="menu">
                <a href="../pages/main_layout.php?page=availability" class="default-menu <?= $page == 'availability' ? 'menu-actived' : '' ?>">Availability</a>
                <a href="../pages/main_layout.php?page=about" class="default-menu <?= $page == 'about' ? 'menu-actived' : '' ?>">About</a>
                <a href="../pages/main_layout.php?page=contact" class="default-menu <?= $page == 'contact' ? 'menu-actived' : '' ?>">Contact</a>
            </div>
        </div>
        <?php
        if ($isLogin) { ?>
            <a class="logout" onclick="confirmLogout()">Logout</a>
        <?php } else { ?>
            <a href="../pages/main_layout.php?page=sign-in" style="text-decoration: none;font-size: 24px;font-weight: 500; color: #B19753;">login</a>
        <?php } ?>
    </nav>

<?php } else { ?>
    <nav class="nav-sign">
        <div class="logo-menu">
            <img src="../../asset/img/logo.png" alt="logo" class="logo">
        </div>
    </nav>

<?php } ?>



<script>
    function confirmLogout() {
        if (confirm('Apa anda mau logout?')) {
            window.location.href = '../config/proses/logout.php';
        }
    }
</script>