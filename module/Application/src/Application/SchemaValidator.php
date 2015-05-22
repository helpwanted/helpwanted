<?php


namespace Application;


use JsonSchema\Validator;
use Zend\Validator\Exception;
use Zend\Validator\ValidatorInterface;

class SchemaValidator extends Validator implements ValidatorInterface {

    /**
     * Returns an array of messages that explain why the most recent isValid()
     * call returned false. The array keys are validation failure message identifiers,
     * and the array values are the corresponding human-readable message strings.
     *
     * If isValid() was never called or if the most recent isValid() call
     * returned true, then this method returns an empty array.
     *
     * @return array
     */
    public function getMessages() {
        return [];
    }
}
