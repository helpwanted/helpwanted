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

namespace Application\Service;

use Application\Project;
use Zend\Stdlib\Hydrator\ArraySerializable;

/**
 * ProjectRetrieverIterator
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class ProjectRetrieverIterator implements \Iterator
{
    /**
     * @var array
     */
    public $data;

    public function __construct(array $data)
    {
        $this->data      = $data;
        $this->hydrator  = new ArraySerializable();
    }

    public function valid()
    {
        return current($this->data) !== false;
    }

    public function current()
    {
        $result = current($this->data);
        return $this->hydrator->hydrate($result, new Project());
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }
}
