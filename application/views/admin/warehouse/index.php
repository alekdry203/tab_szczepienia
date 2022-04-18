<?= form::open(null, array('method'=>'get')) ?>
	<div class="searchBox">
		<div class="searchFormEl">
			<label>Numer partii:</label>
			<input type="text" name="serial_no[0]" value="<?= @$_GET['serial_no'][0] ?>" />
			 - 
			<input type="text" name="serial_no[1]" value="<?= @$_GET['serial_no'][1] ?>" />
			<span class="error serialNoError">Numer partii od nie może być większy niż numer partii do!</span>
		</div>
		<div class="searchFormEl">
			<label>Nazwa:</label>
			<input type="text" name="name" value="<?= @$_GET['name'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Producent:</label>
			<input type="text" name="producer" value="<?= @$_GET['producer'] ?>" />
		</div>
		<div class="searchFormEl">
			<label>Data ważności:</label>
			<input type="date" name="expiration_date[0]" value="<?= @$_GET['expiration_date'][0] ?>" />
			 - 
			<input type="date" name="expiration_date[1]" value="<?= @$_GET['expiration_date'][1] ?>" />
			<span class="error dateError">Data od nie może być większa niż data do!</span>
		</div>
		<input type="submit" class="button" value="Szukaj" />
		<a href="<?= URL::base() ?>index.php/admin/warehouse/add" class="linkButton">dodaj</a>
	</div>
<?= form::close() ?>

<table>
	<thead>
		<tr>
			<th>Nazwa</th>
			<th>Producent</th>
			<th>Numer partii</th>
			<th>Data ważności</th>
			<th>Status</th>
			<th>Operacje</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($warehouse as $vaccine): ?>
			<tr>
				<td><?= $vaccine->name ?></td>
				<td><?= $vaccine->producer ?></td>
				<td><?= $vaccine->serial_no ?></td>
				<td><?= $vaccine->expiration_date ?></td>
				<td><?= $vaccine->timetables->count_all() ? 'wykorzystane' : 'wolne' ?></td>
				<td>
					<a href="<?= URL::base() ?>index.php/admin/warehouse/edit/<?= $vaccine->serial_no ?>" class="linkButton">edytuj</a>
					<a href="<?= URL::base() ?>index.php/admin/warehouse/delete/<?= $vaccine->serial_no ?>" onclick="return confirm('Na pewno chcesz usunąć?')" class="linkButton">usuń</a>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>


<script>
	$(document).ready(function(){
		// data 0 nie może być większa od 1
		$('input[name="expiration_date[0]"]').change(function(){
			check_dates();
		});
		$('input[name="expiration_date[1]"]').change(function(){
			check_dates();
		});
		function check_dates(){
			var date0=$('input[name="expiration_date[0]"]').val();
			var date1=$('input[name="expiration_date[1]"]').val();
			if(date0 && date1 && date0>date1){
				$('input[name="expiration_date[1]"]').val(date0)
				$('.dateError').show();
			}else{
				$('.dateError').hide();
			}
		}
		
		// numer 0 nie może być większy od 1
		$('input[name="serial_no[0]"]').change(function(){
			check_serial_no();
		});
		$('input[name="serial_no[1]"]').change(function(){
			check_serial_no();
		});
		function check_serial_no(){
			var date0=$('input[name="serial_no[0]"]').val();
			var date1=$('input[name="serial_no[1]"]').val();
			if(date0 && date1 && date0>date1){
				$('input[name="serial_no[1]"]').val(date0)
				$('.serialNoError').show();
			}else{
				$('.serialNoError').hide();
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