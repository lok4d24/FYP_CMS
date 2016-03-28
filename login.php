<?php
session_start();

if (isset($_POST["login"]) && !empty($_POST["login"]) && isset($_POST["password"]) && !empty($_POST["password"])){
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    $password = $_POST['password'];
    $login = $_POST['login'];
    $query = "select * from cms_user where login='$login'and password='$password'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    if($count==1){
        while ($row = mysql_fetch_assoc($result)) {
            $_SESSION["cms_user"]=$row['name_ch'];
        }
        header('Location: ./index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<!--<html lang="en">-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>城市停車場内容管理系统</title>

    <!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">請登入</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post">
                            <fieldset>
                                <?php
                                    if (!isset($_POST["login"]) && !isset($_POST["password"]) ) {
                                        echo '<div class="form-group">
                                                <input class="form-control" placeholder="登入帳號" name="login" type="login" autofocus>
                                              </div>
                                              <div class="form-group">
                                                <input class="form-control" placeholder="密碼" name="password" type="password" value="">
                                              </div>';
                                    }else {
                                        if (empty($_POST["login"]) && empty($_POST["password"])){ 
                                            echo '<div class="form-group has-error">
                                                    <label class="control-label" for="inputError">登入帳號不能留空</label>
                                                    <input class="form-control" placeholder="登入帳號" name="login" type="login" autofocus>
                                                  </div>
                                                  <div class="form-group has-error">
                                                    <label class="control-label" for="inputError">密碼不能留空</label>
                                                    <input class="form-control" placeholder="密碼" name="password" type="password" value="">
                                                  </div>';
                                        }else if (!empty($_POST["login"]) && empty($_POST["password"])){ 
                                            echo '<div class="form-group">
                                                    <input class="form-control" placeholder="登入帳號" name="login" type="login" value='.$_POST["login"].'>
                                                  </div>
                                                  <div class="form-group has-error">
                                                    <label class="control-label" for="inputError">密碼不能留空</label>
                                                    <input class="form-control" placeholder="密碼" name="password" type="password" value="" autofocus>
                                                  </div>';
                                        }else if (empty($_POST["login"]) && !empty($_POST["password"])){ 
                                            echo '<div class="form-group has-error">
                                                    <label class="control-label" for="inputError">登入帳號不能留空</label>
                                                    <input class="form-control" placeholder="登入帳號" name="login" type="login" autofocus>
                                                  </div>
                                                  <div class="form-group">
                                                    <input class="form-control" placeholder="密碼" name="password" type="password" value='.$_POST["password"].'>
                                                  </div>';
                                        }else{
                                            echo '<div class="form-group has-error">
                                                    <label class="control-label" for="inputError">登入帳號/密碼不正確</label>
                                                  </div>';
                                            echo '<div class="form-group">
                                                    <input class="form-control" placeholder="登入帳號" name="login" type="login" autofocus>
                                                  </div>
                                                  <div class="form-group">
                                                    <input class="form-control" placeholder="密碼" name="password" type="password" value="">
                                                  </div>';   
                                        }
                                    }
                                ?>                                
								</br>
                                <input type="submit" value="登入" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

</body>

</html>
