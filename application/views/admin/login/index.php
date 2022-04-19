<div class="loginBox">
	<?= form::open(null, array('method'=>'post')) ?>
		<div class="loginFormEl">
			<label>login:</label>
			<input type="text" name="login" required />
		</div>
		<div class="loginFormEl">
			<label>hasło:</label>
			<input type="password" name="password" required />
		</div>
		<div class="loginFormEl">
			<? if(@$_POST): ?>
				<span class="loginError">Niepoprawny login lub hasło!</span>
				<br />
			<? endif ?>
			<input type="submit" class="button" value="Zaloguj" />
			<a href="<?= URL::base() ?>index.php/">
				<span class="linkButton">strona główna</span>
			</a>
		</div>
	<?= form::close() ?>
</div>