<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Pheme fulltext controller
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    pheme-data-interface\Application\Controllers
 * @copyright  2016 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Entity\Fulltext;

class Controller_Api_Pheme_Fulltext extends Ushahidi_Rest {

	protected $_action_map = array
	(
		Http_Request::PUT     => 'put',
		Http_Request::OPTIONS => 'options',
	);

	protected function _scope()
	{
		return 'posts';		# TODO: consider a specific scope for Pheme
	}

	# Set the fulltext content for a given post id
	# Invoke with JSON payload: {
	#    "fulltext": "lorem ipsum dolor sit amet ..."
    # }
	public function action_put_index()
	{
		$_fulltext_repo = service('factory.repository')->get('fulltexts');
		$post_id = $this->request->param('id');
		$fulltext = $this->_payload()['fulltext'];
		$entity = $_fulltext_repo->getEntity()->setState([ "post_id" => $post_id, "fulltext" => $fulltext ]);

		$_fulltext_repo->upsert($entity);

		$this->_response_payload = [
			'success' => TRUE
		];
		$this->_prepare_response();
	}

}
