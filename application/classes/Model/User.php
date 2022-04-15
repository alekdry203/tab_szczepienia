<?php class Model_User extends ORM {
	//protected $_table_name='users'; //można ale nie trzeba korzystać z tego - koseven samo się domyśla po nazwie klasy jaka jest tabela (nazwa klasy to nazwa pojedynczego obiektu, tworzy z niej liczbę mnogą i takiej tabeli szuka)
	
	protected $_has_many=array( // relacja jeden / wiele do wielu - trzeba w kaażdym modelu definiować
			'timetables'=>array( // indeks pod jakim się odwołujemy do tej listy obiektów
						'model'=>'Timetable', // model w którym znajdują sie te obiekty
						//'through'=>'User', // jeżeli jest to relacja przez tabelę pośredniczącą to tu wpisać jej nazwę
						//'far_key'=>'user_id', // klucz obcy z drugiej tabeli (chyba)
						'foreign_key'=>'user_id', // klucz obcy z tej tabeli (chyba - możliwe że na odwrót z w/w)
					),
	);//*/
}