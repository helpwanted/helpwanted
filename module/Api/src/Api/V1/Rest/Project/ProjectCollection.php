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

use Application\Service\ProjectRetrieverIterator;

/**
 * ProjectCollection
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class ProjectCollection implements \Iterator
{
    /**
     * @var ProjectRetrieverIterator
     */
    private $iterator;

    public function __construct(ProjectRetrieverIterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @return ProjectEntity
     */
    public function current()
    {
        $project = $this->iterator->current();
        $entity  = new ProjectEntity();
        $entity->exchangeArray($project->getArrayCopy());

        return $entity;
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function valid()
    {
        return $this->iterator->valid();
    }

    public function key()
    {
        return $this->iterator->key();
    }

    public function rewind()
    {
        $this->iterator->rewind();
    }
}
