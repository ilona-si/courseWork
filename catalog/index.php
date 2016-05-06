<?php
header("Content-type: text/html; Charset=utf-8");
?>
<!doctype html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>
		
		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/catalog.css'/>

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
			<section class='search'>
				<form action='' method='get'>
					<label>
						<span> Название или часть названия </span>
						<input type='text' name='name' />
					</label>

					<label>
						<span> Цвет</span>
						<select name='color'>
						<?php
						require("getColor.php");
						require("getSize.php");
						
						foreach ($arrColors as  $value) {
							echo "<option value='$value'>$value</option>";
						}
						?>
						</select>
					</label>

					<label>
						<span> Размер</span>
						<select name='size'>
						<?php
						foreach ($arrSizes as $value) {
							echo "<option value='$value'>$value</option>";
						}
						?>
						</select>
					</label>

					<label>
						<span> Цена от</span>
						<input type='number' name='price_from' value='100000'/>
					</label>


					<label>
						<span> Цена до</span>
						<input type='number' name='price_to' value='5700000'/>
					</label>

					<input type='submit' name='search' value='Поиск'/> 
				</form>
			</section>

			<section class='all'>
				<h2> Все товары в <i>Clothes Store</i></h2>
				<ul class='items'>
					
					<?php

					require_once("../lib/Items.php");
					
					if($_GET)
					{

						$data=Items::search($_GET);
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
					}
					else
					{
						
					$data=Items::getItems(4);
					//$data=Items::getItems($n);


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
				}
					?>
				</ul>
			</section>

		</main>

	</body>

</html>