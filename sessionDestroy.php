<?php
ob_start();
session_start();
session_destroy();
header("Location: login.php");
exit;
ob_end_flush();