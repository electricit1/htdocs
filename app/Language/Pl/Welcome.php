<?php
/**
 * Sample language
 */
return array(

	// Welcome method
	'welcomeText' => 'Witaj',
	'welcomeMessage' => '
		Cześć, witaj z kontrolera welcome! <br/>
		Tą treść możesz zmienić w pliku <code>app/views/welcome/welcome.php</code>
	',

	// Subpage method
	'subpageText' => 'Podstrona',
	'subpageMessage' => '
		Cześć, witaj z kontrolera welcome i metody subpage! <br/>
		Tą treść możesz zmienić w pliku <code>app/views/welcome/subpage.php</code>
	',

	// Buttons
	'openSubpage' => 'Otwórz podstronę',
	'backHome' => 'Strona główna',

	'menuuczen' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/wyniki', 'val' => 'Sprawdz wyniki'),
		array('link' => '/wynikigraficzne', 'val' => 'Sprawdz wyniki graficznie'),
		array('link' => '/tworzprywatne', 'val' => 'Prywatne zestawy')),
	'menuredaktor' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/wyniki', 'val' => 'Sprawdz wyniki'),
		array('link' => '/wynikigraficzne', 'val' => 'Sprawdz wyniki graficznie'),
		array('link' => '/tworzprywatne', 'val' => 'Prywatne zestawy'),
		array('link' => '/dodajzestawy', 'val' => 'Dodaj zestaw do podkategorii'),
		array('link' => '/edytujzestaw', 'val' => 'Edytuj Zestaw')),
	'menusuperredaktor' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/wyniki', 'val' => 'Sprawdz wyniki'),
		array('link' => '/wynikigraficzne', 'val' => 'Sprawdz wyniki graficznie'),
		array('link' => '/tworzprywatne', 'val' => 'Prywatne zestawy'),
		array('link' => '/edytujzestaw', 'val' => 'Edytuj wszystkie Zestawy')),
	'menuadmin' => array(
		array('link' => '/kategorie', 'val' => 'Edytuj kategorie i podkategorie'),
		array('link' => '/zestaw', 'val' => 'Dodaj zestaw'),
		array('link' => '/zestaw', 'val' => 'Edytuj zestaw'),
		array('link' => '/zarzadzanie', 'val' => 'Prawa uzytkownikow'),
		array('link' => '/zarzadzanie', 'val' => 'Zarzadzaj uzytkownikami')),
	'nikt' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'))


);
