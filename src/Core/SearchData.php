<?php

/**
 * Ushahidi Platform Search Data
 *
 * Data transfer object for dynamic search parameters.
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core;

use Ushahidi\Core\Traits\FilterRecords;

class SearchData
{
	use FilterRecords;

	/**
	 * @var Array
	 */
	protected $sorting = [
		'v_orderby',
		'orderby',
		'order',
		'limit',
		'offset',
	];

	/**
	 * Stores the given filters for later access.
	 *
	 * @param  Array $filters
	 */
	public function __construct(Array $filters = null)
	{
		if ($filters) {
			$this->setFilters($filters);
		}
	}

	/**
	 * Access search filters as if they are object properties.
	 *
	 * @param  String $key
	 * @return Mixed
	 */
	public function __get($key)
	{
		return $this->getFilter($key);
	}

	/**
	 * Set search filters as if they are object properties.
	 *
	 * @param  String $key
	 * @param  Mixed  $value
	 * @return Mixed
	 */
	public function __set($key, $value)
	{
		return $this->setFilter($key, $value);
	}

	/**
	 * Check if search filter exists
	 *
	 * @param  String $key
	 * @return boolean
	 */
	public function __isset($key)
	{
		return $this->getFilter($key) !== null;
	}

	/**
	 * Change the filters used for sorting.
	 *
	 * @param  Array $sorting
	 * @return $this
	 */
	public function setSortingKeys(Array $sorting)
	{
		$this->sorting = $sorting;
		return $this;
	}

	/**
	 * Get an array of the sorting filters, with their values.
	 *
	 * @return Array [orderby, order, limit, offset]
	 */
	public function getSorting($force = false)
	{
		$sorting_filters = $this->getFilters($this->sorting, $force);

		if (!empty($sorting_filters['v_orderby']) && !empty($sorting_filters['orderby'])) {
			$sorting_filters['orderby'] = null;
		}

		return $sorting_filters;
	}
}
