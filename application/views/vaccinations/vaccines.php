<div class="vaccinesIntro">
	Dostępne szczepionki:
</div>
<div class="vaccinesBox">
	<? foreach($vaccines as $vaccine): ?>
		<div class="vaccineBox">
			<label><?= $vaccine->name ?></label>
			(producent <?= $vaccine->producer ?>)
			<div class="vaccineButtonBox">
				<a href="<?= URL::base().'index.php/vaccinations/index?vaccine='.$vaccine->name.';'.$vaccine->producer ?>">
					<span class="vaccineButton">zapisz się na szczepienie</span>
				</a>
			</div>
		</div>
		<?//*/?><div class="vaccineBox">
			<label><?= $vaccine->name ?></label>
			(producent <?= $vaccine->producer ?>)
			<div class="vaccineButtonBox">
				<a href="<?= URL::base().'index.php/vaccinations/index?vaccine='.$vaccine->name.';'.$vaccine->producer ?>">
					<span class="vaccineButton">zapisz się na szczepienie</span>
				</a>
			</div>
		</div><?//*/?>
	<? endforeach ?>
</div>