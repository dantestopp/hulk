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

    private $calls = [];

    /**
     * Run a specified function
     * @param  Mixed $name   Name of the function
     * @param  Mixed $params Params to pass
     *
     * @return Mixed         Result of function
     */
    public function run($name, $params)
    {
        return $this->invoke($this->get($name), $params);
    }

    /**
     * Set Class/Function information for a function
     * @param String $name     Name of function
     * @param Array  $callback Array with Class/Function information
     *
     * @return Null  Nothing
     */
    public function set($name, $callback)
    {
        $this->calls[$name] = $callback;
    }

    /**
     * Get Class/Function information for a Function
     * @param  String $name Name of function
     *
     * @return Array        Array with Class/Function information
     */
    public function get($name)
    {
        if (isset($this->calls[$name])) {
            return $this->calls[$name];
        } else {
            return null;
        };
    }

    /**
     * Invoke specified function
     * @param  Mixed $name   Name of the function
     * @param  Mixed $params Params to pass
     *
     * @return Mixed         Result of function
     * @throws Hulk\Core\HulkException
     */
    public function invoke($name, $params)
    {
        if (is_callable($name)) {
            return call_user_func_array($name, $params);
        } else {
            throw new HulkException("Invalid callback specified: {$name}.");
        }
    }
}
