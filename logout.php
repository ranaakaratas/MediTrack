<?php
session_start();
session_unset();
session_destroy();

// Redirect to login view after logging out
header("Location: login.php");
exit();