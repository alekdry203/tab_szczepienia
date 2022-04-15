<ol>
	<li>
		Najwięcej dzieje się w folderze application
		<ol>
			<li>classes/controller - do tego się łączymy przez adres przeglądarki (ładuje się tam odpowiednie obiekty z bazy - przez modele - i wsadza do generowanych widoków, w main.php macie ciekawostki)</li>
			<li>classes/models - pliki ORM tak właściwie, jak jest jakas tabela w bazie na której pracujemy to musi mieć swój plik (1. wszystkie są już dodane i skonfigurowane, 2. podejrzyjcie sb User.php - wyjaśnienie co i jak)</li>
			<li>w samym folderze classes można dodawać jakieś klasy pomocnicze które można wykorzystać do złożonych operacji w controllerach</li>
			<li>config - tu znajdują się pliki konfiguracyjne (u nas tylko database bo to prosta apka, musicie tu ustawić odpowiednie parametry serwera)</li>
			<li>views - foldery z widokami (html generowany przez php - jak na E14)</li>
			<li>bootsrap.php - plik z ustawieniami ścieżek / maskowania linków (można zrobić żeby zamiast welcome/index działał link strona_glowna) + można tu ustawić ile parametrów dana metoda może otrzymać i pod jakimi indexami je późiej pobrać</li>
		</ol>
	</li>
	<li>
		w folderze public z reguły w folderze media daje się style i javascript
	</li>
	<li>
		można w public dodać folder user_files który by zawierał załączniki od użytkowników albo jakieś generowane przez strone
	</li>
	<li>
		w folderze głównym apki jest plik tab_szczepienia.sql z naszą bazą danych - otwórzcie sobie heidisql, kwerenda, tam przeciągnijcie ten plik i kliknijcie wykonaj (powinno działać elegancko)
	</li>
	<li>do wysyłania maili użyjemy funkcji mail() - poczytać w manual php (musi być włączony serwer mailingowy i opcja sendmail - phpinfo() poszukać)</li>
	<li>do generowania pdf użyjemy libki TCPDF - wygooglować tcpdf php przykłady (libke dodam, tym sie nie martwić)</li>
	<li>w controllerze Main są podstawowe informacje</li>
</ol>
