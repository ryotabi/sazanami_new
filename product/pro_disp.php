<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
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
            <p class="page-title">商品情報参照</p>
            <p class="loginPerson"><?php print $_SESSION['staff_name'];?>さんログイン中</p>
            </div>
        </div>
        <div class="form-wrap" >
            <?php
            try{
            $pro_code=$_GET['procode'];

            $dsn='mysql:dbname=s-ryota_sazanami;host=mysql57.s-ryota.sakura.ne.jp;charset=utf8';
            $user='s-ryota';
            $password='sryota1007';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$pro_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name=$rec['name'];
            $pro_price=$rec['price'];
            $pro_gazou_name=$rec['gazou'];

            $dbh = null;
            }catch(Exception $e){
                print'ただいまデータベースに障害が起きています。';
                exit();
            }
            ?>
            <p class="management-text">商品コード:<?php print $pro_code;?></p>
            <p class="management-text">商品名：<?php print $pro_name;?></p>
            <p class="management-text">価格：<?php print $pro_price;?>円</p>
            <img src="../img/product/<?php print $pro_gazou_name;?>" alt="商品画像" width="100px" height="100px">
            <form action="pro_edit_check.php" method="post" class="edit_form-wrap">
                <input type="button" onclick="history.back()" value="戻る">
            </form>
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