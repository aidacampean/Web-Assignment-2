
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
require_once('functions.php');
unset($_SESSION['username']);
session_destroy();
$previousPage = $_SERVER['HTTP_REFERER'];
header("Location: $previousPage");
exit;
?>
</body>
</html>
