<?php
header("Content-type: text/html; Charset=utf-8");
?>
<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/index.css'/>

	</head>

	<body>
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
			<section class='new'>
				<h2> Новые товары в <i>Clothes Store</i></h2>
				<p> Здесь вы найдете свежие поступления в нашем магазине.</p>
				<ul class='items'>
					<?php
					require_once("lib/Items.php");

						$data=Items::getLatest();
						
						for ($i=0; $i<count($data); $i++)
						{ 
							$data[$i]['price']=number_format($data[$i]['price'],0,"."," ");
							echo "	<li class='item'> 
							<a href='item/index.php?id={$data[$i]['id']}'>
								<figure>
									<img src='./{$data[$i]['img']}'/> ".
									"<figcaption>
										<h3>".Items::proceedName($data[$i]['name'])."</h3>
										<p class='color'> Цвет: {$data[$i]['color']} </p>
										<p class='size'> Размер: {$data[$i]['size']}</p>
										<p class='price'>{$data[$i]['price']} р.</p>
									</figcaption>
								</figure>
							</a>
						</li>";
						}
					?>
				</ul>
			</section>

			<section class='populars'>
				<h2> Популярное в <i>Clothes Store</i></h2>
				<p> В эту категорию попадают самые популярные у посетителей Clothes Store товары.</p>
				<ul class='items'>
					<?php
						
						$data=Items::getPopulars();
						for ($i=0; $i<count($data); $i++){
						 
							$data[$i]['price']=number_format($data[$i]['price'],0,"."," ");
							echo "	<li class='item'> 
							<a href='item/index.php?id={$data[$i]['id']}'>
								<figure>
									<img src='./{$data[$i]['img']}'/> ".//Возможно вместо 1 -2 точки!!!
									"<figcaption>
										<h3>".Items::proceedName($data[$i]['name'])."</h3>
										<p class='color'> Цвет: {$data[$i]['color']} </p>
										<p class='size'> Размер: {$data[$i]['size']}</p>
										<p class='price'>{$data[$i]['price']} р.</p>
									</figcaption>
								</figure>
							</a>
						</li>";
						}
					?>
				</ul>
			</section>
		</main>

		<aside>
			<section class='search'>
				<h3> Поиск по каталогу</h3>
				<form action='catalog/'>
					<input type='text' name='name' placeholder='Название или часть названия'/><input type='submit' name='search'/>
				</form>
			</section>

			<section>
				<h3> Вы недавно просматривали:</h3>
				<ul>
					
					<li> <a href='catalog/'> Футболка мужская Middle Eastern </a></li>
					<li> <a href='catalog/'> Футболка мужская Middle Eastern </a></li>
				</ul>
			</section>

			<section class='ads'>
				<h3> Специальные предложения от <i>Clothes Store</i></h3>
				<ul>

					<?php
					$array=scandir("./img/ads");
					$newArray=array();
					for($i=0;$i<count($array);$i++)
					{		
						if (is_file("./img/ads/$array[$i]"))
						{
						  $newArray[]=$array[$i];		
						}
					}
					 $first=rand(0,count($newArray)-1);
					 $second=rand(0,count($newArray)-1);
					if ($first!==$second) {
						echo "	<li> <img src='./img/ads/{$newArray[$first]}'/> </li>
					<li> <img src='img/ads/{$newArray[$second]}'/> </li>"	;	
					}
					else while ($first===$second) {
						$second=rand(0,count($newArray));
					}
				?>
				</ul>
			</section>

		</aside>
	</body>

</html>