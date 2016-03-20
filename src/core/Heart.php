<?php
namespace Hulk\Core;

/**
 * @category Engine
 * @package Hulk
 * @author happyoniens <dante.stoppini@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class Heart
{

    /**
     * Stored variables
     * @var Array
     */
    private $vars = [];

    /**
     * Stores the captain
     * @var Hulk\Core\Captain
     */
    public $captain = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->captain = new Captain();
        $this->loader = new Loader();

        $this->build();
    }

    /**
     * Handles functions calls
     *
     * @param  String $name   Name of function or class
     * @param  Array  $params Params
     *
     * @return Mixed          Return of functions
     */
    public function __call($name, $params)
    {
        if (is_callable($this->captain->get($name))) {
            return $this->$captain->run($name, $params);
        } else {
            return $this->loader->run($name);
        }
    }

    /**
     * Build the framework
     *
     * @return null nothing
     */
    private function build()
    {
        //Set default framework vars		
		$this->setArray([
			'hulk.debug' => false,
			'hulk.view.path' => '',
			'hulk.models.path' => '',
			'hulk.controllers.path' => '',
			'hulk.exceptions' => true,
			'hulk.errors' => true,
		]);		

        foreach (['smash', 'set', 'get', 'clear', 'has', 'delete', 'register', 'path'] as $key) {
            $this->captain->set($key, [$this, $key]);
        }

        $this->buildEHandlers();
    }

    /**
     * Start function
     *
     * @return null nothing
     */
    public static function smash()
    {
        print "<h1>It works!</h1>";
    }

    /**
     * Add path to autoloader
     * @param  String $path Path to Directory
     *
     * @return null         nothing
     */
    public function path($path)
    {
        $this->loader->addDirectory($path);
    }

    /**
     * Register class
     * @param  String $name   Name to run class
     * @param  String $class  Name of class
     * @param  Array  $params Params for instantiation
     *
     * @return null           nothing
     */
    public function register($name, $class, $params = [])
    {
        $this->loader->register($name, $class, $params);
    }

    /**
     * Sets multiple variables to save in the framework
     *
     * @param Array $array the array with the variables
     *
     * @return null nothing
     */
    public function setArray($array)
    {
		foreach($array as $key => $value) {
			$this->set($key, $value);
		}
    }

    /**
     * Sets a variable to save in the framework
     *
     * @param String $key   Key
     * @param Mixed  $value value
     *
     * @return null nothing
     */
    public function set($key, $value = null)
    {
        $this->vars[$key] = $value;
    }

    /**
     * Gets a saved variable
     *
     * @param String $key Key
     *
     * @return Mixed       Saved value
     */
    public function get($key)
    {
        return $this->vars[$key];
    }

    /**
     * Checks if a variable is exists
     *
     * @param String $key Key
     *
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->vars[$key]);
    }

    /**
     * Delete all or just a given variable
     *
     * @param String $key Leave empty to delete all variables
     *
     * @return null nothing
     */
    public function delete($key = null)
    {
        if ($key === null) {
            $this->vars = [];
        } else {
            unset($this->vars[$key]);
        }
    }

    /**
     * Set exception and error handlers if they are activated
     *
     * @return null nothing
     */
    private function buildEHandlers()
    {
        if ($this->get('hulk.exceptions') == true) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }
        if ($this->get('hulk.errors') == true) {
                    set_error_handler([$this, 'errorHandler']);
        }
    }

    /**
     * Converts php_errors to exceptions
     *
     * @param Int    $errno   Errornumber
     * @param String $errstr  Errorstring
     * @param String $errfile Errorfile
     * @param String $errline Errorline
     *
     * @return null            nothing
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if ($errno & error_reporting()) {
            throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
        }
    }
}
