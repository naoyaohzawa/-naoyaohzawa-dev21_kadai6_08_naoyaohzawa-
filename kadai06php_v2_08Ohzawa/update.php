<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

// タイムゾーンを設定
ini_set('date.timezone', 'Asia/Tokyo');

// $error配列を作成して、登録情報が正しく入力されているか以下確認。
 
$error = [];


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!$id = filter_input(INPUT_POST, 'id')){
        $error[] = 'idが入力されていません';
    }else{
        $id = $_POST["id"]; //id番号
    }

    if(!$shipName = filter_input(INPUT_POST, 'shipName')){
        $error[] = '船名を選んでください';
    }else {$shipName = $_POST["shipName"];
    }
    
    if(!$dep_date = filter_input(INPUT_POST, 'dep_date')){
        $error[] = '出航日を選択してください';
    }else{
        $dep_date = $_POST["dep_date"]; //出航日
    }

    if(!$departure = filter_input(INPUT_POST, 'departure')){
        $error[] = '出発港を入力してください';
    }else{
        $departure = $_POST["departure"]; //到着港
    }

    if(!$arrival = filter_input(INPUT_POST, 'arrival')){
        $error[] = '到着港を入力してください';
    }else{
        $arrival = $_POST["arrival"]; //出発港
    }

    if(!$cargo = filter_input(INPUT_POST, 'cargo')){
        $error[] = 'Cargoを入力してください';
    }else{
        $cargo = $_POST["cargo"]; //出発港
    }
}
echo $departure . '<br>';
echo $arrival . '<br>';
echo $dep_date . '<br>';

// 1. SQL文を用意
// $errorの配列の数が0であれば、dbに登録実行
// $errorがあれば、ページを戻るボタンを表示
if(count($error) === 0){
    //2. DB接続します MAMP利用時
    try {
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
        echo "接続に失敗しました";
      }
      
    //３．データ登録SQL作成
    $stmt = $pdo->prepare("UPDATE voyage_data SET id=$id, shipName = :shipName, input_date = sysdate(), 
    dep_date = :dep_date, departure = :departure, arrival = :arrival, cargo = :cargo WHERE id = $id");
    
    // UPDATE `voyage_data` SET `id`='[value-1]',`shipName`='[value-2]',`input_date`='[value-3]',`dep_date`='[value-4]',`departure`='[value-5]',`arrival`='[value-6]',`cargo`='[value-7]' WHERE 1

    //  2. バインド変数を用意
    $stmt->bindValue(':shipName', $shipName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':dep_date', $dep_date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':departure', $departure, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':arrival', $arrival, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':cargo', $cargo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    
    //  3. 実行
    $status = $stmt->execute(); 

    //４．データ登録処理後
    if($status==false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit("ErrorMessage:".$error[2]);
    }else{
        //５．index.phpへリダイレクト
    header('location:display.php');
    }
}else{
    echo "入力していない項目があります";

    echo "<input  type='button' value='修正する' onclick='history.back(-1)'>";

}



?>