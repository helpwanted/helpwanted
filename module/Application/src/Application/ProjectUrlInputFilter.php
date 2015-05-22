<?php
class ProjectUrlInputFilter extends \Zend\InputFilter\InputFilter
{
    public function __construct() 
    {
        $this->add([
            'required' => true,
            'name' => 'url',
            'filters' => [
              ['name' => 'StringTrim'],  
            ],
            'validators' => [
                new ProjectUrlInptuFilter(),
            ]
        ]);
    }
}
