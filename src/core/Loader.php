<?php
namespace Hulk\Core;

/**
 * @author gabriellovric
 */
class Loader {

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
     * @param
     * @return
     */
    public function register();

    /**
     * Unregister a class
     *
     * @param
     * @return
     */
    public function unregister();

    /**
     * Get instance of class if doesnt exist create new one
     *
     * @param
     * @return
     */
    public function getInstance();

    /**
     * Enables or disables autoloding
     *
     * @param
     * @return
     */
    public function autoload();

    /**
     * Used by autoloader to load classes.
     *
     * @param
     * @return
     */
    public function load();
}
