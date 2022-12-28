<?php
session_start();
include('functions.php');
    unset($_SESSION['IS_LOGIN']);
    unset($_SESSION['ADMIN']);
    unset($_SESSION['MESS_ADMIN']);
    unset($_SESSION['EMAIL']);
    unset($_SESSION['MESSNAME ']);
redirect('login.php');
?>