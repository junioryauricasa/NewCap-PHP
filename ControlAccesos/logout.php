<?php
session_start();
session_destroy();
unset($_SESSION['usuario']);
echo "<script>location.href='index.php';</script>";
?>




