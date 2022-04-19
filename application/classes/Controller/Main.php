<?php

class Controller_Main extends Controller_Template {
	
	public $template='template/main';
	
	public function before(){
		//włączyć short tagi dla php (poniżej instrukcja)
		// https://stackoverflow.com/questions/5603898/php-file-with-tags-in-xampp
		
		parent::before(); // dzięki temu generuje widok z klasy po której dziedziczy
		//session_start(); // rozpoczyna sesję, jak w jakimś controllerze nie ma tego to $_SESSION będzie rzucać błędy (wystarczy że w klasie bazowej jest)
		//$x=ORM::factory('Vaccinationwarehouse'); // tak się łaczy z tabelą przez ORM - poczytajcie na koseven orm jak to działa albo poczekajcie jak zrobie jeden controller
		//print_r($x);die(); // podgląd zmiennej - jak tablica pokazuje zawartość tablicy z indeksami, jak obiekt to obiekt z polaim i właściwościami, jak zmienna to jej wartość, polecam w opór do debugowania
		//$id=$this->request->param("id"); // pobieranie przekazanego parametru
		//View::factory("welcome/index"); // generowanie widoku
		//$this->template->content=View::factory("welcome/index"); // wstawianie wygenerowanego widoku do szablonu
		//nazwa klasy controllera musi być taka sama jak pliku
		//metody w klasie jeśli mają być odpalane z paska przeglądarki muszą być public + przed nazwą musi być dodane action_ + musi być zwracany wygenerowany widok inaczej rzuca błąd (chyba że dacie $this->auto_render=false; - ale tego nie bdzmy używac)
		session_start();
	}

}