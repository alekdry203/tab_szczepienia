<?
	$php_css_class="style='border: 1px solid;'";
	$patient_attr=array(
						'pesel'=>'PESEL',
						'name'=>'Imię',
						'surname'=>'Nazwisko',
						'city'=>'Miejscowość',
						'street'=>'Ulica',
						'local_no'=>'Numer lokalu',
						'email'=>'Adres e-mail',
					);
?>
<h1 style="text-align: center">Dokument potwierdzający odbycie szczepienia</h1>

<table style='/*width: 100%;border-collapse: collapse;border: 1px solid;*/'>
		<tr <?//= $php_css_class ?>>
			<th <?//= $php_css_class ?> colspan="2"  style="text-align: center">Pacjent</th>
		</tr>
		<? foreach($patient_attr as $key=>$label): ?>
			<tr <?//= $php_css_class ?>>
				<td <?//= $php_css_class ?>><?= $label ?></td>
				<td <?//= $php_css_class ?>><?= $patient->$key ?></td>
			</tr>
		<? endforeach ?>
		<tr <?//= $php_css_class ?>>
			<th <?//= $php_css_class ?> colspan="2"  style="text-align: center">Szczepienie</th>
		</tr>
		<tr <?//= $php_css_class ?>>
			<td <?//= $php_css_class ?>>Data szczepienia</td>
			<td <?//= $php_css_class ?>><?= $vaccination->vaccination_date ?></td>
		</tr>
		<tr <?//= $php_css_class ?>>
			<td <?//= $php_css_class ?>>Producent szczepionki</td>
			<td <?//= $php_css_class ?>><?= $vaccination->vaccine->producer ?></td>
		</tr>
		<tr <?//= $php_css_class ?>>
			<td <?//= $php_css_class ?>>Nazwa szczepionki</td>
			<td <?//= $php_css_class ?>><?= $vaccination->vaccine->name ?></td>
		</tr>
		<tr <?//= $php_css_class ?>>
			<td <?//= $php_css_class ?>>Numer partii szczepionki</td>
			<td <?//= $php_css_class ?>><?= $vaccination->vaccine->serial_no ?></td>
		</tr>
		<tr <?//= $php_css_class ?>>
			<td <?//= $php_css_class ?>>Zaszczepił/a</td>
			<td <?//= $php_css_class ?>><?= $vaccination->user->name[0].'. '.$vaccination->user->surname ?></td>
		</tr>
</table>