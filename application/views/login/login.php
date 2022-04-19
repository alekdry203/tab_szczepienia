<div class="loginBox">
	<label class="loginBoxTitle">Logowanie</label>
	<?= form::open(null, array('method'=>'post')) ?>
		<div class="loginFormEl">
			<label>PESEL:</label>
			<input type="text" name="pesel" value="<?= @$_POST['pesel'] ?>" <?= @$_POST ? 'disabled' : 'required' ?> />
		</div>
		<? if(@$_POST['pesel']): ?>
			<div class="loginFormEl">
				<label>Kod aktywacyjny:</label>
				<input type="text" name="action_code" required />
				<input type="hidden" name="pesel_confirm" value="<?= @$_POST['pesel'] ?>" />
			</div>
		<? endif ?>
		<div class="loginFormEl">
			<input type="submit" class="button" value="Zaloguj" />
		</div>
	<?= form::close() ?>
</div>