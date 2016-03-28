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
    
    $carpark = $_POST['carpark'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $long = $_POST['long'];
    $lat = $_POST['lat'];
    $area = $_POST['area'];
    $district = $_POST['district'];
    $addr = $_POST['addr'];
    $hr = $_POST['hr'];
    $month = $_POST['month'];
    
//    echo $name;
//    echo ' ';
//    echo $carpark;
//    echo ' ';
//    echo $tel;
//    echo ' ';
//    echo $long;
//    echo ' ';
//    echo $lat;
//    echo ' ';
//    echo $area;
//    echo ' ';
//    echo $district;
//    echo ' ';
//    echo $addr;
//    echo ' ';
//    echo $hr;
//    echo ' ';
//    echo $month;

    if( empty($_POST["carpark"]) || empty($_POST["tel"]) || empty($_POST['name']) ||
        empty($_POST["long"]) || empty($_POST["lat"]) || 
        empty($_POST["area"]) || empty($_POST["district"]) || 
        empty($_POST["addr"]) || empty($_POST["hr"]) || empty($_POST["month"]) ){
        echo "<script>window.alert(\"請場寫所有項目\");</script>";
    }else{
        $query = "update carpark set name_zh='$name', telephone='$tel', lat='$lat', longi='$long', district_code='$district', area_code='$area', addr_zh='$addr', hourly_price='$hr', monthly_price='$month' where id=$carpark"; 
        
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


if( !isset($_POST['carpark']) || !is_numeric($_POST['carpark']) ){
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
if( isset($_POST['carpark']) && is_numeric($_POST['carpark']) ){
    
    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
    mysql_query("SET NAMES utf8"); 
    mysql_select_db("fyp", $link) or die("Could not select database");
    $carpark = $_POST['carpark'];
    
    $query = "select * from carpark where id='$carpark'";
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
        <?php  
            while ($row = mysql_fetch_assoc($result)) {
                $name = $row['name_zh'];
                $tel = $row['telephone'];
                $long = $row['longi'];
                $lat = $row['lat'];
                $area = $row['area_code'];
                $district = $row['district_code'];
                $addr = $row['addr_zh'];
                $hr = $row['hourly_price'];
                $month = $row['monthly_price'];
            }
        ?>
        <div id="page-wrapper" >
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">正在編輯 &lt;<?php echo $_POST['carpark_name'] ;?>停車場&gt;</h1>

                    
                    <h4><u>請修改以下資料</u></h4><br>
                   
                    <form role="form" action="edit_carpark.php" method="post">
                    
                        <label>停車場名稱</label>
                        <input class="form-control" name="name" value=<?php echo $name ;?> >
                        <br>
                        <label>地址</label>
                        <input class="form-control" name="addr" value=<?php echo $addr ;?> >
                        <br>
                        <div class="form-group">
                            <label>地區</label>
                            <select class="form-control" name="area">
                            <?php 
                                    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
                                    mysql_query("SET NAMES utf8"); 
                                    mysql_select_db("fyp", $link) or die("Could not select database");
                                    $query = "select * from area";
                                    $result = mysql_query($query);
                                    while ($row = mysql_fetch_assoc($result)) {
                                        if ($area == $row['area_code']){
                                            echo '<option value='.$row['area_code'].' selected>'.$row['area_name_zh'].'</option>';
                                        }else{
                                            echo '<option value='.$row['area_code'].' >'.$row['area_name_zh'].'</option>';
                                        }
                                    }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>區域</label>
                            <select class="form-control" name="district">
                            <?php 
                                    $link = mysql_connect("localhost","root","12345678") or die("Could not connect to MySQL server");
                                    mysql_query("SET NAMES utf8"); 
                                    mysql_select_db("fyp", $link) or die("Could not select database");
                                    $query = "select * from district";
                                    $result = mysql_query($query);
                                    while ($row = mysql_fetch_assoc($result)) {
                                        if ($district == $row['district_code']){
                                            echo '<option value='.$row['district_code'].' selected>'.$row['district_name_zh'].'</option>';
                                        }else{
                                            echo '<option value='.$row['district_code'].' >'.$row['district_name_zh'].'</option>';
                                        }
                                    }
                            ?>
                            </select>
                        </div>

                        <label>電話</label>
                        <input class="form-control" name="tel" value=<?php echo $tel ;?> >
                        <br>
                        <label>經度</label>
                        <input class="form-control" name="long" value=<?php echo $long ;?> >
                        <br>
                        <label>緯度</label>
                        <input class="form-control" name="lat" value=<?php echo $lat ;?> >
                        <br>
                        <label>月租</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="month" value=<?php echo $month ;?> >
                        </div>
                        <br>
                        <label>時租</label>
                        <div class="form-group input-group">          
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="hr" value=<?php echo $hr ;?> >
                        </div>
                        <br>
                        <input type="hidden" name="carpark" value=<?php echo $_POST['carpark']?> >
                        <input type="submit" value="確認" name="submit" class="btn btn-lg btn-success"> 
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
