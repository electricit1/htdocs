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
Router::any('', 'App\Controllers\Welcome@index');
Router::post('err/(:num)', 'App\Controllers\Welcome@index');
Router::any('subpage', 'App\Controllers\Welcome@subPage');
Router::any('admin/(:any)(/(:any)(/(:any)(/(:any))))', 'App\Controllers\Demo@test');
Router::any('test/(:any)', 'App\Controllers\test@wyswietl');
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
	Router::any('(:num)', 'App\Controllers\podkategorie@podkategorie');
	Router::any('(:num)/add', 'App\Controllers\podkategorie@podkategorieAdd');
	Router::any('(:num)/(:num)/edit', 'App\Controllers\podkategorie@podkategorieEdit'); // zrobic
});
//zestaw
Router::group('zestaw', function()
{
	Router::any('(:num)/(:num)', 'App\Controllers\zestaw@zestawy');
	Router::any('edit/(:num)', 'App\Controllers\zestaw@zestawEdit');
	Router::any('add', 'App\Controllers\zestaw@zestawAdd');
	Router::any('all', 'App\Controllers\zestaw@zestawAll'); // zrobic
});

//uprawnienia
Router::group('uprawnienia', function()
{
	Router::any('all', 'App\Controllers\uprawnienia@uprawnienia');
	Router::any('edit/(:num)', 'App\Controllers\uprawnienia@uprawnieniaEdit');
	Router::any('add', 'App\Controllers\uprawnienia@uprawnieniaAdd');
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
