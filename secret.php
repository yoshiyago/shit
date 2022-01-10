<?php
session_start();
echo "<h1>Hello ".$_SESSION['account_number'].", this is secret.</h1>";
?>