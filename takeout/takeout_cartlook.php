<?php
session_start();
session_regenerate_id(true);

    try{
        $cart=$_SESSION['cart'];
        $kazu=$_SESSION['kazu'];
        $num=count($cart);

    $dsn='mysql:dbname=s-ryota_sazanami;host=mysql57.s-ryota.sakura.ne.jp;charset=utf8';
    $user='s-ryota';
    $password='sryota1007';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    foreach($cart as $key => $value){
        $sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
        $stmt=$dbh->prepare($sql);
        $data[0]=$value;
        $stmt->execute($data);

        $rec=$stmt->fetch(PDO::FETCH_ASSOC);

        $pro_name[]=$rec['name'];
        $pro_price[]=$rec['price'];
        $pro_gazou_name[]=$rec['gazou'];
    }
    $dbh=null;
    $okflg=true;
    }catch(Exception $e){
        print'ただいまデータベースに障害が起きています。';
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
        <link rel="icon" href="img/ryota/icon.png">
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
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/index.php">ホーム</a>
                                </li>
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/menu.html">メニュー</a>
                                </li>
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/news.html">お知らせ</a>
                                </li>                                        
                                <li><a href="http://s-ryota.sakura.ne.jp/sazanami/recruit.html">採用</a>
                                </li>                                                                       
                            </ul>
                        </nav>
                    </div>
                    <!-- END OF MOBILE MENU AREA -->
                </div>
            </div>
        </div>                
    </header>

    <main class="main-img vh-97">
        <div class="main-img-wrap">
            <div class="breadcrumb-area breadcrumb-style-3  pt-140 pb-70 bg-cartlook">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumb-content text-center">
                                <h2 class="page-cat mn-title">カート一覧</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <p class="cartlook-text">購入する時は購入ボタンを、数量を変更する時は数量変更ボタンを、購入をやめるときは商品を選択して削除ボタンを押してください。</p>
                    <form action="kazu_change.php" method="post">
                        <ul class="cartlook-wrap">
                            <?php 
                            if($num===0){
                                print '<p class="cartlook-none">カートに商品が入っていません。</p>';
                                $okflg=false;
                            }
                            ?>
                            <?php for($i=0;$i<$num;$i++):?>
                                <?php
                                $itemPrice[$i]=$pro_price[$i]*$kazu[$i];
                                $itemsPrice+=$itemPrice[$i];
                                ?>
                                <li class="cartlook-item">
                                    <img src="../img/product/<?php print $pro_gazou_name[$i];?>" alt="商品画像" width="200px" height="200px">
                                    <div class="cartlook-item-text">
                                        <p class="cartlook-name"><?php print $pro_name[$i];?></p>
                                        <p class="cartlook-price"><?php print $pro_price[$i];?>円</p>
                                    </div>
                                    <p class="cartlook-kazu-wrap"><input type="text" class="cartlook-kazu" name="kazu<?php print $i;?>" value="<?php print $kazu[$i];?>"><span>個</span></p>
                                    <p class="item-sumPrice">計：<?php print $itemPrice[$i];?>円</p>
                                    <p class="delete-btn"><input type="checkbox" name="delete<?php print $i;?>"></p>
                                </li>
                            <?php endfor;?>
                        </ul>
                        <p class="items-sumPrice">合計金額:<?php print $itemsPrice;?>円</p>
                        <div><input type="hidden" name="num" value="<?php print $num;?>"></div>
                        <?php 
                    if($okflg===true){
                        print '<div class="toform-btn cartlook_btn" style="margin: 30px 0;"><input type="submit" value="数量変更"></div>';
                        print '<div class="toform-btn cartlook_btn"><input type="submit" value="削除"></div>';
                        print '<div class="toform-btn cartlook_btn "><a href="takeout_form.html" class="tohome">購入</a></div>';
                    }else{
                        print '<div class="toform-btn cartlook_btn"><a href="../index.php" class="tohome">ホーム</a></div>';
                    }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4  col-sm-12 col-xs-12">
                    <div class="logo">
                        <img src="../img/images/icon.png" alt="" class="hd-icon">
                        <h3 class="hd-title"><a href="index.php">さざなみ</a></h3>
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
<script src="../js/menu.js"></script>

</body>
</html>