<?= form::open(null, array('method'=>'get')) ?>
	<div class="searchBox">
		<div class="searchFormEl">
			<label>PESEL:</label>
			<input type="text" name="pesel" value="<?= @$_GET['pesel'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Imię:</label>
			<input type="text" name="name" value="<?= @$_GET['name'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Nazwisko:</label>
			<input type="text" name="surname" value="<?= @$_GET['surname'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Miejscowość:</label>
			<input type="text" name="city" value="<?= @$_GET['city'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Ulica:</label>
			<input type="text" name="street" value="<?= @$_GET['street'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Numer lokalu:</label>
			<input type="text" name="local_no" value="<?= @$_GET['local_no'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Adres e-mail:</label>
			<input type="text" name="email" value="<?= @$_GET['email'] ?>" />
		</div>
		<div class="searchFormEl">
			<input type="submit" class="button" value="Szukaj" />
			<a href="<?= URL::base() ?>index.php/admin/patients/edit" class="linkButton">dodaj</a>
		</div>
	</div>
<?= form::close() ?>

<table>
	<thead>
		<tr>
			<th>PESEL</th>
			<th>Imię i nazwisko</th>
			<th>Adres zamieszkania</th>
			<th>Adres e-mail</th>
			<th>Operacje</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($patients as $patient): ?>
			<tr>
				<td><?= $patient->pesel ?></td>
				<td><?= $patient->name.' '.$patient->surname ?></td>
				<td><?= $patient->city.', '.$patient->street.' '.$patient->local_no ?></td>
				<td><?= $patient->email ?></td>
				<td>
					<a href="<?= URL::base() ?>index.php/admin/patients/edit/<?= $patient->pesel ?>" class="linkButton">edytuj</a>
					<a href="<?= URL::base() ?>index.php/admin/timetables?patient_pesel=<?= $patient->pesel ?>" class="linkButton">szczepienia</a>
					<a href="<?= URL::base() ?>index.php/admin/patients/delete/<?= $patient->pesel ?>" onclick="return confirm('Na pewno chcesz usunąć?')" class="linkButton">usuń</a>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
