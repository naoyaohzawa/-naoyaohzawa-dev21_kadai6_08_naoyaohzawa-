<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

// タイムゾーンを設定
ini_set('date.timezone', 'Asia/Tokyo');

// $error配列を作成して、登録情報が正しく入力されているか以下確認。

function dbupload(){
 
$error = [];

// メモ
// filter_input( 型 , 変数名, フィルタ, オプション);
// 変数に値が入っていないとfalseを返してくれる
// 型には、INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENVが入る
// GET/POSTはそれぞれ$_POSTでget/postされた値
// 変数名はget/postなどformから送信されるname=""の変数
// $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
// 第3引数以降入ってなければ、defaultが適用されるので、第3引数なしでもOK

// メモ
// if(!)と!をつけると、もし〜じゃなかったらという逆にしてくれる。
// INPUT_POSTで受け取ったものをfilter_inputする

if($_SERVER["REQUEST_METHOD"] == "POST"){
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


    // $shipName = $_POST["shipName"]; //船の名前
    // $dep_date = $_POST["dep_date"]; //出航日
    // $departure = $_POST["departure"]; //出発港
    // $arrival = $_POST["arrival"]; //到着港
    // $cargo = $_POST["cargo"]; //荷物
}

// echo $dep_date;


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
    $stmt = $pdo->prepare("INSERT INTO voyage_data(id, shipName, input_date, dep_date, departure, arrival, cargo)
    VALUES(NULL, :shipName, sysdate(), :dep_date, :departure, :arrival, :cargo)");
    
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
   
}

dbupload();

// echo "<br>xxx" . "kk";


?>