<?php
// this is a user defined class
namespace escaper;

use Phalcon\Escaper;

class MyEscaper
{
    public function sanitizeAction($string)
    {
        $escaper = new Escaper();
        return $escaper->escapeHtml($string);
    }
}
