<?php
session_start();

if( isset($_SESSION["cms_user"])){
    header('Location: ./member.php');
    exit();
}else{
    header('Location: ./login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<!--<meta http-equiv="refresh" content="0;url=pages/index.html">-->
<title>城市停車場内容管理系统</title>
    
</head>
<body>
Go to <a href="index.php">index.php</a>
</body>
</html>
