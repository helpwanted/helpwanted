<?php

namespace Application;

class ProjectValidationException extends ProjectRetrievalException
{
    const DEFAULT_MESSAGE = 'Could not validate project JSON; see getValidationMessages()';

    protected $validationMessages;

    public function __construct($messages = '', $code = 0, \Exception $previous = null) {
        parent::__construct(is_array($messages) ? static::DEFAULT_MESSAGE : $messages, $code, $previous);
        $this->validationMessages = is_array($messages) ? $messages : [$messages];
    }

    public function getValidationMessages() {
        return $this->validationMessages;
    }
}
