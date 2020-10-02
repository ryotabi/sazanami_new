<?php
session_start();
session_regenerate_id(true);
try{

$onamae=$_POST['onamae'];
$tel=$_POST['tel'];
$email=$_POST['email'];
$day=$_POST['day'];

$takeoutNum=$_SESSION['takeoutNum'];
if($takeoutNum===""){
    $takeoutNum=0;
}
$takeoutNum+=1;
$_SESSION['takeoutNum']=$takeoutNum;

$honbun='';
$honbun.="ご注文ありがとうございました。\n";
$honbun.="ご提示頂いたお受け取り時間にお越しください。\n";
$honbun.="\n";
$honbun.= "以下ご注文の詳細になります。\n";
$honbun.="-------------\n";
$honbun.="お受渡し番号\n";
$honbun.=$takeoutNum."\n";

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$num=count($cart);

$dsn='mysql:dbname=s-ryota_sazanami;host=mysql57.s-ryota.sakura.ne.jp;charset=utf8';
$user='s-ryota';
$password='sryota1007';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

for($i=0;$i<$num;$i++){
    $sql= 'SELECT name,price FROM mst_product WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[0]=$cart[$i];
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $name=$rec['name'];
    $price=$rec['price'];
    $kakaku[]=$price;
    $suryo=$kazu[$i];
    $shokei=$price*$suryo;

    $honbun.=$name.'';
    $honbun.=$price.'円×';
    $honbun.=$suryo.'個=';
    $honbun.=$shokei."円\n";
    $goukei+=$shokei;

}

$dbh=null;
$honbun.="\n";
$honbun.="合計金額：";
$honbun.=$goukei."円\n";
$honbun.="お受渡し時間\n";
$honbun.=$day."\n";
$honbun.="-------------\n";
$honbun.="ご不明な点があれば以下の電話番号までご連絡下さい\n";
$honbun.="そば処　さざなみ\n";
$honbun.="\n";
$honbun.="電話 042-123-4567";

$title="ご注文ありがとうございます。";
$header="From:sryotapersian@gmail.com";
$honbun =html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('JApanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email,$title,$honbun,$header);


$title='お客様からテイクアウトのご注文がありました';
$header='From;'.$email;
$honbun =html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');

mb_send_mail('sryotapersian@gmail.com',$title,$honbun,$header);


}catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしています。';
    exit();
}

try{
$dsn='mysql:dbname=s-ryota_sazanami;host=mysql57.s-ryota.sakura.ne.jp;charset=utf8';
$user='s-ryota';
$password='sryota1007';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql = 'LOCK TABLES dat_sales WRITE,sales_product WRITE';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$sql='INSERT INTO dat_sales(code_member,name,email,tel,day) VALUES(?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data= array();
$data[]=0;
$data[]=$onamae;
$data[]=$email;
$data[]=$tel;
$data[]=$day;
$stmt->execute($data);


$sql ='SELECT LAST_INSERT_ID()';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];
print $lastcode;

for($i=0;$i<$num;$i++){
$sql = 'INSERT INTO sales_product(code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
$stmt = $dbh->prepare($sql);
$data= array();
$data[]=$lastcode;
$data[]=$cart[$i];
$data[]=$kakaku[$i];
$data[]=$kazu[$i];
$stmt->execute($data);

}

$sql = 'UNLOCK TABLES';
$stmt = $dbh->prepare($sql);
$stmt->execute();


$dbh=null;
}
catch(Exception $e){
    print 'エラー';
    exit();
}

?>

<!doctype html>
<html class="no-js" lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>そば処 さざなみ</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- PLACE FAVICON.ICO IN THE ROOT DIRECTORY -->
        <link rel="icon" href="../img/ryota/icon.png">
        <!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,100,300,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<!-- All CSS FILES -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">    
        <link rel="stylesheet" href="../css/et-line-iocn.css">    
        <link rel="stylesheet" href="../css/elements.css">    
		<link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="../css/add_style.css">
        <link rel="stylesheet" href="../css/recruit.css">
		<!-- MODERNIZE JS -->
        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

<body>
<div class="wrapper">
    <header class="header-area header-style-one intelligent-header">
        <div class="header-middle-area">
            <div class="col-md-12 hd-border"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4  col-sm-6 col-xs-6 tab-hd">
                        <div class="logo">
                            <img src="../img/images/icon.png" alt="" class="hd-icon">
                            <h3 class="hd-title"><a href="http://s-ryota.sakura.ne.jp/sazanami/index.php">さざなみ</a></h3>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-10 hidden-xs hidden-sm">
                        <div class="menu-area">
                            <nav>
                                <ul class="main-menu hover-style-one clearfix">
                                <div class="hd-nav-wrap">
                                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/index.php">ホーム</a>
                                        </li>
                                    </div>
                                    <div class="hd-nav-wrap">
                                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/menu.html">メニュー</a>
                                        </li>
                                    </div>
                                    <div class="hd-nav-wrap">
                                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/news.html">お知らせ</a>
                                        </li>                                            
                                    </div>
                                    <div class="hd-nav-wrap">
                                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/recruit.html">採用</a>
                                        </li>                                            
                                    </div>
                                    <div class="line">
                                        <div class="line-it-button" data-lang="ja" data-type="friend" data-lineid="@255ykqqk" data-count="true" style="display: none;"></div>
                                        <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
                                    </div>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- START OF MOBILE MENU AREA -->
                    <div class="mobile-menu-area clearfix hidden-md hidden-lg">
                        <nav class="mobile-menu">
                            <ul>
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/index.php">ホーム</a></li>
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/menu.html">メニュー</a></li>
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/news.html">お知らせ</a></li>                                        
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/recruit.html">採用</a></li>                                                                       
                            </ul>
                        </nav>
                    </div>
                    <!-- END OF MOBILE MENU AREA -->
                </div>
            </div>
        </div>                
    </header>

    <main class="main-img vh-97 takeout-tab-img">
        <div class="main-img-wrap takeout-img-wrap">
            <div class="content">
                <div class="breadcrumb-area text-center takeout-bg pt-140 pb-70">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="breadcrumb-content">
                                    <h2 class="page-cat recruit-title">テイクアウト購入</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                    <div class="buy_wrap">
                        <h3 class="buy_num_text">お受渡し番号</h3>
                        <p class="buy_num"><?php print $takeoutNum;?></p>
                    </div>
                    <div class="buy_text_wrap">
                        <p class="buy_text">ご注文ありがとうございました。ご来店の際は、上記のお受渡し番号またはお送りさせて頂いたメールをご提示下さい。</p>
                    </div>
                    <div class="toform-btn cartin_btn"><a href="../index.php"><p class="btn-text">ホームへ</p></a></div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4  col-sm-12 col-xs-12">
                    <div class="logo">
                        <img src="../img/images/icon.png" alt="" class="hd-icon">
                        <h3 class="hd-title"><a href="../index.php">さざなみ</a></h3>
                    </div>
                </div>
                <div class="col-md-8 ft-nav-wrap">
                    <ul>
                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/menu.php">メニュー</a></li>
                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/news.html">お知らせ</a></li>
                        <li><a href="http://s-ryota.sakura.ne.jp/sazanami/recruit.html">採用</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="../js/vendor/jquery-1.12.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.isotope.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/plugins.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
<script src="../recruit.js"></script>

</body>
</html>