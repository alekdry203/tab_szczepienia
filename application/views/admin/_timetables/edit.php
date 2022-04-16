<?= form::open(null, array('method'=>'post')) ?>
	
	<div class="formBox">
		<div class="formEl">
			<label>Lekarz:</label>
			<select name="user_id" <?= !@$_SESSION['admin'] ? 'disabled' : null ?>>
				<option value="">wybierz</option>
				<?
					$user_id=@$timetables[0]->users_id;
					if(!$user_id) $user_id=$_SESSION['user_id'];
				?>
				<? foreach($users as $user): ?>
					<option value="<?= $user->id ?>" <?= $user->id==$user_id ? 'selected' : null ?>><?= $user->name.' '.$user->surname ?></option>
				<? endforeach ?>
			</select>
			<span class="error doctorError">Musisz wybrać lekarza!</span>
		</div>
		<div class="formEl">
			<label>Dzień:</label>
			<input type="date" name="date" value="<?= @$_GET['date'] ?>" />
			<span class="error dateError">Musisz wybrać dzień!</span>
		</div>
		<div class="formEl">
			<label>Godzina:</label>
			<input type="time" name="time" value="" />
			<span class="error timeError">Musisz wybrać godzinę rozpoczęcia!</span>
		</div>
		<div class="formEl">
			<label>Długość okienka:</label>
			<input type="number" min="1" name="period" value="" /> [min.]
			<span class="error periodError">Musisz wpisać długość okienka!</span>
		</div>
		<div class="formEl">
			<label>Ilość okienek:</label>
			<input type="number" min="1" name="amount" value="" />
			<span class="error amountError">Musisz wpisać ilkość okienek!</span>
		</div>
		<div class="formEl">
			<span class="button addTimetablesButton" onclick="add_timetables()">dodaj</span>
		</div>
	</div>
	
	<table>
		<thead>
			<tr>
				<th>Data i godzina</th>
				<th>Status</th>
				<th>Operacje</th>
			</tr>
		</thead>
		<tbody class="timetablesBox">
			<? if(@$timetables) foreach($timetables as $timetable): ?>
				<tr>
					<td>
						<input type="hidden" name="id[]" value="<?= $timetable->id ?>" />
						<input type="hidden" name="patients_pesel[]" value="<?= $timetable->patients_pesel ?>" />
						<input type="hidden" name="payment[]" value="<?= $timetable->payment ?>" />
						<input type="hidden" name="activation_code[]" value="<?= $timetable->activation_code ?>" />
						dn. <input type="date" name="vaccination_date_day[]" value="<?= $timetable->day ?>" />
						o godz. <input type="time" name="vaccination_date_time[]" value="<?= str_replace($timetable->day.' ', '', $timetable->vaccination_date) ?>" />
					</td>
					<td>
						<?
							if(!$timetable->patients_pesel) echo 'wolne';
							elseif($timetable->patients_pesel && !$timetable->payment) echo 'zarezerwowane';
							elseif($timetable->patients_pesel && $timetable->payment) echo 'zrealizowane';
						?>
					</td>
					<td>
						<a href="<?= URL::base() ?>index.php/admin/timetables/delete/<?= $timetable->id ?>"  onclick="return confirm('Na pewno chcesz usunąć?')" class="linkButton">usuń</a>
					</td>
				</tr>
			<? endforeach//*/ ?>
		</tbody>
	</table>
	
	
		
	
	<input type="submit" class="button" value="zapisz" />
<?= form::close() ?>

<script>
	//$(document).ready(function(){});
	function check_data(){
		$('.error').hide();
		$('.addTimetablesButton').show();
		var ok=true;
		if(!$('select[name=user_id]').val()){
			ok=false;
			$('.doctorError').show();
		}
		if(!$('input[name=date]').val()){
			ok=false;
			$('.dateError').show();
		}
		if(!$('input[name=time]').val()){
			ok=false;
			$('.timeError').show();
		}
		if(!$('input[name=period]').val()){
			ok=false;
			$('.periodError').show();
		}
		if(!$('input[name=amount]').val()){
			ok=false;
			$('.amountError').show();
		}
		if(!ok){
			alert('Popraw dane!');
			$('.addTimetablesButton').hide();
		}
		return ok;
	}
	
	function add_timetables(){
		if(!check_data()) return;
		const input_id='<input type="hidden" name="id[]" value="" />';
		const input_patients_pesel='<input type="hidden" name="patients_pesel[]" value="" />';
		const input_payment='<input type="hidden" name="payment[]" value="" />';
		const input_activation_code='<input type="hidden" name="activation_code[]" value="" />';
		
		var user=$('select[name=user_id]').val(); // .doctorError
		var date=$('input[name=date]').val(); // .dateError
		var time=$('input[name=time]').val(); // .timeError
		var period=$('input[name=period]').val(); // .periodError
		var amount=$('input[name=amount]').val(); // .amountError//*/
		var tmp=new Date(date+' '+time);
		
		var wzor='<tr><td>'+input_id+input_patients_pesel+input_payment+input_activation_code;
		wzor+='dn. <input type="date" name="vaccination_date_day[]" value=":date:" />';
		wzor+='o godz. <input type="time" name="vaccination_date_time[]" value=":time:" /></td>';
		wzor+='<td>wolne</td>';
		wzor+='<td><span onclick="if(confirm(\'Na pewno chcesz usunąć?\')) $(this).parent(\'td\').parent(\'tr\').remove()" class="linkButton">usuń</span></td></tr>';
		
		//console.log(wzor);
		for(var i=0; i<amount; i++){
			var tmp2=new Date(tmp.getTime()+(i*period*60*1000)); // minutes * seconds * miliseconds
			var tmp_month=tmp2.getMonth()+1;
			if(tmp_month<10) tmp_month='0'+tmp_month;
			var tmp_date=tmp2.getFullYear()+'-'+tmp_month+'-'+tmp2.getDate();
			var tmp_time=tmp2.getHours()+':'+(tmp2.getMinutes());
			$('.timetablesBox').append(wzor.replace(':date:', tmp_date).replace(':time:', tmp_time));
		}//*/
		$('.addTimetablesButton').hide();
	}
</script>