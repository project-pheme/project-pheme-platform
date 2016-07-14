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
// Route::set('pheme-themes', $apiBase . 'pheme/themes/<id>',
// 	array(
// 		'id' => '[1-9a-zA-Z_\-]+'
// 	))
// 	->defaults(array(
// 		'action'     => 'index',
// 		'controller' => 'Theme',
// 		'directory'  => 'Api/Pheme'
// 	));


/**
 * Event API SubRoute
 */
Route::set('pheme-events', $apiBase . 'pheme/events')
	->defaults(array(
		'action'	=> 'index',
		'controller'=> 'Event',
		'directory' => 'Api/Pheme'
	));
