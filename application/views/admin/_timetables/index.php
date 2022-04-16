<?= form::open(null, array('method'=>'get')) ?>
	<div class="searchBox">
		<div class="searchFormEl">
			<label>Data:</label>
			<input type="date" name="date[0]" value="<?= @$_GET['date'][0] ?>" />
			 - 
			<input type="date" name="date[1]" value="<?= @$_GET['date'][1] ?>" />
			<span class="error dateError">Data od nie może być większa niż data do!</span>
		</div>
		<div class="searchFormEl">
			<label>Lekarz:</label>
			<select name="user_id">
				<option value="">wybierz</option>
				<? foreach($users as $user): ?>
					<option value="<?= $user->id ?>"><?= $user->name.' '.$user->surname ?></option>
				<? endforeach ?>
			</select>
		</div>
		<!--div class="searchFormEl">
			<label>Status:</label>
			<input type="radio" name="status" value="1" <?= @$_GET['status']==1 ? 'checked' : null ?> /> wolne
			<input type="radio" name="status" value="2" <?= @$_GET['status']==2 ? 'checked' : null ?> /> zarezerwowane
			<input type="radio" name="status" value="3" <?= @$_GET['status']==3 ? 'checked' : null ?> /> zrealizowane
		</div-->
		<input type="submit" class="button" value="Szukaj" />
		<a href="<?= URL::base() ?>index.php/admin/timetables/edit" class="linkButton">dodaj</a>
	</div>
<?= form::close() ?>

<table>
	<thead>
		<tr>
			<th>Dzień</th>
			<th>Lekarz</th>
			<!-->Status</th-->
			<th>Operacje</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($timetables as $timetable): ?>
			<tr>
				<td><?= $timetable->day ?></td>
				<td><?= $timetable->user->name.' '.$timetable->user->surname ?></td>
				<!--td>
					<?
						//if($timetable->patient_pesel) echo 'wolne'
					?>
				</td-->
				<td>
					<a href="<?= URL::base() ?>index.php/admin/timetables/edit/<?= $timetable->user->id.'?date='.$timetable->day ?>" class="linkButton">edytuj</a>
					<a href="<?= URL::base() ?>index.php/admin/timetables/delete_day/<?= $timetable->user->id.'?date='.$timetable->day ?>"  onclick="return confirm('Na pewno chcesz usunąć?')" class="linkButton">usuń</a>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>

<script>
	$(document).ready(function(){
		// data 0 nie może być większa od 1
		$('input[name="date[0]"]').change(function(){
			check_dates();
		});
		$('input[name="date[1]"]').change(function(){
			check_dates();
		});
		function check_dates(){
			var date0=$('input[name="date[0]"]').val();
			var date1=$('input[name="date[1]"]').val();
			if(date0 && date1 && date0>date1){
				$('input[name="date[1]"]').val(date0)
				$('.dateError').show();
			}else{
				$('.dateError').hide();
			}
		}
		
		/*
		// zerowanie wyboru statusu
		var status=$('input[name=status]').val() ? $('input[name=status]').val() : 0;
		$('input[name=status]').click(function(){
			if(status==$(this).val()){
				status=0;
				$(this).prop('checked', false);
			}else{
				status=$(this).val();
			}
		});//*/
	});
</script>