<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';
session_start();
session_destroy();
header('Location: ' . PATH_SITE . 'index.php');
exit();