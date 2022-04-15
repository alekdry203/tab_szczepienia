<?= form::open(null, array('method'=>'post')) ?>
	<div class="loginBox">
		<div class="loginFormEl">
			<label>login:</label>
			<input type="text" name="login" required />
		</div>
		<div class="loginFormEl">
			<label>hasło:</label>
			<input type="password" name="password" required />
		</div>
		<? if(@$_POST): ?>
			<span class="loginError">Niepoprawny login lub hasło!</span>
		<? endif ?>
		<input type="submit" class="button" value="Zaloguj" />
	</div>
<?= form::close() ?>