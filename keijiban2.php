<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="index.css">
	<title>掲示板＜農業＞</title>
	</head>
	<body>
		<a href="index.html><img src="i.jpg"></a>
			<header>
			    <h1>掲示板</h1>
			</header>
			<nav>
				<ul>
					<li class=”current”><a href=”#”>Home</a></li>
					<li><a href=”#”>News</a></li>
					<li><a href=”#”>About</a></li>
					<li><a href=”#”>Access</a></li>
					<li><a href=”#”>Blog</a></li>
				</ul>
			</nav>

		<div class="search">
			<form method="post" action="keijiban.php">
				<select name="名前">
					<?php
						$conn = pg_connect("host=ec2-44-194-112-166.compute-1.amazonaws.com dbname=d92qoitiu38r5q user= fvtmfpskeksxyf password=21899814b89fc9f58762b44dc375fc2544a219a2a3e68d803201d37e6ebaffc9");
						$rs = pg_query($conn, "select distinct name from testdb ");
						for ($i = 0 ; $i < pg_num_rows($rs) ; $i++){
					   		$row = pg_fetch_array($rs);
					   		print('<option value="'.$row[0] .'">'.$row[0] .'</option>');
							}
						?>
				<input type="submit" value="検索"class="kensaku">
			</form>
		</div>

		<div class="main">
		    <form action="keijiban.php" method="post">
		        番号:<input type="int" size="10" name="id" value=""class="suuzi"><br>
				名前:<input type="text" size="10" name="name" value="" class="namae"><br>
		        <div class="honbun"><span class="label"><textarea name="name2" cols="30" rows="3" maxlength="150" wrap="hard" placeholder="150字以内で入力してください。"></textarea></div>
		        <input type="submit"size="40"value="投稿する" class="button">
		    </form>
		</div>
		</section>
		<h2>投稿一覧</h2>
		<div class="note">
		    <?php
				if(array_key_exists('id',$_POST)){
					$id = $_POST['id'];
					$name = $_POST['name'];
					$contents = $_POST['name2'];
					if ($contents) {
						  $contents = pg_escape_string(htmlspecialchars($contents));
						  pg_query($conn, "insert into testdb values($id,'$name','$contents')");
					}
				}
				if(array_key_exists('名前',$_POST)){
					$searchname = $_POST['名前'];
					$rs = pg_query($conn, "select id,name,name2 from testdb where name='$searchname'");
					for ($i = 0 ; $i < pg_num_rows($rs) ; $i++){
					   		$row = pg_fetch_array($rs);
					   		print('<li>id:'.$row[0] .'名前:'.$row[1]. '本文:'.$row[2].'</li>');
							}
				}else{
					$rs = pg_query($conn, "select id,name,name2 from testdb");
					for ($i = 0 ; $i < pg_num_rows($rs) ; $i++){
					   		$row = pg_fetch_array($rs);
					   		print('<li>id:'.$row[0] .'名前:'.$row[1]. '本文:'.$row[2].'</li>');
							}
				}
				pg_close($conn);
			?>
	
		</div>
		</form>
	</body>
</html>
