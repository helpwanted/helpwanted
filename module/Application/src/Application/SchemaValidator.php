<?php


namespace Application;


use Zend\Validator\Exception;
use Zend\Validator\ValidatorInterface;

class SchemaValidator implements ValidatorInterface {
    protected $validator;
    protected $schema;
    protected $errors = [];

    public function __construct(\JsonSchema\Validator $validator, $schema) {
        $this->validator = $validator;
        $this->schema = $schema;
    }

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
        return $this->errors;
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return bool
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($value) {
        $this->validator->check($value, $this->schema);

        if (!$this->validator->isValid()) {
            $this->errors = $this->validator->getErrors();
            return false;
        }

        $this->errors = [];

        return true;
    }
}
