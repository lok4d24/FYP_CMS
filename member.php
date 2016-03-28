<?php
session_start();

if( !isset($_SESSION["cms_user"])){
    header('Location: ./login.php');
    exit();
}

if( isset($_POST["unlock"]) ){
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    $member = $_POST['unlock'];
    $query = "update member set badRecord=0 where id='$member'";
    
    $result = mysql_query($query);
    $count = mysql_affected_rows();
    if($count >= 1)
        echo "<script>window.alert(\"解鎖成功!\");</script>";
    else
        echo "<script>window.alert(\"解鎖發生錯誤!\");</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
td {
    text-align: center;
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
    <div id="wrapper">
        
        <?php include "nav.php"; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">會員列表</h1>
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
                                            <th>會員名稱</th>
                                            <th>登入名稱</th>
                                            <th>餘額</th>
                                            <th>級別</th>
                                            <th>狀態</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
                                        mysql_query("SET NAMES utf8"); 
                                        mysql_select_db("fyp", $link) or die("Could not select database");
                                        $query = "select * from member";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_assoc($result)) {
                                            echo '<tr>
                                                      <td>';
                                                          if($row['status'] == "activate" && $row['badRecord'] < 3){
                                                              echo '<form action="http://localhost/cms/edit_value.php" method="post">
                                                                       <input type="hidden" name="member_name" value="'.$row['name_zh'].'">
                                                                       <button class="btn btn-outline btn-primary" type="submit" name="member" value="'.$row['id'].'">增值</button>
                                                                    </form>';
                                                          }else if($row['status'] == "inactivate"){
                                                              echo '<form action="http://localhost/cms/edit_value.php" method="post">
                                                                       <input type="hidden" name="activate">
                                                                       <input type="hidden" name="member_name" value="'.$row['name_zh'].'">
                                                                       <button class="btn btn-outline btn-warning" type="submit" name="member" value="'.$row['id'].'">激活</button>
                                                                    </form>';
                                                          }else if($row['badRecord'] >=3){
                                                              echo '<form onsubmit="return confirm(\'確定解鎖?\');" action="http://localhost/cms/member.php" method="post">
                                                                       <button class="btn btn-outline btn-danger" type="submit" name="unlock" value="'.$row['id'].'">解鎖</button>
                                                                    </form>';
                                                          }
                                            echo '</td>
                                                      <td>'.$row['name_zh'].'</td>
                                                      <td>'.$row['login'].'</td>
                                                      <td>'.$row['value'].'</td>';
                                                      if ($row['class']=='High')
                                                          echo '<td>高級</td>';
                                                      else
                                                          echo '<td>正常</td>';

                                                      if($row['status'] == "activate" && $row['badRecord'] < 3){
                                                          echo '<td>正常</td>';
                                                      }else if($row['status'] == "inactivate"){
                                                          echo '<td>待激活</td>';
                                                      }else if($row['badRecord'] >=3){
                                                          echo '<td>已鎖</td>';
                                                      }
                                            echo '</tr>';

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
