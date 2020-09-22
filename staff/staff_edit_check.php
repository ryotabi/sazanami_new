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
            <p class="page-title">スタッフ情報編集確認</p>
            <p class="loginPerson"><?php print $_SESSION['staff_name'];?>さんログイン中</p>
            </div>
        </div>
        <div class="form-wrap" >
            <?php
            $staff_code=$_POST['code'];
            $staff_name=$_POST['name'];
            $staff_pass=$_POST['pass'];
            $staff_pass2=$_POST['pass2'];
            $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
            $staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
            $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
            $staff_pass2=htmlspecialchars($staff_pass2,ENT_QUOTES,'UTF-8');

            if($staff_name===''){
                print 'スタッフ名が入力されていません。<br>';
            }
            if($staff_pass===''){
                print 'パスワードが入力されていません。<br>';
            }
            if($staff_pass!==$staff_pass2){
                print 'パスワードが一致しません。<br>';
            }
            if($staff_name===''||$staff_pass===''||$staff_pass!==$staff_pass2){
                print '<form>';
                print '<input type="button" onclick="history.back()" value="戻る">';
                print '</form>';
            }else{
                $staff_pass=md5($staff_pass);
                print '<form method="post" action="staff_edit_done.php">';
                print '<ul>';
                print '<li class=form-content >';
                print '<p style="font-size:20px; color:#000;">スタッフ名</p>';
                print '<p style="font-size:20px; color:#000;">'.$staff_name.'</p>';
                print "</li>";
                print '<input type="hidden" name="name" value="'.$staff_name.'">';
                print '<input type="hidden" name="code" value="'.$staff_code.'">';
                print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
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