<?php
session_start();

if( !isset($_SESSION["cms_user"])){
    header('Location: ./login.php');
    exit();
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

    <title>City Carpark CMS</title>

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
<!-- ======================================================================================================== -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="addvalue.php">City Carpark CMS</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="addvalue.php"><i class="fa fa-money fa-fw"></i> Add Value<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="carpark.php"><i class="fa fa-truck fa-fw"></i> Carpark<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-meh-o fa-fw"></i> Member<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-question-circle fa-fw"></i> FAQ<span class="fa arrow"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<!-- ======================================================================================================== -->
        

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <h1 class="page-header">增值服務</h1>
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th></th>
                                <th>會員名稱</th>
                                <th>登入名稱</th>
                                <th>餘額</th>
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
                                          <td>
                                            <a href="http://localhost/cms/edit_value.php?member='.$row['id'].'" 
                                                onclick="javascript:void window.open(\'http://localhost/cms/edit_value.php?member='.$row['id'].'\',\'testing\',\'width=700,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=1,left=0,top=0\');return false;" class="btn btn-outline btn-warning">增值</a>
                                          </td>
                                          <td>'.$row['name_zh'].'</td>
                                          <td>'.$row['login'].'</td>
                                          <td>'.$row['value'].'</td>
                                      </tr>';

                            }
                            ?>
                        </tbody>
                    </table>
                    
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
