<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Pheme Data Interface Theme Controller
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    pheme-data-interface\Application\Controllers
 * @copyright  2016 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

class Controller_Api_Pheme_Event extends Ushahidi_Rest {

	protected $pheme_config;

	public function before() {
		parent::before();
		$this->pheme_config = \Kohana::$config->load('pheme');

	}

	protected $_action_map = array
	(
		Http_Request::POST    => 'post',
	);

	protected function _scope()
	{
		return 'posts';		# TODO: consider a specific scope for Pheme
	}

	public function action_post_index_collection()
	{
		$req_uri = $this->pheme_config['data-interface']['url'] . '/api/event';

		$response = \Httpful\Request::post($req_uri)
			->sendsJson()
			->body($this->_payload())
			->send();
		$this->_response_payload = [
			'success' => TRUE,
			'message' => "got the response"
		];

		$this->_prepare_response();
	}

}
