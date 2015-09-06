<?php
/**
 * Created by PhpStorm.
 * User: michiel
 * Date: 9/6/15
 * Time: 9:54 AM
 */
namespace Phing\Task\Ext\PearPackage;

/**
 * Generic option class is used for non-complex options.
 *
 * @package  phing.tasks.ext
 */
class PearPkgOption
{

    private $name;
    private $value;

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
     * @param $v
     */
    public function setValue($v)
    {
        $this->value = $v;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $txt
     */
    public function addText($txt)
    {
        $this->value = trim($txt);
    }

}