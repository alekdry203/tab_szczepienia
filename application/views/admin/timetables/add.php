<?= form::open(null, array('method'=>'post')) ?>
	
	<div class="formBox">
		<div class="formEl">
			<label>Lekarz:</label>
			<select name="user_id" <?= !@$_SESSION['admin'] ? 'disabled' : null ?> required>
				<option value="">wybierz</option>
				<? foreach($users as $user): ?>
					<option value="<?= $user->id ?>" <?= $user->id==@$_SESSION['user_id'] ? 'selected' : null ?>><?= $user->name.' '.$user->surname ?></option>
				<? endforeach ?>
			</select>
		</div>
		<div class="formEl">
			<label>Dzień:</label>
			<input type="date" name="date" value="" required />
		</div>
		<div class="formEl">
			<label>Godzina:</label>
			<input type="time" name="time" value="" required />
		</div>
		<div class="formEl">
			<label>Długość okienka:</label>
			<input type="number" min="1" name="period" value="" required /> [min.]
		</div>
		<div class="formEl">
			<label>Ilość okienek:</label>
			<input type="number" min="1" name="amount" value="" required />
		</div>
	</div>
	<input type="submit" class="button" value="zapisz" />
<?= form::close() ?>