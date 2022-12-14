<ol>
	<li>
		Najwięcej dzieje się w folderze application
		<ol>
			<li>classes/controller - do tego się łączymy przez adres przeglądarki (ładuje się tam odpowiednie obiekty z bazy - przez modele - i wsadza do generowanych widoków)</li>
			<li>classes/models - pliki ORM tak właściwie, jak jest jakas tabela w bazie na której pracujemy to musi mieć swój plik (podejrzyjcie sobie User.php - wyjaśnienie co i jak)</li>
			<li>w samym folderze classes można dodawać jakieś klasy pomocnicze które można wykorzystać do złożonych operacji w controllerach/widokach/modelach (wszędzie)</li>
			<li>config - tu znajdują się pliki konfiguracyjne (u nas tylko database bo to prosta apka, musicie tu ustawić odpowiednie parametry serwera)</li>
			<li>views - foldery z widokami (html generowany przez php - jak na E14)</li>
			<li>bootsrap.php - plik z ustawieniami ścieżek / maskowania linków (można zrobić żeby zamiast welcome/index działał link strona_glowna) + można tu ustawić ile parametrów dana metoda może otrzymać i pod jakimi indexami je późiej pobrać</li>
		</ol>
	</li>
	<li>
		w folderze public z reguły w folderze media daje się css i js
	</li>
	<li>
		można w public dodać folder user_files który by zawierał załączniki od użytkowników albo jakieś generowane przez stronę pliki (np lista wygenerowanych pdf'ów)
	</li>
	<li>
		w folderze głównym apki jest plik tab_szczepienia.sql z naszą bazą danych - otwórzcie sobie heidisql, kwerenda, tam przeciągnijcie ten plik i kliknijcie wykonaj (powinno działać elegancko)
	</li>
	<li>do wysyłania maili użyjemy funkcji mail() - poczytać w manual php (musi być włączony serwer mailingowy i opcja sendmail - phpinfo() poszukać)</li>
	<li>do generowania pdf użyjemy libki TCPDF - wygooglować tcpdf php przykłady (libke dodam, tym sie nie martwić)</li>
	<li>w controllerze Main.php są podstawowe informacje</li>
</ol>

<div class="loginBox">
	<label class="loginBoxTitle">Test mailingu</label>
	<?= form::open('welcome/mail_test', array('method'=>'post')) ?>
		<div class="loginFormEl">
			<label>email:</label>
			<input type="text" name="email" required="" />
		</div>
		<div class="loginFormEl">
			<label>temat:</label>
			<input type="text" name="subject" required="" />
		</div>
		<div class="loginFormEl">
			<label>treść:</label>
			<textarea name="body"></textarea>
		</div>
		<div class="loginFormEl">
			<input type="submit" class="button" value="wyślij" />
		</div>
	<?= form::close() ?>
</div>

<a href="<?= URL::base().'index.php/welcome/tcpdf_test' ?>">
	<span class="vaccineButton">test tcpdf</span>
</a>