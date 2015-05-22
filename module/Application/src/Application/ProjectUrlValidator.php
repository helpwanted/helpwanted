<?php


namespace Application;


use Zend\Validator\Exception;
use Zend\Validator\ValidatorInterface;

class ProjectUrlValidator implements ValidatorInterface {
    protected $errors = [];
    
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
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->errors['invalid-url'] = "Invalid URL";
        }
        
        if (strpos($value, '/..') !== false) {
            $this->errors['hax0r'] = "URL contains invalid characters";
        }
        
        if (!in_array(parse_url($value, PHP_URL_HOST), ['github.com', 'bitbucket.org', 'www.github.com', 'www.bitbucket.org'])) {
            $this->errors['invalid-host'] = "Invalid Git host. Only github.com and bitbucket.org are supported.";
        }
        
        if ($this->errors) {
            return false;
        }

        return true;
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
    public function getMessages()
    {
        return $this->errors;
    }
}
