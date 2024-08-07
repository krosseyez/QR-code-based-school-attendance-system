<?php
require_once 'config.inc.php';
session_destroy();

// Redirect to login page
header("Location:../index.php");
exit;