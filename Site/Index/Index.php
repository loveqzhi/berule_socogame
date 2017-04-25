<?php
/**
 * @ file index.php
 * @ update 20150121
 */
namespace Site\Index;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;

class Index {

    /**
     * 首页入口
     * @route /
     * @access
     * @param page 
     * @param size
     * @return string 
     */
    public static function index($request) {
 
        //首页横幅图 conditions
        $request->setParameter('size',10);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'home'),
            'status' => array('value' => 1),
        ));
        $res['images'] = Entity\Picture\Picture::search($request);
        
        //索乐动态 conditions
        $request->setParameter('size',5);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'news'),
            'status' => array('value' => 1),
        ));
        $r = clone $request;
        $r->setParameter('orderBys', array('timeline'=>array('value'=>'DESC')));
        $res['news1'] = Entity\Article\Article::search($r);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'game'),
            'status' => array('value' => 1),
        ));
        $r = clone $request;
        $r->setParameter('orderBys', array('timeline'=>array('value'=>'DESC')));
        $res['news2'] = Entity\Article\Article::search($r);
        
        //索乐动态 conditions 图
        $request->setParameter('size',2);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'news'),
            'status' => array('value' => 1),
        ));
        $request->setParameter('orderBys',null);
        $res['news_image'] = Entity\Picture\Picture::search($request);       
            
        //游戏产品
        $request->setParameter('size',5);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'game'),
            'status' => array('value' => 1),
        ));
        $res['games'] = Entity\Picture\Picture::search($request);
        
        //文化品牌 
        $request->setParameter('size',4);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'culture'),
            'status' => array('value' => 1),
        ));
        $res['culture'] = Entity\Picture\Picture::search($request);
        
        //招贤
        $request->setParameter('size',20);
        $request->setParameter('conditions',array(
            'status' => array('value' => 1),
        ));
        $res['recruitment'] = Entity\Recruitment\Recruitment::search($request);
        
        return new Response(theme()->render('index.html',$res));
    }
    

    /**
     * @ 获取 sidebar
     * @ access public
     * @ return array
     */
    public static function getSidebar($name = '关于索乐' , $request = null) {
        $matchroute = $request->route->get('matchroute');
        $data = config()->get('catalog')[$name];
        foreach($data as $k => $v) {
            if (strrpos($matchroute,$k) !== false) {
                $data[$k]['active'] = true;
            }
        }

        return array(
            'name'      => ($name == '游戏产品')?'<a href="/socogame" style="color:#fff">返回游戏产品</a>':$name,
            'en_name'   => config()->get('catalogen')[$name]['en'],
            'data'      => $data,
        );
    }
    
     /**
     * @ 索乐集团成员
     * @ access public
     * @ return array
     */
    public static function getMember() {
        $data = db_select("picture","p")
                    ->fields("p")
                    ->condition("type","member")
                    ->condition("status",1)
                    ->orderBy('sortrank','DESC')
                    ->orderBy('id','DESC')
                    ->execute()
                    ->fetchAll();
                    
        return (empty($data)) ? array() : $data;
    }
}