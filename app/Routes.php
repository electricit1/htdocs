<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 3.0
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/** Get the Router instance. */
$router = Router::getInstance();

/** Define static routes. */

// Default Routing
Router::any('', 'App\Controllers\kategorie@kategorie');
Router::post('err/(:num)', 'App\Controllers\Welcome@index');
//Router::any('subpage', 'App\Controllers\Welcome@subPage');
//Router::any('admin/(:any)(/(:any)(/(:any)(/(:any))))', 'App\Controllers\Demo@test');
//Router::any('test/(:any)', 'App\Controllers\test@wyswietl');
Router::any('login', 'App\Controllers\Auth@login');
Router::any('logout', 'App\Controllers\Auth@logout');

//kategorie
Router::group('kategorie', function()
{
	Router::any('all', 'App\Controllers\kategorie@kategorie');
	Router::any('add', 'App\Controllers\kategorie@kategorieAdd');
	Router::any('(:num)/edit', 'App\Controllers\kategorie@kategorieEdit'); // zrobic
});
//podkategorie
Router::group('podkategorie', function()
{
	Router::any('(:num)', 'App\Controllers\podkategorie@podkategorie'); //id kategorii
	Router::any('(:num)/add', 'App\Controllers\podkategorie@podkategorieAdd'); // id kategorii
	Router::any('(:num)/edit', 'App\Controllers\podkategorie@podkategorieEdit'); // id podkategorii zrobic

	// img // tutaj cos poprawic zeby to mialo rece i nogi i jakies zabezpieczenia przy wywoloywaniu
	// zrobic zliczanie slow, w selekcie zrobic nazwa, pod tym obrazek i oddzielone linia
	// zmienic w uprawnieniach ze do wyboru jest superredaktor albo redaktor
});
//zestaw
Router::group('zestaw', function()
{
	Router::any('all', 'App\Controllers\zestaw@zestawAll'); 
	Router::any('(:num)', 'App\Controllers\zestaw@zestawy'); // id podkategorii
	Router::any('add', 'App\Controllers\zestaw@zestawAdd');
	Router::any('(:num)/edit', 'App\Controllers\zestaw@zestawEdit'); // id zestau
});

//uprawnienia
Router::group('uprawnienia', function()
{
	Router::any('all', 'App\Controllers\uprawnienia@uprawnienia');
	Router::any('(:num)/edit', 'App\Controllers\uprawnienia@uprawnieniaEdit'); //id uprawnienia
	Router::any('add', 'App\Controllers\uprawnienia@uprawnieniaAdd');
});

Router::group('wiedza', function()
{
	Router::any('nauka/(:num)', 'App\Controllers\wiedza@wiedzaNaukaWyborJezyka'); //id zestawu
	Router::any('nauka/(:num)/(:num)/(:num)', 'App\Controllers\wiedza@wiedzaNauka'); //id zestawu, // tryb {0 - jedna ,1 - wiele}, // wybor jezyka {0,1} 
	Router::any('spr/(:num)', 'App\Controllers\wiedza@wiedzaSprWyborJezyka'); //id zestawu
	Router::any('spr/(:num)/(:num)', 'App\Controllers\wiedza@wiedzaSpr'); //id zestawu, // wybor jezyka {0,1}
});

Router::group('wynik', function()
{
	Router::any('/all', 'App\Controllers\wynik@wynik'); // admin bedzie mial wglad do wszystkich
	Router::any('/graf', 'App\Controllers\wynik@wynikGraf'); // no tutaj juz nie stety nie : C #sublime rlz xd
});

/** End default routes */
Router::group('user', function()
{
	Router::any('all', 'App\Controllers\User@index');
	Router::any('add', 'App\Controllers\User@add');
	Router::any('edit/(:num)', 'App\Controllers\User@edit');
	Router::any('delete/(:num)', 'App\Controllers\User@delete');
	Router::any('nick', 'App\Controllers\User@nick');
});
/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');
/** End Module routes. */

/** If no route found. */
Router::error('Core\Error@index');

/** Execute matched routes. */
$router->dispatch();
