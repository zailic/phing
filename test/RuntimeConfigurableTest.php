<?php

namespace Phing\Test;

use Phing\Project;
use Phing\RuntimeConfigurable;

class RuntimeConfigurableTest extends \PHPUnit_Framework_TestCase
{
    public function testLiteral0ShouldBeKept()
    {
        $project = new Project();
        $proxy = new Helper\Proxy();
        $runtimeConfigurable = new RuntimeConfigurable($proxy, 'proxy');
        $runtimeConfigurable->addText('0');
        $runtimeConfigurable->maybeConfigure($project);
        $this->assertSame('0', $proxy->getText());
    }
}
