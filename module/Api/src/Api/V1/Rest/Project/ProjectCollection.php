<?php
/**
 * Sales and Orders Ads (http://salesandordersads.com/)
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 *
 * @link      https://github.com/SalesAndOrders/Admin for the canonical source repository
 * @copyright Copyright (c) 2013-2015 New Dynamx Inc. (http://www.salesandorders.com)
 * @license   See LICENSE.txt
 */

namespace Api\V1\Rest\Project;

use Zend\Paginator\Paginator;

/**
 * ProjectCollection
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class ProjectCollection extends Paginator
{
    public function getCurrentItems()
    {
        $items = parent::getCurrentItems();
        return $items;
    }
}
