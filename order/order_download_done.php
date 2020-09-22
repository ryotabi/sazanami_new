<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}


    try{

        $year=$_POST['year'];
        $month=$_POST['month'];
        $day=$_POST['day'];

        $dsn='mysql:dbname=s-ryota_sazanami;host=mysql57.s-ryota.sakura.ne.jp;charset=utf8';
        $user='s-ryota';
        $password='sryota1007';
        $dbh=new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='
        SELECT
            dat_sales.code,
            dat_sales.date,
            dat_sales.code_member,
            dat_sales.name AS dat_sales_name,
            dat_sales.email,
            dat_sales.tel,
            dat_sales.day,
            sales_product.code_product,
            mst_product.name AS sales_product_name,
            sales_product.price,
            sales_product.quantity
        FROM
            dat_sales,sales_product,mst_product
        WHERE
            dat_sales.code=sales_product.code_sales
            AND sales_product.code_product=mst_product.code
            AND substr(dat_sales.date,1,4)=?
            AND substr(dat_sales.date,6,2)=?
            AND substr(dat_sales.date,9,2)=?
        ';
        $stmt=$dbh->prepare($sql);
        $data[]=$year;
        $data[]=$month;
        $data[]=$day;
        $stmt->execute($data);

        $dbh=null;

        $csv= '注文コード,注文日時,会員番号,お名前,メール,TEL,受け取り時間,商品コード,商品名,価格,数量';
        $csv.= "\n";
        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec===false){
            break;
            }
            $csv.=$rec['code'];
            $csv.= ',';
            $csv.=$rec['date'];
            $csv.= ',';
            $csv.=$rec['code_member'];
            $csv.= ',';
            $csv.=$rec['dat_sales_name'];
            $csv.= ',';
            $csv.=$rec['email'];
            $csv.= ',';
            $csv.=$rec['tel'];
            $csv.= ',';
            $csv.=$rec['day'];
            $csv.= ',';
            $csv.=$rec['code_product'];
            $csv.= ',';
            $csv.=$rec['sales_product_name'];
            $csv.= ',';
            $csv.=$rec['price'];
            $csv.= ',';
            $csv.=$rec['quantity'];
            $csv.= "\n";
        }

        // print nl2br($csv);
        $file = fopen('./chumon.csv','w');
        $csv = mb_convert_encoding($csv,'SJIS','UTF-8');
        fputs($file,$csv);
        fclose($file);





    }
    catch(Exception $e){
        print'ただいまデータベースに障害が起きています。';
    exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>さざなみ管理画面</title>
    <!-- PLACE FAVICON.ICO IN THE ROOT DIRECTORY -->
    <link rel="icon" href="img/images/icon.png">
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,100,300,700,900' rel='stylesheet' type='text/css'>
    <!-- All CSS FILES -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">    
    <link rel="stylesheet" href="../css/et-line-iocn.css">    
    <link rel="stylesheet" href="../css/elements.css">    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/add_style.css">
    <link rel="stylesheet" href="../css/management.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css" rel="stylesheet">
    <!-- MODERNIZE JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <header>
        <h2 class="management-title">さざなみ管理画面</h2>
    </header>
    <main>
        <div class="main-title_wrap">
            <div class="main-title">
            <p class="page-title">トップページ</p>
            <p class="loginPerson"><?php print $_SESSION['staff_name'];?>さんログイン中</p>
            </div>
        </div>
        <div class="form-wrap">
            <p class="management-text"><a class="management-top-text" href="chumon.csv">注文データのダウンロード</a></p>
            <p class="management-text"><a class="management-top-text" href="order_download.php">日付選択へ</a></p>
            <p class="management-text"><a class="management-top-text" href="../staff_login/staff_top.php">トップ</a></p>
        </div>
    </main>
    <script src="../js/vendor/jquery-1.12.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.isotope.js"></script>
    <script src="../js/slick.min.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
    <script src="../js/add.js"></script>
    <script src="../js/weather.js"></script>
</body>
</html>