<?php
session_start();

include("sesion.php");
include("header.php");

echo $_SESSION['username'];

include('footer.php');
