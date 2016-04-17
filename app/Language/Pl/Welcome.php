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
	'buttonCategory' => 'Zobacz Podkategorie',
	'buttonSubCategory' => 'Zobacz zestawy',

	'menuuczen' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/wyniki', 'val' => 'Wyniki'),
		array('link' => '/zestaw', 'val' => 'Twoje Zestawy')),
	'menuredaktor' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/wyniki', 'val' => 'Wyniki'),
		array('link' => '/zestaw', 'val' => 'Zestawy')),
	'menusuperredaktor' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/wyniki', 'val' => 'Wyniki'),
		array('link' => '/zestaw', 'val' => 'Zestawy')),
	'menuadmin' => array(
		array('link' => '/kategorie', 'val' => 'Kategorie'),
		array('link' => '/zestaw', 'val' => 'Zestawy'),
		array('link' => '/user/all', 'val' => 'Zarzadzaj uzytkownikami'),
		array('link' => '/uprawnienia', 'val' => 'Zarzadzaj uprawnieniami')),
	'nikt' => array(
		array('link' => '/', 'val' => 'Strona Główna'),
		array('link' => '/kategorie', 'val' => 'Kategorie'))


);
