<?php

namespace Phing\Test\Helper;

use Phing\Test\AbstractBuildFileTest;

/**
 * @package phing.mappers
 */
class TaskdefForCopyTest extends AbstractBuildFileTest
{

    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/types/mapper.xml");
    }

    public function tearDown()
    {
        $this->executeTarget("cleanup");
    }

    public function test1()
    {
        $this->executeTarget("test1");
    }

    public function test2()
    {
        $this->executeTarget("test2");
    }

    public function test3()
    {
        $this->executeTarget("test3");
        $this->assertInLogs('php1');
        $this->assertInLogs('php2');
    }
}