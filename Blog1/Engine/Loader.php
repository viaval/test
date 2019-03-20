<?php

namespace TestProject\Engine;
use TestProject\Engine\Pattern\Singleton;

require_once _DIR_ . '/Pattern/Base. trait.php';
require_once _DIR_ . '/Pattern/Singleton.trait.php';

class Loader
{
    use Singleton;
    public function  init()
    {
        spl_autoload_register(array(_CLASS_, '_loadclasses'));
    }
    
}
