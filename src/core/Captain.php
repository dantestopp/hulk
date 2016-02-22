<?php
namespace Hulk\Core;

/**
 * @category Captain
 * @package Hulk
 * @author happyoniens <dante.stoppini@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class Captain
{
    /**
     * Run a specified function
     * @param  Mixed $name   Name of the function
     * @param  Mixed $params Params to pass
     * 
     * @return Mixed         Result of function
     */
    public function run($name, $params)
    {
        return $this->invoke($name, $params);
    }

    /**
     * Invoke specified function
     * @param  Mixed $name   Name of the function
     * @param  Mixed $params Params to pass
     *
     * @return Mixed         Result of function
     * @throws Hulk\Core\HulkException
     */
    private function invoke($name, $params)
    {
        if (is_callable($name)) {
            return call_user_func_array($name, $params);
        } else {
            throw new HulkException("Invalid callback specified: {$name}.");
        }
    }
}
