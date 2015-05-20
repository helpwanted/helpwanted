<?php
/**
 * Sales and Orders Ads (http://salesandordersads.com/)
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 *
 * @link      https://github.com/SalesAndOrders/Admin for the canonical source repository
 * @copyright Copyright (c) 2013-2015 New Dynamx Inc. (http://www.salesandorders.com)
 * @license   See LICENSE.txt
 */

namespace ApplicationTest;

use \PHPUnit_Framework_TestCase as TestCase;
use Application\Project;

/**
 * Test ProjectTest
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class ProjectTest extends TestCase
{
    public function testItShouldCopyAndExchangeArray()
    {
        $project = new Project();
        $project->exchangeArray([]);

        $newProject = new Project();
        $newProject->exchangeArray($project->getArrayCopy());

        $this->assertEquals($project, $newProject);
    }
}
