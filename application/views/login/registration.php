<div class="loginBox">
	<label class=" ">Rejestracja</label>
	<?= form::open(null, array('method'=>'post')) ?>
		<input type="hidden" name="registration" value="1" />
		<div class="loginFormEl">
			<label>PESEL:</label>
			<input type="text" name="pesel" required />
		</div>
		<div class="loginFormEl">
			<label>Imię:</label>
			<input type="text" name="name" required />
		</div>
		<div class="loginFormEl">
			<label>Nazwisko:</label>
			<input type="text" name="surname" required />
		</div>
		<div class="loginFormEl">
			<label>Miejscowość:</label>
			<input type="text" name="city" required />
		</div>
		<div class="loginFormEl">
			<label>Ulica:</label>
			<input type="text" name="street" required />
		</div>
		<div class="loginFormEl">
			<label>Numer lokalu:</label>
			<input type="text" name="local_no" required />
		</div>
		<div class="loginFormEl">
			<label>Adres e-mail:</label>
			<input type="text" name="email" required />
		</div>
		<div class="loginFormEl">
			<input type="submit" class="button" value="Zarejestruj" />
			(dodać recaptche?)
		</div>
	<?= form::close() ?>
</div>