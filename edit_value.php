<?php
session_start();

if( !isset($_SESSION["cms_user"])){
    header('Location: ./login.php');
    exit();
}

if (isset($_POST["text"])){
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    $member = $_POST['member'];
    $value = $_POST['text'];
    if($value >= 500)
        $query = "update member set value=value+'$value', status='activate', class='High' where id='$member'";
    else
        $query = "update member set value=value+'$value', status='activate' where id='$member'";
    $result = mysql_query($query);
    $count = mysql_affected_rows();
    if($count >= 1)
        echo "<script>window.alert(\"增值成功!\");</script>";
    else
        echo "<script>window.alert(\"增值發生錯誤!\");</script>";
       
    echo "<script>history.go(-2);</script>";
}


if( !isset($_POST['member']) || !is_numeric($_POST['member']) ){
    echo'
    <div class="alert alert-warning">
        <strong>警告!</strong>   連結錯誤, 請重新進入頁面。
    </div>';
}
?>

<!DOCTYPE html>
<html lang="en">

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

    <!-- Timeline CSS -->
    <link href="./dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./bower_components/morrisjs/morris.css" rel="stylesheet">

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
<?php
if( isset($_POST['member']) && is_numeric($_POST['member']) ){
    
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    $member = $_POST['member'];
    
    $query = "select * from member where id='$member'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    if($count != 1){
        echo'
        <div class="alert alert-warning">
            <strong>警告!</strong>沒有此會員, 請重新進入頁面。
        </div>';
    }else{     
?>
    <div id="wrapper">
        
        <?php include "nav.php"; ?>
        
        <div id="page-wrapper" >
            <div class="row">
                <div class="col-lg-8">
                    <?php 
                    if ( isset($_POST["activate"]) ){ ?>
                        <h1 class="page-header">激活帳號 (會員名稱:<?php echo $_POST['member_name'] ;?>)</h1>
                    <?php }else{ ?>
                        <h1 class="page-header">增值服務 (會員名稱:<?php echo $_POST['member_name'] ;?>)</h1>
                    <?php } ?>
                    <h4>請輸入增值金額</h4>
                    <form role="form" action="edit_value.php" method="post">
                        
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="text" id="optionsRadios1" value="50" checked>$ 50
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="text" id="optionsRadios2" value="100">$ 100
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="text" id="optionsRadios3" value="500">$ 500
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="text" id="optionsRadios3" value="1000">$ 1000
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="member" value=<?php echo $_POST['member']?> >
                        <input type="submit" value="確認" class="btn btn-lg btn-success"> 
                    </form> 
                </div>
            </div>            
        </div>
    </div>
<?php
    }
}
?>   
    
    <!-- jQuery -->
    <script src="./bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="./bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="./bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->


</body>

</html>
