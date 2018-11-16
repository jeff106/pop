<?php
require_once '../configuration/constant.php';
include '../configuration/bdd_connection.php';

session_start();
//var_dump($_SESSION);die;

$template = 'utilisateur';
include '../layout.phtml';