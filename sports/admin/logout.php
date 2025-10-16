<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title><?php
session_start();
unset($_SESSION['admin']);
$_SESSION['alert']['message'] = 'You have been logged out.';
header("Location:index.php");
?>