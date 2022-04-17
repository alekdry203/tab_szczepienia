<?= form::open(null, array('method'=>'get')) ?>
	<div class="searchBox">
		<div class="searchFormEl">
			<label>Imię:</label>
			<input type="text" name="name" value="<?= @$_GET['name'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Nazwisko:</label>
			<input type="text" name="surname" value="<?= @$_GET['surname'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Login:</label>
			<input type="text" name="login" value="<?= @$_GET['login'] ?>" />
		</div>
		<input type="submit" class="button" value="Szukaj" />
		<a href="<?= URL::base() ?>index.php/admin/users/edit" class="linkButton">dodaj</a>
	</div>
<?= form::close() ?>

<table>
	<thead>
		<tr>
			<th>Imię i nazwisko</th>
			<th>Login</th>
			<th>Admin</th>
			<th>Operacje</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($users as $user): ?>
			<tr>
				<td><?= $user->name.' '.$surname ?></td>
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