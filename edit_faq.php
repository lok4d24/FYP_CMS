<?php
session_start();

if( !isset($_SESSION["cms_user"])){
    header('Location: ./login.php');
    exit();
}

if (isset($_POST["submit"])){
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    
    $faq = $_POST['faq'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if( empty($_POST["faq"]) || empty($_POST["question"]) || empty($_POST['answer']) ){
        echo "<script>window.alert(\"請場寫所有項目\");</script>";
    }else{
        $query = "update faq set question='$question', answer='$answer' where id=$faq"; 
        
        $result = mysql_query($query);
        $count = mysql_affected_rows();
        if($count >= 1){
            echo "<script>window.alert(\"修改成功!\");</script>";
            echo "<script>history.go(-2);</script>";
        }else{
            echo "<script>window.alert(\"修改發生錯誤!\");</script>";
        } 
    }
}


if( !isset($_POST['faq']) || !is_numeric($_POST['faq']) ){
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
if( isset($_POST['faq']) && is_numeric($_POST['faq']) ){
    
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    $faq = $_POST['faq'];
    
    $query = "select * from faq where id='$faq'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    if($count != 1){
        echo'
        <div class="alert alert-warning">
            <strong>警告!</strong>沒有此問題, 請重新進入頁面。
        </div>';
    }else{     
?>
    <div id="wrapper">
        
        <?php include "nav.php"; ?>
        <?php  
            while ($row = mysql_fetch_assoc($result)) {
                $question = $row['question'];
                $answer = $row['answer'];
            }
        ?>
        <div id="page-wrapper" >
            <div class="row">
                <div class="col-lg-6">

                    <h4><u>請修改以下資料</u></h4><br>
                   
                    <form role="form" action="edit_faq.php" method="post">
                    
                        <label>問題</label>
                        <input class="form-control" name="question" value=<?php echo $question ;?> >
                        <br>
                        <label>答案</label>
                        <input class="form-control" name="answer" value=<?php echo $answer ;?> >
                        <br>
                        <input type="hidden" name="faq" value=<?php echo $_POST['faq']?> >
                        <input type="submit" value="確認" name="submit" class="btn btn-lg btn-success"> 
                    </form>
                    <br>
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
