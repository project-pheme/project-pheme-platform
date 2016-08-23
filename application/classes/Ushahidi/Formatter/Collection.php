<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Ushahidi Collection Formatter
 *
 * Implements Kohana URL handling for paging parameters.
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

use Ushahidi\Core\Tool\Formatter\CollectionFormatter;
use Ushahidi\Core\SearchData;

class Ushahidi_Formatter_Collection extends CollectionFormatter
{
	// CollectionFormatter
	public function getPaging()
	{
		// Get paging parameters, ensuring all values are set
		$params = $this->search->getSorting(true);

		$prev_params = $next_params = $params;
		$next_params['offset'] = $params['offset'] + $params['limit'];
		$prev_params['offset'] = $params['offset'] - $params['limit'];
		$prev_params['offset'] = $prev_params['offset'] > 0 ? $prev_params['offset'] : 0;

		$request = Request::current();

		$curr = URL::site($request->uri() . URL::query($params),      $request);
		$next = URL::site($request->uri() . URL::query($next_params), $request);
		$prev = URL::site($request->uri() . URL::query($prev_params), $request);

		$paging = [
			'limit'       => $params['limit'],
			'offset'      => $params['offset'],
			'curr'        => $curr,
			'next'        => $next,
			'prev'        => $prev,
			'total_count' => $this->total
		];

		if (!empty($params['order'])) $paging['order'] = $params['order'];
		if (!empty($params['orderby'])) $paging['orderby'] = $params['orderby'];
		if (!empty($params['v_orderby'])) $paging['v_orderby'] = $params['v_orderby'];

		return $paging;
	}
}