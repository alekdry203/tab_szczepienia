<div class="menuBox">
	<a href="<?= URL::base() ?>index.php/admin/users/index">
		<span class="menuButton">Użytkownicy</span>
	</a>
	<a href="<?= URL::base() ?>index.php/admin/warehouse/index">
		<span class="menuButton">Magazyn</span>
	</a>
	<a href="<?= URL::base() ?>index.php/admin/timetables/index">
		<span class="menuButton">Okienka</span>
	</a>
	<a href="<?= URL::base() ?>index.php/admin/patients/index">
		<span class="menuButton">Pacjenci</span>
	</a>
	<div class="userBox">
		<?= @$_SESSION['login'] ?>
		<a href="<?= URL::base() ?>index.php/admin/login/logout">
			<span class="menuButton">wyloguj</span>
		</a>
	</div>
</div>