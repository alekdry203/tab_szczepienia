<?= form::open(null, array('method'=>'post')) ?>
	<input type="hidden" name="id" value="<?= @$user->id ?>" />
	<div class="formBox">
		<div class="formEl">
			<label>Imię:</label>
			<input type="text" name="name" value="<?= @$user->name ?>" />
		</div>
		<div class="formEl">
			<label>Nazwisko:</label>
			<input type="text" name="surname" value="<?= @$user->surname ?>" />
		</div>
		<div class="formEl">
			<label>Login:</label>
			<input type="text" name="login" value="<?= @$user->login ?>" />
		</div>
		<div class="formEl">
			<label>Hasło:</label>
			<input type="password" name="password" value="<?//= @$user->password ?>" />
		</div>
		<input type="submit" class="button" value="zapisz" />
		<? if(@$user->id): ?>
			<a href="<?= URL::base() ?>index.php/admin/users/delete<?= $user->id ?>" class="button">usuń</a>
		<? endif ?>
	</div>
<?= form::close() ?>