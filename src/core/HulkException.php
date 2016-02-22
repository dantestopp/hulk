<?php
namespace Hulk\Core;

/**
 * @category Exception
 * @package Hulk
 * @author happyoniens <dante.stoppini@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class HulkException extends \Exception
{
    /**
     * Constructor
     * @param String    $message  Exception message
     * @param integer   $code     Exception code
     * @param Exception $previous Previous exception
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
