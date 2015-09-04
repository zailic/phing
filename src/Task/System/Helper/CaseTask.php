<?php
/**
 * Created by PhpStorm.
 * User: michiel
 * Date: 9/4/15
 * Time: 11:38 PM
 */
namespace Phing\Task\System\Helper;

use Phing\Task;
use Phing\Task\System\Sequential;

/**
 * "Inner" class for SwitchTask.
 *
 * @package phing.tasks.system
 */
class CaseTask extends Sequential
{
    /** @var mixed $value */
    private $value = null;

    /**
     * @param $value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function main()
    {
        /** @var Task $task */
        foreach ($this->nestedTasks as $task) {
            $task->perform();
        }
    }
}