<?php


namespace Application;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use JsonSchema\Validator;

class SchemaValidatorFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $validator = $serviceLocator->get(Validator::class);

        $schema = json_decode(file_get_contents(APPLICATION_PATH.'/helpwanted.schema.json'));

        return new SchemaValidator($validator, $schema);
    }
}
