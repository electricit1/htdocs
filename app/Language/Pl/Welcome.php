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
	'buttonCategory' => 'Podkategorie',
	'buttonSubCategory' => 'Zestawy',

	'menuuczen' => array(
		array('link' => '/kategorie/all', 'val' => 'Kategorie'),
		array('link' => '/wynik/all', 'val' => 'Wyniki'),
		array('link' => '/wynik/graf', 'val' => 'Wyniki graficznie'),
		array('link' => '/zestaw/all', 'val' => 'Zestawy')),
	'menuredaktor' => array(
		array('link' => '/kategorie/all', 'val' => 'Kategorie'),
		array('link' => '/wynik/all', 'val' => 'Wyniki'),
		array('link' => '/wynik/graf', 'val' => 'Wyniki graficznie'),
		array('link' => '/zestaw/all', 'val' => 'Zestawy')),
	'menusuperredaktor' => array(
		array('link' => '/kategorie/all', 'val' => 'Kategorie'),
		array('link' => '/wynik/all', 'val' => 'Wyniki'),
		array('link' => '/wynik/graf', 'val' => 'Wyniki graficznie'),
		array('link' => '/zestaw/all', 'val' => 'Zestawy')),
	'menuadmin' => array(
		array('link' => '/kategorie/all', 'val' => 'Kategorie'),
		array('link' => '/zestaw/all', 'val' => 'Zestawy'),
		array('link' => '/user/all', 'val' => 'Zarzadzaj uzytkownikami'),
		array('link' => '/uprawnienia/all', 'val' => 'Zarzadzaj uprawnieniami'),
		array('link' => '/wynik/all', 'val' => 'Wyniki'),
		array('link' => '/wynik/graf', 'val' => 'Wyniki graficznie')),
	'nikt' => array(
		array('link' => '/kategorie/all', 'val' => 'Kategorie'))
);
