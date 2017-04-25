<?php
/**
 * @ file article.php
 * @ update 20150122
 */
namespace Site\Game;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class Game {

    /**
     * 单机游戏
     * @route /socogame
     * @access
     * @return string 
     */
    public static function socogame($request) {
    
    
        $res['sidebar'] = Site\Index\Index::getSidebar('文化产品',$request);
        return new Response(theme()->render('socogame.html',$res));
    }
    /**
     * 单机游戏
     * @route /standalone
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function standalone($request) {
        
        //分类置顶 conditions
        $request->setParameter('size',1);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'standalone'),
            'top'   => array('value' => 1),
            'status' => array('value' => 1),
        ));
        $res['topImage']    = current(Entity\Game\Game::search($request)['data']);

        //conditions
        $request->setParameter('size',6);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'standalone'),
            'top'   => array('value' => 0),
            'status' => array('value' => 1),
        ));
        $res['list']    = Entity\Game\Game::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('游戏产品',$request);
        return new Response(theme()->render('spgame.html',$res));
    }
    
    /**
     * 手机游戏
     * @route /online
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function online($request) {
        
        //分类置顶 conditions
        $request->setParameter('size',1);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'online'),
            'top'   => array('value' => 1),
            'status' => array('value' => 1),
        ));
        $res['topImage']    = current(Entity\Game\Game::search($request)['data']);
        
        //conditions
        $request->setParameter('size',6);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'online'),
            'top'    => array('value' => 0),
            'status' => array('value' => 1),
        ));
        $res['list']    = Entity\Game\Game::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('游戏产品',$request);
        return new Response(theme()->render('spgame.html',$res));
    }
    
    /**
     * 网页游戏
     * @route /webgame
     * @access
     * @param  int  size 
     * @param  int  page
     * @return string 
     */
    public static function webgame($request) {
        
        //分类置顶 conditions
        $request->setParameter('size',1);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'webgame'),
            'top'   => array('value' => 1),
            'status' => array('value' => 1),
        ));
        $res['topImage']    = current(Entity\Game\Game::search($request)['data']);
        
        //conditions
        $request->setParameter('size',6);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'webgame'),
            'top'    => array('value' => 0),
            'status' => array('value' => 1),
        ));
        $res['list']    = Entity\Game\Game::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('游戏产品',$request);
        return new Response(theme()->render('spgame.html',$res));
    }

}