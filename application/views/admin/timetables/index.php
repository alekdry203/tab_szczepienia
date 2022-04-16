<?= form::open(null, array('method'=>'get')) ?>
	<div class="searchBox">
		<div class="searchFormEl">
			<label>Data:</label>
			<input type="date" name="date[]" value="<?= @$_GET['date'][0] ?>" />
			 - 
			<input type="date" name="date[]" value="<?= @$_GET['date'][1] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Lekarz:</label>
			<select name="user_id">
				<option value="">wybierz</option>
				<? foreach($users as $user): ?>
					<option value=""><?= $user->name.' '.$user->surname ?></option>
				<? endforeach ?>
			</select>
		</div>
		<div class="searchFormEl">
			<label>Status:</label>
			<input type="radio" name="status" value="1" <?= @$_GET['status']==1 ? 'checked' : null ?> /> wolne
			<input type="radio" name="status" value="2" <?= @$_GET['status']==2 ? 'checked' : null ?> /> zarezerwowane
			<input type="radio" name="status" value="3" <?= @$_GET['status']==3 ? 'checked' : null ?> /> zakończone
		</div>
		<input type="submit" class="button" value="Szukaj" />
		<a href="<?= URL::base() ?>index.php/admin/timetable/add" class="linkButton">dodaj</a>
	</div>
<?= form::close() ?>

<table>
	<thead>
		<tr>
			<th>Dzień</th>
			<th>Lekarz</th>
			<th>Status</th>
			<th>Operacje</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($timetables as $timetable): ?>
			<tr>
				<td><?= $user->day ?></td>
				<td><?= $user->login ?></td>
				<td><?= $user->admin ? 'tak' : 'nie' ?></td>
				<td>
					<a href="<?= URL::base() ?>index.php/admin/users/edit<?= $user->id ?>" class="linkButton">edytuj</a>
					<a href="<?= URL::base() ?>index.php/admin/users/delete<?= $user->id ?>" class="linkButton">usuń</a>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>