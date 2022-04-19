<?
	$time=strtotime($vaccination->vaccination_date);
?>
Zareserwowałeś szczepienie na dzień <?= date('Y-m-d', $time) ?> o godzinie <?= date('H:i:s', $time) ?> szczepionką <?= $vaccination->vaccine->name.' ('.$vaccination->vaccine->producer.')' ?>. 
Poniżej kod sprawdzający, który należy pokazać przed szczepieniem.
<br />
<?= $vaccination->activation_code ?>
