# -naoyaohzawa-dev21_kadai6_08_naoyaohzawa-①課題内容（課題名・どんな作品か）
課題06ブックマークアプリ

船の運行状況をmysqlに登録する(index.php)。登録されたデータを一覧で表示する(display.php)。一覧表示されたかくリストを編集&削除できるようにする。


②工夫した点・こだわった点
一覧表示されたリストの各行に編集ボタンを設置。編集ボタンをクリックするとinputタグの中にデータが表示され、そのinputタグの中で編集することができる（ようにしたかった。。）。
削除ボタンも作成しようと思ったが、編集ボタンでつまづき、どうしても先に進めなかった。

③質問・疑問（あれば）
編集ボタンを押して、編集したデータをupdate.phpで受け取り、すぐに一覧表が更新される所まではできた。
display.phpのLine 114でformタグを記述している。for文でdata.lengthの数だけhtmlにformタグが記述されるが、html上では、
<form action="update.php" method="POST"></form>とformが終了されているので、formの中にinputタグが入らず、POSTされてもupdate.phpで値を受け取ることができない。
JQUERYの仕様上formタグがfor文でループされると発生する模様。これを回避する方法がどうしても見つからず、断念。。


④その他（感想、シェアしたいことなんでも）
〜感想〜
bootsrapを利用してみた。確かに簡単に使えるので便利だった。モックを作る程度なら利用したいが、自分でcss当ててもそこまで時間かからないかなとも感じた。


参考にしたURL
https://www.youtube.com/watch?v=uCvPMe5wsNk&t=129s


権限
user: naoya
password:naoya708
