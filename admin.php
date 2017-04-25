<?php

/**
 * @file
 *
 * admin.php
 */

//include framework
require_once dirname(__DIR__) . '/Pyramid/Pyramid.php';

//include config
require_once __DIR__ . '/config.php';

//设置前端模板目录
define('THEMEFOLDER', __DIR__ . '/theme/default/admin');
$engines['default']['loaderArgs'] = array(THEMEFOLDER);

//extends Kernel
class AppKernel extends Kernel{

    public function __construct() {
        require_once __DIR__ . '/Entity/Entity.php';
        require_once __DIR__ . '/Admin/Admin.php';
        $files = file_scan(__DIR__ . '/Admin', "|(\w+)/\\1.php$|is", array('fullpath'=>true,'minDepth'=>2));
        foreach ($files as $f) {
            $module = explode('.', $f['basename'])[0];
            require_once $f['file'];
            $r = new Pyramid\Component\Reflection\ReflectionClass("Admin\\$module\\$module");
            foreach ($r->getMethods() as $method=>$m) {
                if (!empty($m['comments']['route'])) {
                    route_register($m['comments']['route'], "Admin\\$module\\$module::$method");
                }
            }
        }
    }
    
    function themePager($pager, $pageurl = '') {
        static $li = '<li><a href="%spage=%s">%s</a></li>';
        static $lt = '<li><span>%s</span></li>';
        static $hasjs;
        $unique   = uniqid();
        $pageurl .= strpos($pageurl,'?') ? '&' : '?';
        $return  = '<ul class="pagination">';
        $return .= sprintf($lt, $pager['page'].'/<strong>'.$pager['pages'].'</strong> 页');
        if ($pager['page'] > 1) {
            $return .= sprintf($li, $pageurl, $pager['page']-1, '上一页');
        }
        if ($pager['page'] < $pager['pages']) {
            $return .= sprintf($li, $pageurl, $pager['page']+1, '下一页');
        }
        $return .= "<li><a href='javascript:showjumpdiv(\"{$unique}\");'>跳转到</a></li>"
            . "<form method='post' action='{$pageurl}'>"
            . "<div id='div{$unique}' class='jumpdiv'> <input id='input{$unique}' type='text' name='page' /> 页 "
            . "<button type='submit' class='btn btn-info btn-xs'>确认</button></div>"
            . "</form>";
        
        $return .= '</ul>';
        if (!$hasjs) {
            $return .= '<script>function showjumpdiv(unique) { $("#div"+unique).toggle();$("#input"+unique).focus();}</script>';
            $hasjs = true;
        }
        return $return;
    }
    
    public function afterRoute($request) {
        $matchroute = $request->route->get('matchroute');
        switch ($matchroute) {
            case 'admin/login':
            case 'admin/upload':
            case 'admin/upfile':
            break;
            default:
                if (!session()->get('admin')) {
                    header("Location: /admin/login");
                }
            break;
        }
    }

}

$kernel   = new AppKernel();
$request  = Pyramid\Component\HttpFoundation\Request::createFromGlobals();
$response = $kernel->handle($request);
if ($response->status == 404) {
    $response->setContent(theme()->render('admin-404.html',array()));
    $response->status = 200;
}
$response->send();
