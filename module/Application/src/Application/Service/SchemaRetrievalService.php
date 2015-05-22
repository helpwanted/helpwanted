<?php

namespace Application\Service;

use Zend\Http\Client\Adapter\AdapterInterface;

class SchemaRetrievalService
{
    protected $http;

    /**
     * @param AdapterInterface $http
     */
    public function __construct(AdapterInterface $http) {
        $this->http = $http;
    }

    /**
     * @param $url
     * @return \Application\Project
     */
    public function getByUrl($url) {
        // will do stuff here
    }
}