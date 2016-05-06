<?php
if(isset($_COOKIE['recent'])){
	$ids = $_COOKIE['recent'];
	$ids = explode(" ",$ids);
	
	$id = $_GET['id'];
	if(!in_array($id, $ids)){
		$ids[]=$id;
		$ids = implode($ids," ");
		setcookie("recent", $ids,time()-6);
		$_COOKIE['recent']=$ids;
	}
}
?>

<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>
		
		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/item.css'/>

	</head>

	<body>
	<?php
	header("Content-type: text/html; Charset=utf-8");
	require("viewsCount.php");
	?>
		<header>
			<a href=''>
				<img src='img/logo.png'/>
			</a>
			<nav>
				<ul>
					<li> <a href=''> Главная </a></li>
					<li> <a href='catalog/'> Каталог </a></li>
					<li> <a href='manager/'> Управление </a></li>

				</ul>
			</nav>
		</header>


		<main>
			<section class='main'>
				<figure>
					<?php
					require("fillContentItem.php");
					require("nameI.php");

					?>
					
					<img src='<?=$arr['img']?>'/>
					<figcaption>
					
						<h2> <?=$arr['name']?></h2>
						<p class='size'> Размер: <?=$arr['size']?></p>
						<p class='color'> Цвет: <?=$arr['color']?> </p>
						<div class='price'><?=$arr['price']?>  р.</div>

						<form action='item/add.php' method="POST">
							<input type='hidden' name='id' value='<?=$arr['id']?>'/>
							<input type='number' min=0 max=10  value=1 name='amount'/>
							<input type='submit' name='add' value='Добавить'/>
						</form>

						<p class='description'><?=$arr['desc']?></p>
					</figcaption>
				</figure>
			</section>

			<section class='gallery'>
				<h2> Фотогалерея этого товара: </h2>
				<ul>
				<li>
				<?php
				require('gallery.php');
				foreach ($arrPictures as $value) {
					echo "<img src ='$value' />";
				}

				?>
				</li>					
				</ul>
			</section>

			<section class='others'>
				<h2> Возможно, Вас заинтересуют:</h2>
				<ul class='items'>
					<?php 
			
require("randomItems.php");
require("nameRand.php"); 

		
		
foreach ($randomItems as $key => $value) { 
echo "<li class='item'>"; 
echo "<a href='item/index.php?id={$value['id']}'>"; 
echo "<figure>"; 
echo "<img src='{$value['img']}'/>"; 
echo "<figcaption>"; 
echo "<h3>{$value['name']}</h3>"; 
echo "<p class='color'> Цвет: {$value['color']}</p>"; 
echo "<p class='size'> Размер: {$value['size']}</p>"; 
echo "<p class='price'>{$value['price']}</p>"; 
echo "</figcaption>"; 
echo "</figure>"; 
echo "</a>"; 
echo "</li>"; 
} 
?>
				</ul>
			</section>
		</main>

	</body>

</html>