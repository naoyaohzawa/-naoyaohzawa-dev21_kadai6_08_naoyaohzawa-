<?php

require 'funcs.php';

ini_set("display_errors", 1);
error_reporting(E_ALL);

// タイムゾーンを設定
ini_set('date.timezone', 'Asia/Tokyo');


//1.  DB接続します
try {
    //Password:MAMP='root'
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
}
  
  //２．データ取得SQL作成
  $stmt = $pdo->prepare("SELECT * FROM voyage_data ORDER BY input_date DESC");
  $status = $stmt->execute();  

//   echo $status;

  //３．データ表示

if($status==false) {
$error = $stmt->errorInfo(); //Errorがある場合
exit("ErrorQuery:".$error[2]); //配列index[2]にエラーコメントあり
} else {
//Selectデータの数だけ⾃動でループしてくれる
while($result[] = $stmt->fetch(PDO::FETCH_ASSOC));
$json = json_encode($result);
}

// var_dump($json);
?>

<!-- HTML start -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>表示画面</title>
</head>
<body>
<h1 style="text-align:center;">運行情報一覧</h1>
<table id="table" class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">船名</th>
      <th scope="col">出航日</th>
      <th scope="col">出発港</th>
      <th scope="col">到着港</th>
      <th scope="col">積載荷物</th>
      <th scope="col">入力日</th>
    </tr>
  </thead>
  
  <div id="start">
  </div>

</table>

<a class="link-primary" href="index.php">運行情報入力画面に戻る</a>




<!-- JQUERY start -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    const data = JSON.parse('<?=$json?>');
    console.log(data);
    // console.log(data[1]);
    // console.log(data.length);   
    // console.log(data[1].arrival);

    // 以下の配列はこれは無視して下さい。
    // let formStart = '<form action="update.php" method="POST">';
    // formStart += '<th scope="row">${i + 1}</th>';
    // formStart += '<td class="name_value">${data[i].shipName}</td>'
    // formStart += '<td class="name_change"><input type="text" name="shipName" value="${data[i].shipName}"></td>';
    // formStart += '<td class="depDate_value">${data[i].dep_date}</td>';
    // formStart += '<td class="depDate_change"><input type="date" value="${data[i].dep_date}"></td>';
    // formStart += '<td class="departure_value">${data[i].departure}</td>';
    // formStart += '<td class="departure_change"><input type="text" value="${data[i].departure}"></td>';
    // formStart += '<td class="arrival_value">${data[i].arrival}</td>';
    // formStart += '<td class="arrival_change"><input type="text" value="${data[i].arrival}"></td>';
    // formStart += '<td class="cargo_value">${data[i].cargo}</td>';
    // formStart += '<td class="cargo_change"><input type="text" value="${data[i].cargo}"></td>';
    // formStart += '<td class="inputDate_value">${data[i].input_date}</td>';
    // formStart += '<td>';
    // formStart += '<input type="button"  value="編集" class="edit-line">';
    // formStart += '<input type="submit" value="保存" class="save-line">';
    // formStart += '<input type="button" value="キャンセル" class="cancel-line">';
    // formStart += '</td>';
    // formStart += '<td class="id"><input type="hidden" type="text" name="id" value="${data[i].id}"></td>';
     
    // テーブルにJSONデータを表示
    for(i=0; i<data.length - 1; i++){
        $(".table").append(
          `
          <tbody>
          <tr>
            <form action="update.php" method="POST">
              <th scope="row">${i + 1}</th>
              <td class="name_value">${data[i].shipName}</td>
              <td class="name_change"><input type="text" name="shipName" value="${data[i].shipName}"></td>
              <td class="depDate_value">${data[i].dep_date}</td>
              <td class="depDate_change"><input type="date" value="${data[i].dep_date}"></td>
              <td class="departure_value">${data[i].departure}</td>
              <td class="departure_change"><input type="text" value="${data[i].departure}"></td>
              <td class="arrival_value">${data[i].arrival}</td>
              <td class="arrival_change"><input type="text" value="${data[i].arrival}"></td>
              <td class="cargo_value">${data[i].cargo}</td>
              <td class="cargo_change"><input type="text" value="${data[i].cargo}"></td>
              <td class="inputDate_value">${data[i].input_date}</td>
              <td>
                <input type="button"  value="編集" class="edit-line">
                <input type="submit" value="保存" class="save-line">
                <input type="button" value="キャンセル" class="cancel-line">
              </td>
              <td class="id"><input type="hidden" type="text" name="id" value="${data[i].id}"></td>
            </form>
          </tr>
          </tbody>
          `
        )
    }


// データ更新
// まず画面がロード時に保存ボタンとキャンセルボタンが表示されないようにする
window.onload = function(){
$(".save-line").hide();
$(".cancel-line").hide();
    
}

// 元のデータを表示
$("[class$='_value']").show();
// $("[class$='_value']").hide();

// inputタグは最初hideにする
$("[class$='_change']").hide();
// $("[class$='_change']").show();

$(function(){
    // 編集ボタンクリック処理
    $('.edit-line').click(function(){
        $(this).parent().find('.edit-line').hide();
        $(this).parent().find('.save-line').show();
        $(this).parent().find('.cancel-line').show();
        // $("[class$='_value']").hide();
        // $("[class$='_change']").show();
        $(this).parents('.data-edit').find("[class$='_value']").hide();
        $(this).parents('.data-edit').find("[class$='_change']").show();
    });
    // 保存ボタンクリック処理
    $('.save-line').click(function(){
        $(this).parent().find('.edit-line').show();
        $(this).parent().find('.save-line').hide();
        $(this).parent().find('.cancel-line').hide();
        $("[class$='_value']").show();
        // $("[class$='_value']").hide();
        $("[class$='_change']").hide();
        // $("[class$='_change']").show();
    });
    // キャンセルボタンクリック処理
    $('.cancel-line').click(function(){
        $(this).parent().find('.edit-line').show();
        $(this).parent().find('.save-line').hide();
        $(this).parent().find('.cancel-line').hide();
        $("[class$='_value']").show();
        // $("[class$='_value']").hide();
        $("[class$='_change']").hide();
        // $("[class$='_change']").show();
    });
});
// https://vertys.net/php-table-cell-update-on-the-spot/

// 残骸たち
// <form action="update.php" method="POST">
  // <th scope="row">${i + 1}</th>
  // <td class="name_value">${data[i].shipName}</td>
  // <td class="name_change"><input type="text" name="shipName" value="${data[i].shipName}"></td>
  // <td class="depDate_value">${data[i].dep_date}</td>
  // <td class="depDate_change"><input type="date" value="${data[i].dep_date}"></td>
  // <td class="departure_value">${data[i].departure}</td>
  // <td class="departure_change"><input type="text" value="${data[i].departure}"></td>
  // <td class="arrival_value">${data[i].arrival}</td>
  // <td class="arrival_change"><input type="text" value="${data[i].arrival}"></td>
  // <td class="cargo_value">${data[i].cargo}</td>
  // <td class="cargo_change"><input type="text" value="${data[i].cargo}"></td>
  // <td class="inputDate_value">${data[i].input_date}</td>
  // <td>
    // <input type="button"  value="編集" class="edit-line">
    // <input type="submit" value="保存" class="save-line">
    // <input type="button" value="キャンセル" class="cancel-line">
  // </td>
  // <td class="id"><input type="hidden" type="text" name="id" value="${data[i].id}"></td>
// </form>
    
</script>

<?php


?>

</body>
</html>
