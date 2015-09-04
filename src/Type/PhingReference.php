<?php
/**
 * Created by PhpStorm.
 * User: michiel
 * Date: 9/4/15
 * Time: 11:30 PM
 */
namespace Phing\Type;

use the;

/**
 * Helper class that implements the nested <reference>
 * element of <phing> and <phingcall>.
 *
 * @package   phing.tasks.system
 */
class PhingReference extends Reference
{

    private $targetid = null;

    /**
     * Set the id that this reference to be stored under in the
     * new project.
     *
     * @param the $targetid
     * @internal param the $targetid id under which this reference will be passed to
     *        the new project
     */
    public function setToRefid($targetid)
    {
        $this->targetid = $targetid;
    }

    /**
     * Get the id under which this reference will be stored in the new
     * project
     *
     * @return the id of the reference in the new project.
     */
    public function getToRefid()
    {
        return $this->targetid;
    }
}