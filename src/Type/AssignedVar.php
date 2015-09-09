<?php

namespace Phing\Type;

/**
 * An "inner" class for holding assigned var values.
 * May be need to expand beyond name/value in the future.
 *
 * @package phing.tasks.ext
 */
class AssignedVar
{
    private $name;
    private $value;

    /**
     * @param string $v
     */
    public function setName($v)
    {
        $this->name = $v;
    }

    /**
     * @param mixed $v
     */
    public function setValue($v)
    {
        $this->value = $v;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}