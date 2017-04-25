<?php
/**
 * @ file Example.php
 */
namespace Site\Example;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;

class Example {

    /**
     * 测试页面
     * @route /example
     * @access
     * @return json 
     */
    public static function example($request) {
        
        return new Response(theme()->render('example.html',array()));
    }
}