<?php

namespace Application\Service;

use Application\Project;
use Application\ProjectRetrievalException;
use Application\ProjectValidationException;
use Zend\Http\Client;
use Zend\Validator\ValidatorInterface;

class ProjectRetrievalService
{
    protected $http;
    protected $validator;

    /**
     * @param array $options for Zend Http Client
     * @param ValidatorInterface $validator
     */
    public function __construct($options = null, ValidatorInterface $validator)
    {
        $this->http = new Client(null, $options);
        $this->validator = $validator;
    }

    /**
     * @param $url
     * @return \Application\Project
     * @throws \Zend\Http\Client\Exception\RuntimeException
     * @throws ProjectRetrievalException
     * @throws ProjectValidationException
     */
    public function getByUrl($url)
    {
        $response = $this->http->setUri($url)->send();
        if (!$response->isSuccess()) {
            throw new ProjectRetrievalException('Non-successful response code', $response->getStatusCode());
        }

        return $this->parseResponse($response->getBody());
    }

    /**
     * @param string $json_string
     * @return Project
     * @throws ProjectValidationException
     */
    protected function parseResponse($json_string) {
        $rawObject = json_decode($json_string, JSON_OBJECT_AS_ARRAY);
        if (!$rawObject) {
            throw new ProjectRetrievalException('Could not parse JSON', 1400);
        }

        if (!$this->validator->isValid($rawObject)) {
            throw new ProjectValidationException($this->validator->getMessages(), 2400);
        }

        $project = new Project();
        $project->exchangeArray($rawObject);

        return $project;
    }
}
