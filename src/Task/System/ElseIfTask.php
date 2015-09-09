<?php

namespace Phing\Task\System;

use Phing\Condition\AbstractCondition;
use Phing\Exception\BuildException;
use Phing\Task\System\Sequential;

/**
 * "Inner" class for IfTask.
 * This class has same basic structure as the IfTask, although of course it doesn't support <else> tags.
 *
 * @package phing.tasks.system
 */
class ElseIfTask extends AbstractCondition
{

    private $thenTasks = null;

    /**
     * @param Sequential $t
     * @throws BuildException
     */
    public function addThen(Sequential $t)
    {
        if ($this->thenTasks != null) {
            throw new BuildException("You must not nest more than one <then> into <elseif>");
        }
        $this->thenTasks = $t;
    }

    /**
     * @throws \Phing\Exception\BuildException
     * @return boolean
     */
    public function evaluate()
    {

        if ($this->countConditions() > 1) {
            throw new BuildException("You must not nest more than one condition into <elseif>");
        }
        if ($this->countConditions() < 1) {
            throw new BuildException("You must nest a condition into <elseif>");
        }

        $conditions = $this->getConditions();
        $c = $conditions[0];

        return $c->evaluate();
    }

    /**
     *
     */
    public function main()
    {
        if ($this->thenTasks != null) {
            $this->thenTasks->main();
        }
    }
}