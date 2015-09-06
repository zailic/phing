<?php
/**
 * Created by PhpStorm.
 * User: michiel
 * Date: 9/6/15
 * Time: 9:54 AM
 */
namespace Phing\Task\Ext\PearPackage;

use PearPkgMappingElement;

/**
 * Handles complex options <mapping> elements which are hashes (assoc arrays).
 *
 * @package  phing.tasks.ext
 */
class PearPkgMapping
{

    private $name;
    private $elements = array();

    /**
     * @param $v
     */
    public function setName($v)
    {
        $this->name = $v;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \Phing\Task\Ext\PearPackage\PearPkgMappingElement
     */
    public function createElement()
    {
        $e = new \Phing\Task\Ext\PearPackage\PearPkgMappingElement();
        $this->elements[] = $e;

        return $e;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Returns the PHP hash or array of hashes (etc.) that this mapping represents.
     * @return array
     */
    public function getValue()
    {
        $value = array();
        foreach ($this->getElements() as $el) {
            if ($el->getKey() !== null) {
                $value[$el->getKey()] = $el->getValue();
            } else {
                $value[] = $el->getValue();
            }
        }

        return $value;
    }
}