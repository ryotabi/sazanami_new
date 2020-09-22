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
            <p class="page-title">商品情報修正確認</p>
            <p class="loginPerson"><?php print $_SESSION['staff_name'];?>さんログイン中</p>
            </div>
        </div>
        <div class="form-wrap" >
            <?php
            $pro_code=$_POST['code'];
            $pro_name=$_POST['name'];
            $pro_price=$_POST['price'];
            $pro_gazou_name_old=$_POST['gazou_name_old'];
            $pro_gazou=$_FILES['gazou'];
            $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
            $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
            $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');
            $pro_gazou_name_old=htmlspecialchars($pro_gazou_name_old,ENT_QUOTES,'UTF-8');

            if($pro_name===''){
                print '商品名が入力されていません。<br>';
            }
            if(preg_match('/\A[0-9]+\z/',$pro_price)===0){
                print '価格は半角数字で入力してください。<br>';
            }
            if($pro_gazou['size']<=0){
                print '画像が選択されていません。<br>';
            }
            if($pro_gazou['size']>0){
                if($pro_gazou['size']>100000000){
                    print '画像が大きすぎます。';
                }else{
                    move_uploaded_file($pro_gazou['tmp_name'],'../img/product/'.$pro_gazou['name']);
                }
            }
            if($pro_name===''||preg_match('/\A[0-9]+\z/',$pro_price)===0||$pro_gazou['size']<=0||$pro_gazou['size']>100000000){
                print '<form>';
                print '<input type="button" onclick="history.back()" value="戻る">';
                print '</form>';
            }else{
                $pro_pass=md5($pro_pass);
                print '<form method="post" action="pro_edit_done.php">';
                print '<ul>';
                print '<li class=form-content >';
                print '<p style="font-size:20px; color:#000;">商品名</p>';
                print '<p style="font-size:20px; color:#000;">'.$pro_name.'</p>';
                print "</li>";
                print '<li class=form-content >';
                print '<p style="font-size:20px; color:#000;">価格</p>';
                print '<p style="font-size:20px; color:#000;">'.$pro_price.'円</p>';
                print "</li>";
                print '<li class=form-content >';
                print '<img src="../img/product/'.$pro_gazou['name'].'" width="100px" height="100px">';
                print "</li>";
                print '<li class=form-content >';
                print '<p style="font-size:20px; color:#000;">上記の内容で修正してよろしいですか？</p>';
                print "</li>";
                print '<input type="hidden" name="code" value="'.$pro_code.'">';
                print '<input type="hidden" name="name" value="'.$pro_name.'">';
                print '<input type="hidden" name="price" value="'.$pro_price.'">';
                print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
                print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
                print '<input type="button" onclick="history.back()" value="戻る">';
                print '<input type="submit"value="OK">';
                print '</form>';
            }
            ?>
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