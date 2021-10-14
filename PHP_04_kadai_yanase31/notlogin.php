<?php

// 関数呼び出し
require_once("funcs.php");

session_start();


// データベース通信開始
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status == false) {
  sql_error($stmt);
  // $error = $stmt->errorInfo();
  // exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  
  
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

  

    $view .= "<p>";
    $view .= '<a href="notlogin_detail.php?id='. $result["id"].'">';
    $view .= h($result['date']) . '【' . h($result['BookTitle']) .'】';
    $view .= "<br>";
    // $view .= '（' . h($result['BookURL'])  . ')';
    // $view .= "<br>";
    // $view .= '<' . h($result['BookStatus']) . '>　「'. h($result['BookComment']) . '」';
    $view .= "</a>";


    //     // 0 : true;
    //     // 1 : false;
    // if ($_SESSION["kanri_flg"]) {
    // $view .= '<a href="delete.php?id='  . $result['id'] . ' ">';
    // $view .= ':[削除]';
    // $view .= '</a>';
  }
    
    $view .= "</p>";

  }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍登録状況の表示</title>
<!-- <link rel="stylesheet" href="css/range.css"> -->
<link href="css/style2.css" rel="stylesheet">
<!-- <style>div{padding: 10px;font-size:16px;}</style> -->


<!-- js書き込み -->
<!-- <script type="text/javascript">


</script> -->

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">書籍情報の登録に戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<p class="narabi">※データの並び順は以下参照</p>
<p class="setsumei">
登録日時　【書籍タイトル】<br>
</p>

<!-- <button id="midoku">「読了前」のみ表示する</button> -->

<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>

<!-- Main[End] -->

</body>
</html>