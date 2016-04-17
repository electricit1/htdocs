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


Router::any('kategorie', 'App\Controllers\kategorie@kategorie');
Router::any('kategorie/(:num)', 'App\Controllers\kategorie@podkategorie');
Router::any('kategorie/(:num)/(:num)', 'App\Controllers\kategorie@zestawy');
Router::any('kategorie/add', 'App\Controllers\kategorie@kategorieAdd');

Router::any('zestaw/edit/(:num)', 'App\Controllers\kategorie@zestawEdit');
Router::any('zestaw/add', 'App\Controllers\kategorie@zestawAdd');

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
