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
		<div class="loginContent">
			<?= $content ?>
		</div>
	</body>
</html>