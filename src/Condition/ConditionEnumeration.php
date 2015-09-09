<?php

namespace Phing\Condition;

use Iterator;
use Phing\AbstractProjectComponent;

/**
 * "Inner" class for handling enumerations.
 * Uses build-in PHP5 iterator support.
 *
 * @package   phing.tasks.system.condition
 */
class ConditionEnumeration implements Iterator
{

    /** Current element number */
    private $num = 0;

    /** "Outer" ConditionBase class. */
    private $outer;

    /**
     * @param AbstractCondition $outer
     */
    public function __construct(AbstractCondition $outer)
    {
        $this->outer = $outer;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->outer->countConditions() > $this->num;
    }

    public function current()
    {
        $o = $this->outer->conditions[$this->num];
        if ($o instanceof AbstractProjectComponent) {
            $o->setProject($this->outer->getProject());
        }

        return $o;
    }

    public function next()
    {
        $this->num++;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->num;
    }

    public function rewind()
    {
        $this->num = 0;
    }
}