
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
		<title>Tortotoro</title>
		<link rel="icon" href="img/favicon.ico" type="image/x-icon">
		<!--Описание стилей для меню, контента, подвала-->
		<link rel="stylesheet" href="../css/style-1.css">
		<link rel="stylesheet" href="../css/tabs.css">
		<!--Обмен данными с веб-сервером с помощью AJax-->
		<script src="js/index.js"></script>
		<script src="js/dom.js"></script>
		<script src="js/tabs.js"></script>
		<script src="js/timer.js"></script>
		<script src="../js/dropdown.js" defer></script>
	</head>
 <body>
		<!--Верхний блок страницы: Меню-->
		<header>
			<div class="logo1">
			<div class="logo11">
				<?php 
					$id = $_GET['id'];
					mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
					$connect = mysqli_connect('localhost', 'root', '', 'sweetshop');
	
					$user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id'");
					$selected_user = mysqli_fetch_assoc($user);
					$img = $selected_user['photo_file'];
                	$imageData = base64_encode($img);
					$imageSrc = "data:{$imageSize['mime']};base64,{$imageData}";
					if (!isset($img)) {
						$imageSrc = '../img/user1.png';
					}
					?>
				<div class="logo2">
					<img src="<?=$imageSrc?>" width="55" height="50">
				</div>
				<p><?= $selected_user['email']; ?></p><br><br>
				<p class="role">
				<?php
					if ($selected_user['role_id'] == 1) {
						?>
							Администратор
						<?php
					} else if ($selected_user['role_id'] == 2) {
						?>
							Официант
						<?php
					} else {
						?>
							Повар
						<?php
					}
				?> 
				</p>
			     </div>
			</div>
				<a href="logout.php" class="logout">Выйти</a>
			<div class="nav-scroll">
				<nav class="nav-scroll_items">
					<!--Ссылки на все вкладки-->
					<a class="nav-scroll_item" href="admin.php?id=<?= $id ?>">Главная</a>
					<a class="nav-scroll_item" href="order_list.php?id=<?= $id ?>" onclick="linkcontent('zakazi.php');">Формы</a>
					<a class="nav-scroll_item" href="registration.php?id=<?= $id ?>">Регистрация нового сотрудника</a>
					<a class="nav-scroll_item" href="employee_list.php?id=<?= $id ?>">Сотрудники</a>
					<!--Конец ссылок-->
				</nav>
			</div>
		</header>
		<!--Средний блок: Контент -->
        <main>
            <div class="container">
                <div class="page">
                    <div class="page__warning">
                        Просмотр заказов
                    </div>
                    <div class="page__list">
                        <?php
                            $connect = mysqli_connect('localhost', 'root', '', 'sweetshop');
                            $result = mysqli_query($connect, "SELECT * FROM `forms`");
                            while ($order = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="page__order small">
                                    <div class="page__name_order"> № <?php echo $order['id']?></div>
                                    <div class="page__timing">
                                        <div class="page__table">ФИО: <span class="highlight"><?php echo $order['name']?></span></div>
                                    </div>
                                    <div class="page__person">
                                        <div class="page__table">Телефон: <span class="highlight"><?php echo $order['phone']?></span></div>
                                    </div>
                                    <div class="page__person">
                                        <div class="page__table">E-mail: <span class="highlight">
										<span class="ready"><?php echo $order['email']?> </span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>

                </div>
            </div>
        </main>
	<!-- Блок сообщений пользователю -->
	<div id="loading" style="display: none">Идёт загрузка...</div>
	<!--Нижний блок (подвал): авторские права-->
	<footer>
		<center><div class="text-block">© 2023 Klod Mane. Все права защищены.</div></center>
	</footer>
 </body>
</html>