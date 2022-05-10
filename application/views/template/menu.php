<div class="menuBox">
	<a href="<?= URL::base() ?>index.php/vaccinations/index">
		<span class="menuButton">Szczepienia</span>
	</a>
	<a href="<?= URL::base() ?>index.php/vaccinations/vaccines">
		<span class="menuButton">Szczepionki</span>
	</a>
	<? if(@$_SESSION['pesel']): ?>
		<a href="<?= URL::base() ?>index.php/patients/vaccinations">
			<span class="menuButton">Moje szczepienia</span>
		</a>
		<a href="<?= URL::base() ?>index.php/patients/index">
			<span class="menuButton">Moje konto</span>
		</a>
	<? endif ?>
	
	<?//*/?>
	<div class="userBox">
		<? if(@$_SESSION['pesel']): ?>
			<?= @$_SESSION['user_name'][0].'. '.@$_SESSION['user_surname'] ?>
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