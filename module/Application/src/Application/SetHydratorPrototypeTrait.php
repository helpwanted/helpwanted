<?php

namespace Application;

/**
 * Trait SetHydratorPrototypeTrait
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
trait SetHydratorPrototypeTrait
{
    /**
     * @var string
     */
    protected $prototypeClass = 'Account\Account';

    /**
     * Sets the name of the class that will be used for hydrating
     *
     * @param $class
     * @throws Exception
     */
    public function setPrototypeClass($class)
    {
        if (is_object($class)) {
            $this->prototypeClass = $class;
            return;
        }

        if (!class_exists($class)) {
            throw new Exception('Invalid class for prototype');
        }

        $this->prototypeClass = $class;
    }

    /**
     * @return mixed
     */
    public function getPrototype()
    {
        return is_object($this->prototypeClass) ? $this->prototypeClass : new $this->prototypeClass;
    }
}
