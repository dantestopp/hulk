<?php
namespace Hulk\Core;

/**
 * @category Engine
 * @package Hulk
 * @author Saphatonic <Saphatonic@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class ConfigurationLoader
{
    
    /**
     * Loads the specified configuration file and checks and replaces the specified default values
     * @param  String $path          configuration file (must be an ini file)
     * @param  Mixed  $defaultValues an associated array containing the default values 
     *
     * @return Mixed  an array containing the configuration vlaues or the default values if the config file does not exit
     */
    public function loadConfiguration($path, $defaultValues)
    {   
        $ini = null;
        //load ini file
        if (file_exists($path)) {        
            $ini = $ini = parse_ini_file($path); 
        } else {
            $ini = false;
        }
        
        //if ini file is empty or does not exist
        if(!$ini) {
            $this->createConfiguration($path, $defaultValues);
            $ini = $defaultValues;
        } else {
            foreach ($defaultValues as $key => $value) {
                if (!array_key_exists($key, $ini)) {
                    $ini[$key] = $value;
                }
            }
        }
        
        return $ini;
    }
    
    /**
     * Creates a configuration file with the specified name and values
     * @param  String $path   configuration file (must be an ini file)
     * @param  Mixed  $values an associated array containing the values 
     *
     * @return null  nothing
     */
    private function createConfiguration($path, $values)
    {
        $file = fopen($path, 'w');
        
        if (!$file) {
            die("File $path could not be opened");
        }
        
        foreach ($values as $key => $value) {
            $success = fwrite($file, $key.' = '.$value."\r\n");    
            if(!$success) {
                die("$path could not be written");
            }
        }
        fclose($file);        
    }
}
