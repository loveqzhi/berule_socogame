<?php

/**
 * @file
 *
 * index.php
 */

//include framework
require_once dirname(__DIR__) . '/Pyramid/Pyramid.php';

//include config
require_once __DIR__ . '/config.php';

define('ApplicationRoot', dirname(__FILE__));

//设置前端模板目录
define('THEMEFOLDER', __DIR__ . '/theme/default/site');
$engines['default']['loaderArgs'] = array(THEMEFOLDER);

//extends Kernel
class AppKernel extends Kernel{

    public function __construct() {
        require_once __DIR__ . '/Entity/Entity.php';
        require_once __DIR__ . '/Site/Site.php';
        $files = file_scan(__DIR__ . '/Site', "|(\w+)/\\1.php$|is", array('fullpath'=>true,'minDepth'=>2));
        foreach ($files as $f) {
            $module = explode('.', $f['basename'])[0];
            require_once $f['file'];
            $r = new Pyramid\Component\Reflection\ReflectionClass("Site\\$module\\$module");
            foreach ($r->getMethods() as $method=>$m) {
                if (!empty($m['comments']['route'])) {
                    route_register($m['comments']['route'], "Site\\$module\\$module::$method");
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
    
    function themeNumberPager($pager,$pageUrl=''){
        $numPage = new numPage;
        $numPage->setConfig($pager['total'],$pager['size'],3,$pager['page'],'page=',$pageUrl);
        
		return $numPage->write();
    }

}

class numPage {
	var $total;
	var $limit;
	var $pageNum;
	var $cPage;
	var $pageCount;
	var $url;
	var $urlPara;
	var $prevD ="上一页";
	var $prevE ="上一页";
	var $nextD ="下一页";
	var $nextE ="下一页";
	var $firstD="首页";
	var $firstE="首页";
	var $lastD ="末页";
	var $lastE ="末页";
	var $limitStart;
	var $pageStart;
	var $pageEnd;
	
    function setConfig($total,$limit,$pageNum,$page,$pageParam='page=',$pageUrl='') {
        $page=$page?$page:0;
        $uri = $_SERVER['REQUEST_URI'];
        $this->total = $total < 1 ? 0:$total;
        $this->limit= $limit;
        $this->pageNum = $pageNum;
        if( $pageUrl )
        {
            $this->url = $pageUrl.'&'.$pageParam;
        }
        else
        {
            //$this->url = eregi_replace('[\?&]*'.$pageParam.'[0-9]*[^\S&]*','',$uri);//去除当前页变量p=
            $this->url = preg_replace('/[\?&]*'.$pageParam.'[0-9]*[^\S&]*/i','',$uri);
            if (preg_match("/\?".$pageParam."\d{1,}$/i",$uri) || !preg_match("/\?/i",$uri)) {
                $this->url .= "?" . $pageParam;
            } else {
                $this->url .= "&" . $pageParam;
            }
            //$this->url .= (preg_match('/\?p/i',$uri) ? '&':'?').$pageParam;

        }
        $this->pageCount = Intval($this->getPageCount());
        $this->cPage = $this->numMinMax($page,1,1,1,$this->pageCount);
        $this->limitStart = ($this->cPage-1) * $limit;
        $this->pageStart = $this->numMinMax($this->cPage-1,1,0,0,0)*$limit;
        $this->pageEnd = $this->numMinMax($this->pageStart + $limit+1,0,1,0,$total);
        
        return $this;
    }
    function numMinMax($num,$min,$max,$minNum,$maxNum) {
        if( is_numeric($num) )
        {
            $num = ( $min==1 && $num<$minNum ) ? $minNum:$num;
            $num = ( $max==1 && $num>$maxNum ) ? $maxNum:$num;
        }
        else 
            $num = $minNum;
        return floor($num);
    }
    function getPageCount(){
        return ( ($this->total%$this->limit) == 0 ? ($this->total/$this->limit):($this->numMinMax($this->total/$this->limit,1,0,0,0)+1));
    }
    function write(){
        $total = $this->total;
        $pageCount = $this->pageCount;
        $pageNum = $this->pageNum;
        $pageTotal = $this->numMinMax($pageCount,1,0,1,0);
        $url = $this->url;
        $cPage = Intval($this->cPage);
        $prev = $this->numMinMax($cPage-1,1,1,1,$pageTotal);
        $next = $this->numMinMax($cPage+1,1,1,1,$pageTotal);
        $numUrl = "";
        $t1 = "<li><a href=\"".$url;
        $t2="\">";
        $t3="</a></li>";
        $t4="<li class='page-first'><a href='#'>";
        $t5="</a></li>";
        $tt1 = "<li><a href=\"".$url;
        $tt2="\">";
        $tt3="</a></li>";
        $tt4="<li class='active'><a href='#'>";
        $tt5="</a></li>";
        if( $cPage <=1 )
        {
            $fUrl = $t4.$this->firstD.$t5;
            //$pUrl = $t4.$this->prevD.$t5;
            $pUrl = '';
        }
        else
        {
            $fUrl = $t1."1".$t2.$this->firstE.$t3;
            $pUrl = $t1.$prev.$t2.$this->prevE.$t3;
        }
        if ( $cPage == $pageTotal || $pageTotal < 1)
        {
            $lUrl = $t4.$this->lastD.$t5;
            //$nUrl = $t4.$this->nextD.$t5;
            $nUrl = '';
        }
        else if( $cPage < $pageCount)
        {
            $nUrl = $t1.$next.$t2.$this->nextE.$t3;
            $lUrl = $t1.$pageTotal.$t2.$this->lastE.$t3;
        }
        $pageStart=1;
        $pageEnd = $pageCount;
        if( $pageNum > 0 )
        {
            $pageStart= $this->numMinMax($cPage-$pageNum,1,0,1,0);
            $pageEnd = $this->numMinMax($pageStart+$pageNum*2,0,1,0,$pageCount);
            $pageStart = $pageEnd==$pageCount ? $this->numMinMax($pageEnd-$pageNum*2,1,0,1,0):$pageStart;
        }
        
        if( $pageCount > 0 )
        {
            for($i=$pageStart;$i<=$pageEnd; $i++ )
            {
                $ii = $i<10 ? "0"+$i : $i;
                $cPage != $i ? $pStr = $tt1.$i.$tt2.$ii.$tt3:$pStr = $tt4.$ii.$tt5;
                $numUrl .= $pStr;
            }
        }
        $other = '<span>共<b>'.$total.'</b>条记录　页次：<b>'.$cPage.'/'.$pageTotal.'</b></span>';
        $pageStr = $fUrl.$pUrl.$numUrl.$nUrl.$lUrl;
        return $pageStr;
    }
}

$kernel   = new AppKernel();
$request  = Pyramid\Component\HttpFoundation\Request::createFromGlobals();
$response = $kernel->handle($request);
if ($response->status == 404) {
    $response->setContent(theme()->render('404.html',array()));
    $response->status = 200;
}
$response->send();
