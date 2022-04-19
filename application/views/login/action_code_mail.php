<? if(@$_POST['registration']): ?>
	Zostałeś zarejestrowany w aplikacji szczepień.
	<br />
<? endif ?>
Kod weryfikujący potrzebny do zalogowania (przy każdej próbie logowania generowany jest inny kod).
<br />
<?= $patient->action_code ?>
