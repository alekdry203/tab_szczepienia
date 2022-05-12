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
			<label>Szczepionki:</label>
			<select name="vaccine">
				<option value="">wybierz</option>
				<? foreach($vaccines as $vaccine): ?>
					<?
						$get_id=$vaccine->name.';'.$vaccine->producer;
					?>
					<option value="<?= $get_id ?>" <?= $get_id==@$_GET['vaccine'] ? 'selected' : null ?>><?= $vaccine->name.' ['.$vaccine->producer.']' ?></option>
				<? endforeach ?>
			</select>
		</div>
		<div class="searchFormEl">
			<label>Status:</label>
			<input type="radio" name="status" value="2" <?= @$_GET['status']==2 ? 'checked' : null ?> /> zarezerwowane
			<input type="radio" name="status" value="3" <?= @$_GET['status']==3 ? 'checked' : null ?> /> zrealizowane
		</div>
		<input type="submit" class="button" style="font-size: 18px;" value="Szukaj" />
		<a href="<?= URL::base() ?>index.php/vaccinations/index" class="button">zapisz się</a>
	</div>
<?= form::close() ?>

<table class="table">
	<thead>
		<tr>
			<th>Dzień</th>
			<th>Szczepionka</th>
			<th>Status</th>
			<th>Operacje</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($vaccinations as $vaccination): ?>
			<tr>
				<td><?= $vaccination->vaccination_date ?></td>
				<td><?= $vaccination->vaccine->name.' '.$vaccination->vaccine->producer ?></td>
				<td><?= $vaccination->payment ? 'zrealizowane' : 'zarezerwowane' ?></td>
				<td>
					<?/* if($vaccination->payment): ?>
						<a href="<?= URL::base() ?>index.php/patients/vaccination_pdf/<?= $vaccination->id ?>" class="linkButton">PDF</a>
					<? else: ?>
						<a href="<?= URL::base() ?>index.php/patients/deny_vaccination/<?= $vaccination->id ?>" onclick="return confirm('Na pewno chcesz zrezygnować?')" class="linkButton">zrezygnuj</a>
					<? endif//*/ ?>
					<a href="<?= URL::base() ?>index.php/patients/vaccination_pdf/<?= $vaccination->id ?>" class="linkButton">PDF</a>
					<a href="<?= URL::base() ?>index.php/patients/deny_vaccination/<?= $vaccination->id ?>" onclick="return confirm('Na pewno chcesz zrezygnować?')" class="linkButton">zrezygnuj</a>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>

<script>
	$(document).ready(function(){
		check_dates();
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