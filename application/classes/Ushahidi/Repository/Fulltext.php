<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Ushahidi Fulltext Repository
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Entity;
use Ushahidi\Core\Entity\Fulltext;

class Ushahidi_Repository_Fulltext extends Ushahidi_Repository
{
	// Ushahidi_Repository
	protected function getTable()
	{
		return 'posts_fulltext';
	}

	// Ushahidi_Repository
	public function getEntity(Array $data = null)
	{
		return new Fulltext($data);
	}

	// SearchRepository
	public function getSearchFields()
	{
		return ['post_id'];
	}

	public function upsert(Entity $entity)
	{
		$record = $entity->asArray();

		if ($this->exists($record['post_id'])) {
			$this->update($entity);
		} else {
			$this->create($entity);
		}
	}

	// CreateRepository
	public function create(Entity $entity)
	{
		return $this->executeInsert($this->removeNullValues($entity->asArray()));
	}

	// UpdateRepository
	public function update(Entity $entity)
	{
		return $this->executeUpdate(['post_id' => $entity->post_id], $entity->getChanged());
	}

	/**
	 * Check if an entity with the given id exists
	 * @param  int $id
	 * @return bool
	 */
	public function exists($id)
	{
		return (bool) $this->selectCount([
			$this->getTable().'.post_id' => $id
		]);
	}
}