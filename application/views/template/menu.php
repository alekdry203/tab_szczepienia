<div class="menuBox">
	<a href="<?= URL::base() ?>index.php/vaccinations/index">
		<span class="menuButton">Szczepienia</span>
	</a>
	<a href="<?= URL::base() ?>index.php/vaccinations/vaccines">
		<span class="menuButton">Szczepionki</span>
	</a>
	<?//*/?>
	<div class="userBox">
		<? if(@$_SESSION['user_id']): ?>
			<?= @$_SESSION['login'] ?>
			<a href="<?= URL::base() ?>index.php/login/logout">
				<span class="menuButton">wyloguj</span>
			</a>
		<? else: ?>
			<a href="<?= URL::base() ?>index.php/login/index">
				<span class="menuButton">zaloguj</span>
			</a>
		<? endif ?>
	</div>
	<?//*/?>
</div>