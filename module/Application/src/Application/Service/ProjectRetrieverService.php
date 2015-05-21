<?php

namespace Application\Service;

use Application\Project;
use Elasticsearch\Client;

class ProjectRetrieverService implements ProjectRetrieverServiceInterface
{
    protected $client;
    protected $params = ['index'=>'my_index','type'=>'my_type'];
    protected $skills = [];
    protected $technologies = [];
    protected $filters = [];

    /**
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params  = []){
        $this->params = array_merge($this->params, $params);
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function registerProject(Project $project){

        return true;
    }

    /**
     * @param string $service
     * @param string $owner
     * @param string $project
     * @return ProjectRetrieverIterator
     */
    public function getByIdentifier($service="",$owner="",$project=""){


        /*
         * "match" : {
        "message" : {
            "query" : "this is a test",
            "type" : "phrase_prefix"
        }
    }

         */

        ['match'=>['service'=>['query'=>$service]]];

        $filters = array_values(array_filter([
            'service'=>['match'=>['service'=>strtolower($service)]],
            'owner'=>['match'=>['owner'=>strtolower($owner)]],
            'project'=>['match'=>['project'=>strtolower($project)]]
        ],function($value){
            $test = $value['match'];
            reset($test);
            return current($test) !== '';
        }));



        $params['body']['query']['match_phrase_prefix']['match'] = 'abc';

        $params['body']['query']['bool']['must'] = [
            array('match' => array('testField' => 'abc')),
            array('match' => array('anotherTestField' => 'xyz')),
        ];

        $results = $this->client->search($this->params);
        return new ProjectRetrieverIterator($results);
    }

    /**
     * @param array $skills
     * @return ProjectRetrieverService
     */
    public function addSkillFilter($skills = []){
        $this->skills = array_merge($this->skills,$skills);
        return $this;
    }

    /**
     * @param array $technologies
     * @return ProjectRetrieverService
     */
    public function addTechnologyFilter($technologies = []){
        $this->technologies = array_merge($this->technologies,$technologies);
        return $this;
    }

    /**
     * @return ProjectRetrieverIterator
     */
    public function getByFilter(){

        $this->params['body']['query']['bool']['must'] = $this->generateFilterQuery();

        $results = $this->client->search($this->params);
        return new ProjectRetrieverIterator($results);
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