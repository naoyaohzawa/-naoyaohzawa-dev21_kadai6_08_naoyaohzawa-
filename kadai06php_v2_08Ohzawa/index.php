<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

// タイムゾーンを設定
ini_set('date.timezone', 'Asia/Tokyo');

$shipName = array("MS ASUKA II", "NIPPON MARU", "PACIFIC VENUS");

// echo $shipName[0];

?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    <title>登録画面</title>
</head>
<body>

<div class="text-center">


<h2>運行情報の登録画面</h2>
<form action="confirm.php" method="POST">

    <p >船名：
    <select name="shipName" aria-label='Default select example' id="" style="width: 80%;">
        <?php
            for($i=0; $i<3;$i++){
            echo "<option  name='shipName' value='$shipName[$i]'>$shipName[$i]</option>";
            }
        ?>
    </select>    
    </p>

    <!-- <div class="input-group mb-3">
    <span class="input-group-text" id="inputGroup-sizing-default">出航日</span>
    <input type="date" name="dep_date" id="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="inputGroup-sizing-default">出発地</span>
    <input type="text" name="departure" id="departure" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    
    <div class="input-group mb-3">
    <span class="input-group-text" id="inputGroup-sizing-default">到着地</span>
    <input type="text" name="arrival" id="arrival" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="inputGroup-sizing-default">貨物</span>
    <input type="text" name="cargo" id="cargo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div> -->
    
    <p>
        <label for="date">出航日: <input type="date" name="dep_date" id="date" style="width: 80%;"></label>
    </p>


    <p>
        <label for="departure">出発地: <input type="text" name="departure" id="departure" style="width: 80%;"></label>
    </p>

    <p>
        <label for="arrival">到着地: <input type="text" name="arrival" id="arrival" style="width: 80%;"></label>
    </p>

    <p>
        <label for="cargo">貨物: <input type="text" name="cargo" id="cargo" style="width: 80%;"></label>
    </p>
    <input type="submit" value="登録します" class="btn btn-primary">
</form>
</div>


<a style="text-align: center;" href="display.php">運行情報一覧</a>
</body>
</html>