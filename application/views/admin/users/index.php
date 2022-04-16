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
		<div class="searchFormEl">
			<label>Admin:</label>
			<input type="radio" name="admin" value="1" <?= @$_GET['admin']==1 ? 'checked' : null ?> /> tak
			<input type="radio" name="admin" value="-1" <?= @$_GET['admin']==-1 ? 'checked' : null ?> /> nie
		</div>
		<div class="searchFormEl">
			<input type="submit" class="button" value="Szukaj" />
			<a href="<?= URL::base() ?>index.php/admin/users/edit" class="linkButton">dodaj</a>
		</div>
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
				<td><?= $user->name.' '.$user->surname ?></td>
				<td><?= $user->login ?></td>
				<td><?= $user->admin ? 'tak' : 'nie' ?></td>
				<td>
					<a href="<?= URL::base() ?>index.php/admin/users/edit/<?= $user->id ?>" class="linkButton">edytuj</a>
					<a href="<?= URL::base() ?>index.php/admin/users/delete/<?= $user->id ?>" onclick="return confirm('Na pewno chcesz usunąć?')" class="linkButton">usuń</a>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>

<script>
	$(document).ready(function(){
		// zerowanie wyboru czy admin
		var admin=$('input[name=admin]').val() ? $('input[name=admin]').val() : 0;
		$('input[name=admin]').click(function(){
			if(admin==$(this).val()){
				admin=0;
				$(this).prop('checked', false);
			}else{
				admin=$(this).val();
			}
		});
	});
</script>