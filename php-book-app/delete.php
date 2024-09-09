<?php
$dsn='mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user='root';
$password='';

try{
  $pdo=new PDO($dsn, $user, $password);

  //動的に変わる値をプレースホルダーに置き換えたinsert文をあらかじめ用意する
  $sql_delete='DELETE FROM books WHERE id =:id';
  $stmt_delete =$pdo->prepare($sql_delete);

  //bindValue()メソッドを使って実際の値をプレースホルダにバインドする
  $stmt_delete->bindValue(':id' ,$_GET['id'], PDO::PARAM_INT);

  //SQL文を実行する
  $stmt_delete->execute();

  //削除した件数を取得する
  $count =$stmt_delete->rowCount();

  $message ="商品を{$count}件削除しました。";

  //書籍一覧ページに李大レストさせる
  header("Location:read.php?message={$message}");
 
}catch(PDOException $e){
  exit($e->getMessage());
}
?>
