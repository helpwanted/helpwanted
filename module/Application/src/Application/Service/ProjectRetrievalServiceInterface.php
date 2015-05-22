<?php

namespace Application\Service;

use Application\ProjectRetrievalException as RetrievalException;
use Application\ProjectValidationException as ValidationException;

interface ProjectRetrievalServiceInterface
{
    /**
     * @param string $url
     * @return \Application\Project
     * @throws \Zend\Http\Client\Exception\RuntimeException
     * @throws RetrievalException
     * @throws ValidationException
     */
    public function getByUrl($url);
}
