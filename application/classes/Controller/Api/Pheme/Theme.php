<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Pheme Data Interface Theme Controller
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    pheme-data-interface\Application\Controllers
 * @copyright  2016 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

class Controller_Api_Pheme_Theme extends Ushahidi_Rest {

	protected $pheme_config;

	public function before() {
		parent::before();
		$this->pheme_config = \Kohana::$config->load('pheme');
	}

	protected $_action_map = array
	(
		Http_Request::GET     => 'get',
	);

	protected function _scope()
	{
		return 'posts';		# TODO: consider a specific scope for Pheme
	}

	/**
	 * Retrieve A Theme
	 *
	 * GET /api/v3/pheme/themes/:id
	 *
	 * @return void
	 */
	public function action_get_index()
	{
		$the_id = $this->request->param('id');

		$req_uri = $this->pheme_config['data-interface']['url'] . '/api/stories/' . $the_id;

		$response = \Httpful\Request::get($req_uri)
			->expectsJson()
			->send();

		if ($response->body->status == "success") {
			$this->_response_payload = $response->body->data;
		/* TODO: I bet there's more semantic error reporting than this */
		} else if ($response->body->status == "fail") {
			$this->_response_payload = [
				'success' => FALSE,
				'message' => $response->body->data
			];
		} else if ($response->body->status == "error") {
			$this->_response_payload = [
				'success' => FALSE,
				'message' => $response->body->message
			];
		}

		$this->_prepare_response();
	}

}
