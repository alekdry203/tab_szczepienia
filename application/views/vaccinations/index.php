<?= form::open(null, array('method'=>'get')) ?>
	<div class="searchBox">
		<div class="searchFormEl">
			<label>Dzień:</label>
			<input type="date" name="vaccination_date" min="<?//= date('Y-m-d') ?>" value="<?= @$_GET['vaccination_date'] ? : date('Y-m-d') ?>" required onchange="$('form').submit();" />
		</div>
		
		<div class="searchFormEl">
			<label>Szczepionka:</label>
			<select name="vaccine" required onchange="$('form').submit();">
				<? foreach($vaccines as $vaccine): ?>
					<?
						$get_id=$vaccine->name.';'.$vaccine->producer;
					?>
					<option value="<?= $get_id ?>" <?= $get_id==@$_GET['vaccine'] ? 'selected' : null ?>><?= $vaccine->name.' ('.$vaccine->producer.')' ?></option>
				<? endforeach ?>
			</select>
		</div>
		<? if(@$_GET['fail']): ?>
			<span class="error">Coś poszło nie tak przy rezerwacji szczepienia, spróbuj ponownie.</span>
		<? endif ?>
	</div>
<?= form::close() ?>

<div class="vaccinesIntro">
	Godziny szczepień:
</div>

<div class="vaccinesBox">
	<? foreach($timetables as $timetable): ?>
		<div class="vaccineBox">
			<label><?= $timetable->vaccination_date ?></label>
			<? if(@$_GET['vaccine']): ?>
				<div class="vaccineButtonBox">
					<a href="<?= URL::base().'index.php/vaccinations/sign_up/'.$timetable->id.'?vaccine='.$_GET['vaccine'] ?>">
						<span class="vaccineButton">zapisz się na szczepienie</span>
					</a>
				</div>
			<? endif ?>
		</div>
		<?//*/?><?//*/?>
	<? endforeach ?>
</div>