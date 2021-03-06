<?php defined('SYSPATH') or die('No direct access allowed.');


/**
 * API version number
 *
 *  TODO: clear violation of DRY
 */
$apiVersion = '3';
$apiBase = 'api/v' . $apiVersion . '/';


/**
 * Theme API SubRoute
 */
Route::set('pheme-themes', $apiBase . 'pheme/themes/<id>',
	array(
		'id' => '[0-9]+'
	))
	->defaults(array(
		'action'     => 'index',
		'controller' => 'Theme',
		'directory'  => 'Api/Pheme'
	));

/**
 * Event API SubRoute
 */
Route::set('pheme-events', $apiBase . 'pheme/events')
	->defaults(array(
		'action'	=> 'index',
		'controller'=> 'Event',
		'directory' => 'Api/Pheme'
	));

/**
 * Live Search API SubRoute
 */
Route::set('pheme-searchlive', $apiBase . 'pheme/search/live')
	->defaults(array(
		'action'	=> 'index',
		'controller'=> 'Searchlive',
		'directory' => 'Api/Pheme'
	));

/**
 * Data channels API SubRoute
 */
Route::set('pheme-datachannels', $apiBase . 'pheme/datachannels(/<id>)',
	array(
		'id' => '[0-9a-fA-F]+'
	))
	->defaults(array(
		'action'	=> 'index',
		'controller'=> 'Datachannel',
		'directory' => 'Api/Pheme'
	));


/**
 * Theme Fulltext API SubRoute
 */
Route::set('pheme-themes-fulltext', $apiBase . 'pheme/themes/fulltext/<id>',
	array(
		'id' => '[0-9]+'
	))
	->defaults(array(
		'action'     => 'index',
		'controller' => 'Fulltext',
		'directory'  => 'Api/Pheme'
	));
