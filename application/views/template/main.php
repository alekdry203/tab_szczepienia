<?
	/*
	 * to jest główny szablon widoków - tu mają być podstawowe rzeczy które powtarzają się na każdej stronie np.:
	 * tagi html head body (do head dać metatagi odpowiednie + tytul strony + dołączyć pliki css i js, do body dać content)
	 * content - do tej zmiennej controllery wrzucają odpowiednie widoki
	 * 
	 * Nie trzeba w każdym pliku pisac za każdym razem całego gumwa + można duży widok podzielić na kilka mniejszych i je później ze sobą odpowiednio łaczyć
	 * przydatne jak jakaś funkcjonalność jest identyczna w kilku miejscach - zamiast pisać kilka razy to samo to pisze się raz i wstawiam tam widoczek
	 * */
?>
<?= $content ?>