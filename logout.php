<?php
session_start(); //$_session['full_name'] = "John Doe";
session_unset(); //$_session['full_name']
session_destroy();

header("location: login.php");
exit;
?>