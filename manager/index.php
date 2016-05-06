<!doctype html>
<?php
    require_once('../lib/connection.php');
    require_once('../lib/Items.php');
    ?>
<html>
	<head>
		<meta charset='utf-8'/>
		<title> Clothes Store</title>

		<base href='../'/>

		<link rel='stylesheet' href='css/main.css'/>
		<link rel='stylesheet' href='css/manager.css'/>

		
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
			<form action='' method='POST' enctype='multipart/form-data'> 
				<h2> Добавить товар</h2>
				<label>
					<span> Название товара</span>
					<input type='text' name='name' value='' required/>
				</label>

				<label>
					<span> Цвет </span>
					<input type='text' name='color' list='colors' required/>
					<datalist id='colors'>
						<option value='Прозрачный'/>
						<option value='Зеленый'/>
						<option value='Синий'/>
						<option value='Белый'/>
					</datalist>
				</label>

				<label>
					<span> Размер </span>
					<input type='text' name='size' list='sizes' required/>
					<datalist id='sizes'>
						<option value='XS'/>
						<option value='S'/>
						<option value='M'/>
						<option value='L'/>
						<option value='XL'/>
					</datalist>
				</label>

				<label>
					<span> Цена </span>
					<input type='number' name='price' required/>
				</label>

				<label>
					<span>Изображение</span>
					<input type='file' name='picture' required/>
				</label>

				<label class="textarea">
                	<span> Описание товара</span>
                	<textarea name='desc' required/></textarea>
                </label>

				<input type='submit' value='Создать товар'/>
			</form>

			<?php
	               if (isset($_POST['name']) && isset($_FILES['picture'])){
                   $pic_location = $_FILES['picture']['tmp_name'];
                   if (!is_dir("../img/current")) mkdir("../img/current");
                   $file_name = "img/current/".md5($pic_location).".jpg";
                   touch("../".$file_name);
                   file_put_contents("../".$file_name, file_get_contents($pic_location));
                   $item = array("name"=>$_POST['name'], "desc"=>$_POST['desc'],
                                 "size"=>$_POST['size'], "color"=>$_POST['color'],
                                 "price"=>$_POST['price'], "img"=>$file_name);
                   if (Items::addItem($item)) echo "<br><h2>Запись добавлена в базу!</h2><br>";
               };
            ?>

			<form action='' method='POST' enctype='multipart/form-data'> 
				<h2> Добавить изображение товару </h2>
				<label>
					<span> ID товара</span>
					<input type='number' name='id'/>
				</label>

				<label>
					<span> Выберите файл..</span>
					<input type='file' name='image' />
				</label>
				<input type='submit' value='Добавить!'/>
			</form>

            <?php
               if (isset($_POST['id']) && isset($_FILES['image'])){
                    $current_location = $_FILES['image']['tmp_name'];
                    if (!is_dir("../img/".$_POST['id'])) mkdir("../img/".$_POST['id']);
                    $file_name = "img/".$_POST['id']."/".md5($current_location).".jpg";
                    touch("../".$file_name);
                    file_put_contents("../".$file_name, file_get_contents($current_location));
                    if (Items::addImageTo($_POST['id'], $file_name)) echo "<br><h2>Запись добавлена в базу!</h2><br>";
                 };
            ?>


			<p> <a href='manager/excel.php' target='_blank'> Выгрузить все товары в Excel </a></p>
			<p> <a href='manager/stats.php' target='_blank'> Выгрузить статистику в Excel </a></p>

		</main>
	</body>

</html>