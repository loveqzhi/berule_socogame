<?php
/**
 * @ file about.php
 * @ update 20150122
 */
namespace Site\About;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class About {

    /**
     * 关于索乐
     * @route /about
     * @access
     * @return string 
     */
    public static function about($request) {
        $res['sidebar'] = Site\Index\Index::getSidebar('关于索乐',$request);

        return new Response(theme()->render('corpinfo.html',$res));
    }
    
    /**
     * 公司简介
     * @route /corpinfo
     * @access
     * @return string 
     */
    public static function corpinfo($request) {
        $res['sidebar'] = Site\Index\Index::getSidebar('关于索乐',$request);

        return new Response(theme()->render('corpinfo.html',$res));
    }
    
    /**
     * 企业文化
     * @route /enterprise
     * @access
     * @return string 
     */
    public static function enterprise($request) {
        $res['sidebar'] = Site\Index\Index::getSidebar('关于索乐',$request);

        return new Response(theme()->render('enterprise.html',$res));
    }
    
    /**
     * 发展历程
     * @route /progress
     * @access
     * @return string 
     */
    public static function progress($request) {
        $res['sidebar'] = Site\Index\Index::getSidebar('关于索乐',$request);

        return new Response(theme()->render('progress.html',$res));
    }
    
    /**
     * 投资关系
     * @route /investment
     * @access
     * @return string 
     */
    public static function investment($request) {
        $res['sidebar'] = Site\Index\Index::getSidebar('关于索乐',$request);

        return new Response(theme()->render('investment.html',$res));
    }
    
    /**
     * 员工风采
     * @route /staff
     * @access
     * @return string 
     */
    public static function staff($request) {
        //conditions
        $request->setParameter('size',30);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'staff',),
            'status' => array('value' => 1),
        ));
        $res['images'] = Entity\Picture\Picture::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('关于索乐',$request);
        //print_r($res);exit;
        return new Response(theme()->render('staff.html',$res));
    }
    

}