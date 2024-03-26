<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("submitted");
session_start();
header("Location: login.php");
?>