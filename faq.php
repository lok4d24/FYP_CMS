<?php
session_start();

if( !isset($_SESSION["cms_user"])){
    header('Location: ./login.php');
    exit();
}

//if( isset($_POST["delete"])){
//    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
//    mysql_query("SET NAMES utf8"); 
//    mysql_select_db("fyp", $link) or die("Could not select database");
//    $id = $_POST["delete"];
//    $query = "delete from carpark where id='$id'";
//    $result = mysql_query($query);
//    $num_rows =  mysql_affected_rows();
//    if ($num_rows > 0 )
//        echo "<script>window.alert(\"刪除成功!\");</script>";
//    else
//        echo "<script>window.alert(\"刪除失敗!\");</script>";
//}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
form {
    display: inline-block;
}
</style>

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

    <!-- DataTables CSS -->
    <link href="./bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="./bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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
    <div id="wrapper">
        
        <?php include "nav.php"; ?>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">停車場資料</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>編號</th>
                                            <th>問題</th>
                                            <th>答案</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
                                        mysql_query("SET NAMES utf8"); 
                                        mysql_select_db("fyp", $link) or die("Could not select database");
                                        $query = "select * from faq";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_assoc($result)) {
                                            echo '<tr>
                                                      <td>
                                                        <form action="http://localhost/cms/edit_faq.php" method="post">
                                                           <button class="btn btn-outline btn-primary" type="submit" name="faq" value="'.$row['id'].'">編輯</button>
                                                        </form>
                                                        
                                                        <form onsubmit="return confirm(\'確定刪除?\');" action="http://localhost/cms/faq.php" method="post">
                                                            <button class="btn btn-outline btn-danger" type="submit" name="delete" value="'.$row['id'].'">刪除</button>
                                                        </form>
                                                      </td>
                                                      <td align="center">'.$row['id'].'</td>
                                                      <td>'.$row['question'].'</td>
                                                      <td>'.$row['answer'].'</td>
                                                  </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

    <!-- DataTables JavaScript -->
    <script src="./bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="./bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
