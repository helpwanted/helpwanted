<?php
/**
 * Created by PhpStorm.
 * User: qschmick
 * Date: 5/20/15
 * Time: 8:28 PM
 */
namespace Application\Service;

use Application\Project;

interface ProjectRetrieverServiceInterface
{
    /**
     * @param array $params
     */
    public function setParams(array $params = []);

    /**
     * @param Project $project
     * @return bool
     */
    public function registerProject(Project $project);

    /**
     * @param string $service
     * @param string $owner
     * @param string $project
     * @return ProjectRetrieverIterator
     */
    public function getByIdentifier($service = "", $owner = "", $project = "");

    /**
     * @param array $skills
     * @return ProjectRetrieverService
     */
    public function addSkillFilter($skills = []);

    /**
     * @param array $technologies
     * @return ProjectRetrieverService
     */
    public function addTechnologyFilter($technologies = []);

    /**
     * @return ProjectRetrieverIterator
     */
    public function getByFilter();
}