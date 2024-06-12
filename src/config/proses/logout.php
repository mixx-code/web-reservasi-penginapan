<?php
session_start();
session_unset();
session_destroy();
echo "<script>window.location.href='../../pages/main_layout.php?page=availability';</script>";
exit();
