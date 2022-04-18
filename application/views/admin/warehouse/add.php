<?= form::open(null, array('method'=>'post')) ?>
	<div class="formBox">
		<div class="formEl">
			<label>Numery partii:</label>
			<input type="text" name="serial_no[0]" value="" required />
			 - 
			<input type="text" name="serial_no[1]" value="" required />
			<span class="error serialNoError">Numer partii od nie może być większy niż numer partii do!</span>
			sprawdzić ajaxem czy można taki zakres dodać
		</div>
		<div class="formEl">
			<label>Nazwa:</label>
			<input type="text" name="name" value="" required />
		</div>
		<div class="formEl">
			<label>Producent:</label>
			<input type="text" name="producer" value="" required />
		</div>
		<div class="formEl">
			<label>Data ważności:</label>
			<input type="date" name="expiration_date" value="" required />
		</div>
		<input type="submit" class="button" value="zapisz" />
	</div>
<?= form::close() ?>

<script>
	$(document).ready(function(){
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
	});
</script>