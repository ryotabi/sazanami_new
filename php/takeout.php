<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../css/comment.css">
</head>
<body>


<div class="comment-display">
    <h3 class="comment-title">＜コメント＞</h3>
    <?PHP
    $file_name = "../sendPHP/takeout-send_2.txt"; 
    $ret_array = file($file_name); 
    ?>
    <?php for( $i = 0; $i < count($ret_array); ++$i ):?> 
      <div class="comment-wrap">
        <?php echo ( $ret_array[$i] . "<br />\n" )  ; ?>
      </div>
  <?php endfor;?>
</div>

<form action="../sendPHP/takeout-send_1.php" method="post" class="comment-form"> 
      <div class="form-wrap">
        <label for="name">ニックネーム</label>
        <input type="text" name="name" class="form-name " id="name" required>
        <label for="name">コメント</label>
        <textarea name="comment" class="form-comment " id="comment"  type="text" cols="30" rows="10" required ></textarea>
      </div>
      <div class="form-btn_wrap">
        <input type="submit" value="投稿" class="form-btn">
      </div>
</form>
</body>
</html>