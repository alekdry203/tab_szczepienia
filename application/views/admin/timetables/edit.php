<?= form::open(null, array('method'=>'post')) ?>
	
	<div class="formBox">
		<input type="hidden" name="id" value="<?= $timetable->id ?>" />
		<div class="formEl">
			<label>Lekarz:</label>
			<select name="user_id" <?= !@$_SESSION['admin'] ? 'disabled' : null ?>>
				<option value="">wybierz</option>
				<? foreach($users as $user): ?>
					<option value="<?= $user->id ?>" <?= $user->id==$timetable->users_id ? 'selected' : null ?>><?= $user->name.' '.$user->surname ?></option>
				<? endforeach ?>
			</select>
		</div>
		<div class="formEl">
			<label>Dzień:</label>
			<input type="date" name="date" value="<?= date('Y-m-d', strtotime($timetable->vaccination_date)) ?>" />
		</div>
		<div class="formEl">
			<label>Godzina:</label>
			<input type="time" name="time" value="<?= date('H:i:s', strtotime($timetable->vaccination_date)) ?>" />
		</div>
		<div class="formEl">
			<label>PESEL pacjenta:</label>
			<input type="text" name="patients_pesel" value="<?= $timetable->patients_pesel ?>" />
		</div>
		dodać wybór szczepionki
		<div class="formEl">
			<label>Opłacono:</label>
			<input type="checkbox" name="payment" value="1" <?= $timetable->payment ? 'checked' : null ?> />
		</div>
		<div class="formEl">
			<label>PESEL pacjenta:</label>
			<input type="text" name="activation_code" value="<?= $timetable->activation_code ?>" disabled />
		</div>
	</div>
	<input type="submit" class="button" value="zapisz" />
	<a href="<?= URL::base() ?>index.php/admin/timetables/delete/<?= $timetable->id ?>"  onclick="return confirm('Na pewno chcesz usunąć?')" class="linkButton">usuń</a>
<?= form::close() ?>
