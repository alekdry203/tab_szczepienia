<?= form::open(null, array('method'=>'post')) ?>
	<div class="formBox">
		<div class="formEl">
			<label>Numer partii:</label>
			<input type="text" name="serial_no" value="<?= @$vaccine->serial_no ?>" required />
			sprawdzić ajaxem czy można taki dodać
		</div>
		<div class="formEl">
			<label>Nazwa:</label>
			<input type="text" name="name" value="<?= @$vaccine->name ?>" required />
		</div>
		<div class="formEl">
			<label>Producent:</label>
			<input type="text" name="producer" value="<?= @$vaccine->producer ?>" required />
		</div>
		<div class="formEl">
			<label>Data ważności:</label>
			<input type="date" name="expiration_date" value="<?= @$vaccine->expiration_date ?>" required />
		</div>
		<input type="submit" class="button" value="zapisz" />
		<? if(@$vaccine->serial_no): ?>
			<a href="<?= URL::base() ?>index.php/admin/users/delete<?= $vaccine->serial_no ?>" class="button">usuń</a>
		<? endif ?>
	</div>
<?= form::close() ?>