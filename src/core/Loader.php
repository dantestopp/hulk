<?php
namespace Hulk\Core;

/**
 * @category Loader
 * @package Hulk
 * @author gabriellovric <lovric.gabriel@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class Loader
{

    /**
     * Registered classes.
     *
     * @var array
     */
    protected $classes = array();

    /**
     * Class instances.
     *
     * @var array
     */
    protected $instances = array();

    /**
     * Autoload directories.
     *
     * @var array
     */
    protected static $dirs = array();

    /**
     * Register a class
     *
     * @return null
     */
    public function register()
    {

    }

    /**
     * Unregister a class
     *
     * @return null
     */
    public function unregister()
    {

    }

    /**
     * Get instance of class if doesnt exist create new one
     *
     * @return null
     */
    public function getInstance()
    {

    }

    /**
     * Enables or disables autoloding
     *
     * @return null
     */
    public function autoload()
    {

    }

    /**
     * Used by autoloader to load classes.
     *
     * @return null
     */
    public function load()
    {

    }
}
