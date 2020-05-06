<?php
session_start();
unset($_SESSION["fichasMostradas"]);
session_destroy();

header("Location: index.php");
?>