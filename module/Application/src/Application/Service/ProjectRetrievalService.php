<?php

namespace Application\Service;

use Application\Project;
use Application\ProjectRetrievalException as RetrievalException;
use Application\ProjectValidationException as ValidationException;
use Zend\Http\Client;
use Zend\Validator\ValidatorInterface;

class ProjectRetrievalService
{
    const JSON_PARSE_FAILURE = 1400;
    const SCHEMA_VALIDATION_FAILURE = 2400;
    const PARENT_VALIDATION_FAILURE = 3400;

    protected $http;
    protected $schemaValidator;

    /**
     * @param array $options for Zend Http Client
     * @param ValidatorInterface $validator
     */
    public function __construct($options = null, ValidatorInterface $validator)
    {
        $this->http = new Client(null, $options);
        $this->schemaValidator = $validator;
    }

    /**
     * @param $url
     * @return \Application\Project
     * @throws \Zend\Http\Client\Exception\RuntimeException
     * @throws RetrievalException
     * @throws ValidationException
     */
    public function getByUrl($url)
    {
        $response = $this->http->setUri($url)->send();
        if (!$response->isSuccess()) {
            throw new RetrievalException('Non-successful response code', $response->getStatusCode());
        }

        return $this->buildFromResponse($response->getBody(), $url);
    }

    /**
     * @param string $json_string
     * @param string $url needed for validation
     * @return Project
     * @throws RetrievalException
     * @throws ValidationException
     */
    protected function buildFromResponse($json_string, $url)
    {
        $rawArray = json_decode($json_string, JSON_OBJECT_AS_ARRAY);
        if (!$rawArray) {
            throw new RetrievalException('Could not parse JSON', static::JSON_PARSE_FAILURE);
        }

        if (!$this->schemaValidator->isValid($rawArray)) {
            throw new ValidationException($this->schemaValidator->getMessages(), static::SCHEMA_VALIDATION_FAILURE);
        }

        if (!$this->isUrlParent($rawArray['repository'], $url)) {
            throw new ValidationException(
                ['repository' => 'Retrieved file isn\'t in this repo'],
                static::PARENT_VALIDATION_FAILURE
            );
        }

        $project = new Project();
        $project->exchangeArray($rawArray);

        return $project;
    }

    /**
     * Validates that a child URL is in a subdirectory (e.g. within the base repository) of
     * the parent URL. Immediately rejects parent URLs with ..'s in them due to the potential
     * for repo hijacking.
     *
     * @param string $parent_url
     * @param string $child_url
     * @return bool
     */
    protected function isUrlParent($parent_url, $child_url)
    {
        return strpos($parent_url, '..') === false && strpos($child_url, $parent_url) === 0;
    }
}
