<?= form::open(null, array('method'=>'post')) ?>
	<div class="formBox">
		<div class="formEl">
			<label>PESEL:</label>
			<input type="text" name="pesel" value="<?= @$patient->pesel ?>" disabled />
		</div>
		<div class="formEl">
			<label>Imię:</label>
			<input type="text" name="name" value="<?= @$patient->name ?>" />
		</div>
		<div class="formEl">
			<label>Nazwisko:</label>
			<input type="text" name="surname" value="<?= @$patient->surname ?>" />
		</div>
		<div class="formEl">
			<label>Miejscowość:</label>
			<input type="text" name="city" value="<?= @$patient->city ?>" />
		</div>
		<div class="formEl">
			<label>Ulica:</label>
			<input type="text" name="street" value="<?= @$patient->street ?>" />
		</div>
		<div class="formEl">
			<label>Numer lokalu:</label>
			<input type="text" name="local_no" value="<?= @$patient->local_no ?>" />
		</div>
		<div class="formEl">
			<label>Adres e-mail:</label>
			<input type="text" name="email" value="<?= @$patient->email ?>" />
		</div>
		<input type="submit" class="button" value="zapisz" />
	</div>
<?= form::close() ?>