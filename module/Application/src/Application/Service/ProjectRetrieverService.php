<?php

namespace Application\Service;

use Elasticsearch\Client;
use Zend\Http\Client\Adapter\AdapterInterface;

class ProjectRetrieverService
{
    protected $client;
    protected $params = [];
    protected $skills = [];
    protected $technologies = [];
    protected $filters = [];

    public function __construct($params = []) {
        $this->client = new Client();
        $this->params = array_merge($this->params, $params);
    }

    /**
     * @param string $project
     * @param string $owner
     * @param string $service
     * @return array
     */
    public function getByIdentifier($project,$owner="",$service=""){
        $params['body']['query']['bool']['should']['match'] ['testField'] = 'abc';

        $params['body']['query']['bool']['must'] = [
            array('match' => array('testField' => 'abc')),
            array('match' => array('anotherTestField' => 'xyz')),
        ];


        return $this->client->search($params);
    }

    /**
     * @param array $skills
     */
    public function addSkillFilter($skills = []){
        $this->skills = array_merge($this->skills,$skills);
    }

    /**
     * @param array $technologies
     */
    public function addTechnologyFilter($technologies = []){
        $this->technologies = array_merge($this->technologies,$technologies);
    }

    /**
     * @return array
     */
    public function getByFilter(){

        $this->params['body']['query']['bool']['must'] = $this->generateFilterQuery();

        return $this->client->search($this->params);
    }

    /**
     * @return array
     */
    private function generateFilterQuery(){
        $filters = [];

        if(count($this->skills)>0){
            foreach($this->skills AS $skill){
                $filters[] = ['match'=>['skill'=>$skill]];
            }
        }
        if(count($this->technologies)>0){
            foreach($this->technologies AS $technology){
                $filters[] = ['match'=>['technology'=>$technology]];
            }
        }
        return $filters;
    }

}