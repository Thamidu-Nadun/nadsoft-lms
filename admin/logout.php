<?php
session_start();

// Clear session data
session_unset();
session_destroy();

// Clear cookies
setcookie('admin_id', '', time() - 3600, '/');
setcookie('admin_name', '', time() - 3600, '/');
setcookie('admin_mail', '', time() - 3600, '/');
setcookie('admin_status', '', time() - 3600, '/');
setcookie('admin_avatar', '', time() - 3600, '/');

// Redirect to login page
header('Location: index.php');
exit;
?>
