<div class="loginBox">
	<label class="loginBoxTitle">Logowanie</label>
	<?= form::open(null, array('method'=>'post')) ?>
		<div class="loginFormEl">
			<label>PESEL:</label>
			<input type="text" name="pesel" value="<?= @$_POST['pesel'] ?>" <?= @$_POST['pesel'] && !@$_POST['failed']['pesel'] ? 'disabled' : 'required' ?> />
		</div>
		<? if(@$_POST['pesel'] && !@$_POST['failed']['pesel']): ?>
			<div class="loginFormEl">
				<label>Kod aktywacyjny:</label>
				<input type="text" name="action_code" required />
				<input type="hidden" name="pesel_confirm" value="<?= @$_POST['pesel'] ?>" />
			</div>
			<span class="notify">Na mailu znajduje się kod sprawdzający potrzebny do zalogowania.</span>
		<? else: ?>
			<span class="error">Coś poszło nie tak, spróbuj ponownie</span>
		<? endif ?>
		<div class="loginFormEl">
			<input type="submit" class="button" value="Zaloguj" />
		</div>
	<?= form::close() ?>
</div>