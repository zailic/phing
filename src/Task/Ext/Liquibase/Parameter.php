<?php

namespace Phing\Task\Ext\Liquibase;

use Phing\Exception\BuildException;
use Phing\Project;
use Phing\Type\DataType;

/**
 * @author Stephan Hochdoerfer <S.Hochdoerfer@bitExpert.de>
 * @version $Id$
 * @since 2.4.10
 * @package phing.tasks.ext.liquibase
 */
class Parameter extends DataType
{
    private $name;
    private $value;

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param Project $p
     * @return string
     * @throws \Phing\Exception\BuildException
     */
    public function getCommandline(Project $p)
    {
        if ($this->isReference()) {
            return $this->getRef($p)->getCommandline($p);
        }

        return sprintf("--%s=%s", $this->name, escapeshellarg($this->value));
    }

    /**
     * @param Project $p
     * @return mixed
     * @throws BuildException
     */
    public function getRef(Project $p)
    {
        if (!$this->checked) {
            $stk = array();
            array_push($stk, $this);
            $this->dieOnCircularReference($stk, $p);
        }

        $o = $this->ref->getReferencedObject($p);
        if (!($o instanceof Parameter)) {
            throw new BuildException($this->ref->getRefId() . " doesn't denote a LiquibaseParameter");
        } else {
            return $o;
        }
    }

}