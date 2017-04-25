<?php
/**
 * @ file Brand.php
 * @ update 20150122
 */
namespace Site\Brand;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class Brand {
    
    /**
     * 品牌介绍
     * @route /brand
     * @access
     * @return string 
     */
    public static function brand($request) {
        //$res['sidebar'] = Site\Index\Index::getSidebar('品牌介绍',$request);
        //return new Response(theme()->render('brand.html',$res));
		$request->setParameter('size',6);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'partner',),
            'status' => array('value' => 1),
        ));
        $request->setParameter('orderBys',array(
            'sortrank'   => array('value' => 'DESC',),
        ));
        $res['list'] = Entity\Picture\Picture::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('品牌介绍',$request);

        return new Response(theme()->render('partner.html',$res));
    }
    
    
    /**
     * 合作品牌
     * @route /partner
     * @access
     * @return string 
     */
    public static function partner($request) {
        //conditions
        $request->setParameter('size',8);
        $request->setParameter('conditions',array(
            'type'   => array('value' => 'partner',),
            'status' => array('value' => 1),
        ));
        $request->setParameter('orderBys',array(
            'sortrank'   => array('value' => 'DESC',),
        ));
        $res['list'] = Entity\Picture\Picture::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('品牌介绍',$request);

        return new Response(theme()->render('partner.html',$res));
    }
    

}