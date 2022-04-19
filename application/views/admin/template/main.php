<?
	/*
	 * to jest główny szablon widoków - tu mają być podstawowe rzeczy które powtarzają się na każdej stronie np.:
	 * tagi html head body (do head dać metatagi odpowiednie + tytul strony + dołączyć pliki css i js, do body dać content)
	 * content - do tej zmiennej controllery wrzucają odpowiednie widoki
	 * 
	 * Nie trzeba w każdym pliku pisac za każdym razem całego gumwa + można duży widok podzielić na kilka mniejszych i je później ze sobą odpowiednio łaczyć
	 * przydatne jak jakaś funkcjonalność jest identyczna w kilku miejscach - zamiast pisać kilka razy to samo to pisze się raz i wstawiam tam widoczek
	 * */
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>TAB Szczepienia</title>
		<script src="<?=URL::base() ?>media/js/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="<?=URL::base() ?>media/css/admin.css">
		
		<!--link rel="shortcut icon" href="<?=URL::base() ?>media/img/favicon.ico" type="image/x-icon"-->
	</head>
	<body>
		<?= View::factory('admin/template/header') ?>
		<?= View::factory('admin/template/menu') ?>
		<div class="content">
			<?= $content ?>
		</div>
	</body>
</html>