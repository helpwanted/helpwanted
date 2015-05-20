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

use Application\Service\SchemaRetrievalService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

/**
 * ProjectResource
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class ProjectResource extends AbstractResourceListener
{
    /**
     * @var SchemaRetrievalService
     */
    protected $schemaRetrievalService;

    public function __construct(SchemaRetrievalService $schemaRetrievalService)
    {
        $this->schemaRetrievalService = $schemaRetrievalService;
    }

    public function create($data)
    {
        try {
            $url     = $this->getInputFilter()->getValue('url');
            $project = $this->schemaRetrievalService->getByUrl($url);
        } catch (\Exception $schemaException) {
            return new ApiProblem(422, 'Could not load the url');
        }

        $entity = new ProjectEntity();
        $entity->exchangeArray($entity->getArrayCopy());
        return $entity;
    }

    public function fetchAll(array $params)
    {
        return [new ProjectEntity()];
    }

    public function fetch($projectId)
    {
        return new ProjectEntity();
    }


    public function update($projectId, $data)
    {

    }

    public function delete($projectId)
    {

    }
}
