<?php
/**
 * @ file Culture.php
 * @ update 20150122
 */
namespace Site\Culture;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class Culture {

    /**
     * 动画产品
     * @route /cartoon
     * @access
     * @return string 
     */
    public static function cartoon($request) {   
        //conditions
        $request->setParameter('size',10);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'cartoon'),
            'status' => array('value' => 1),
        ));
        $res['list']    = Entity\Culture\Culture::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('cartoon.html',$res));
    }
    
	/**
     * 动画产品S2详情
     * @route /cartoon/72/detail
     * @access
     * @return string 
     */

    public static function cartoon_detail_s2($request) {
        $id = 72; //(int) $request->route->getParameter('id');
        $res['cartoon']    = Entity\Culture\Culture::load(entity_request(array('id'=>$id)));
        $res['sidebar']    = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('cartoon.s2.detail.html',$res));
    }
	
    /**
     * 动画产品详情
     * @route /cartoon/{$id}/detail
     * @access
     * @return string 
     */

    public static function cartoon_detail($request) {
        $id = (int) $request->route->getParameter('id');
        $res['cartoon']    = Entity\Culture\Culture::load(entity_request(array('id'=>$id)));
        $res['sidebar']    = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('cartoon.detail.html',$res));
    }

    /**
     * 音乐作品
     * @route /music
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function music($request) {
        
        //conditions
        $request->setParameter('size',6);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'music'),
            'status' => array('value' => 1),
        ));
        $res['list']    = Entity\Culture\Culture::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('music.html',$res));
    }
    /**
     * 图书绘本
     * @route /caricature
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function caricature($request) {
        
        $navi   = array('page'=> 1,'size' => 20, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->get('page', 1);
        $size   = (int) $request->get('size', 20);
        $query = db_select("culture","c")
                    ->fields("c")
                    ->extend('Pager')->page($page)->size($size)
                    ->condition("type","caricature")
                    ->condition("status",1);
        if ($request->get('subtype')) {
            $query->condition("subtype",$request->get('subtype'));
            $query->condition("top",0);
        } else {
            $query->condition("top",1);
            $query->groupBy('subtype');
        }
        $query->orderBy('id','DESC');
        $pager = array_merge($navi, $query->fetchPager());
        $data  = $query->execute()->fetchAll();
        $res['list'] = array('data'=>$data, 'pager'=>$pager);
        $res['subtype'] = $request->get('subtype',0);
        $res['sidebar'] = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('caricature.html',$res));
    }
    /**
     * 系列周边
     * @route /other
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function other($request) {
        
        //conditions
        /*
        $request->setParameter('size',7);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'other'),
            'status' => array('value' => 1),
            'subtype' => array('value' => $request->get('subtype',null)),
        ));
        $res['list']    = Entity\Culture\Culture::search($request);
        */
        $navi   = array('page'=> 1,'size' => 20, 'total'=> 0, 'pages' => 1);
        $page   = (int) $request->get('page', 1);
        $size   = (int) $request->get('size', 20);
        $query = db_select("culture","c")
                    ->fields("c")
                    ->extend('Pager')->page($page)->size($size)
                    ->condition("type","other")
                    ->condition("status",1);
        if ($request->get('subtype')) {
            $query->condition("subtype",$request->get('subtype'));
            $query->condition("top",0);
        } else {
            $query->condition("top",1);
            $query->groupBy('subtype');
        }
        $query->orderBy('id','DESC');
        $pager = array_merge($navi, $query->fetchPager());
        $data  = $query->execute()->fetchAll();
        $res['list'] = array('data'=>$data, 'pager'=>$pager);
        $res['subtype'] = $request->get('subtype',0);
        $res['sidebar'] = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('other.html',$res));
    }
    /**
     * culture json 数据
     * @route /culture/json
     * @access
     * @param  string type 
     * @param  int    page
     * @param  int    size
     * @param  int    subtype
     * @param  string model 
     * @return json
     */
    public static function cultureJson($request) {
        //conditions
        $request->setParameter('size',$request->get('size',1));
        $conditions = array(
            'type'   => array('value' => $request->get('type')),
            'status' => array('value' => 1),
        );
        if ($request->get('subtype')) {
            $conditions['subtype'] = array('value'=>$request->get('subtype'));
        }
        $request->setParameter('conditions',$conditions);
        $model = $request->get('model');   
        $res['culture']  = Entity\Culture\Culture::search($request);
        return new Response(json_encode(
                                array(
                                'status'=>'success',
                                'data'=>theme()->render($model.'.html',$res))
                                ),
                                '200',
                                array('Content-Type'=>'application/json'));
    }
    
}