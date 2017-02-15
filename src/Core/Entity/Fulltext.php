<?php

/**
 * Ushahidi Fulltext object
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Entity;

use Ushahidi\Core\StaticEntity;

class Fulltext extends StaticEntity
{
	protected $post_id;
	protected $fulltext;

	// StatefulData
	protected function getDerived()
	{
		return [
			'slug' => 'fulltext',
		];
	}

	// DataTransformer
	protected function getDefinition()
	{
		return [
			'post_id'     => 'int',
			'fulltext'    => 'string'
		];
	}

	// Entity
	public function getResource()
	{
		return 'fulltexts';
	}
}
