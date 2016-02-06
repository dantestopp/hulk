<?php
namespace Hulk\Core;

/**
 * @author happyoniens
 */
class Heart{

    private $vars = [];

    public static function smash(){

    }

    /**
     * Sets a variable to save in the framework
     *
     * @param String $key   Key
     * @param Mixed $value value
     */
    public function set($key, $value){
        $this->vars[$key] = $value;
    }

    /**
     * Gets a saved variable
     *
     * @param  String $key Key
     * @return Mixed      Saved value
     */
    public function get($key){
        return $this->vars[$key];
    }

    /**
     * Checks if a variable is exists
     *
     * @param  String  $key Key
     * @return boolean
     */
    public function has($key){
        return isset($this->vars[$key]);
    }

    /**
     * Delete all or just a given variable
     * 
     * @param  String $key Leave empty to delete all variables
     */
    public function delete($key = null){
        if($key === null){
            $this->vars = [];
        }else{
            unset($this->vars[$key]);
        }
    }
}
