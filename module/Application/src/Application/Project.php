<?php

namespace Application;

class Project
{
    // TODO fix this horrible Array-Oriented Programming aberration
    protected $data;

    /**
     * @see Helpwanted.json
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function exchangeArray(array $data)
    {
        $this->data = $data;
    }
}
