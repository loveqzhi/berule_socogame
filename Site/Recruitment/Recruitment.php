<?php
/**
 * @ file Recruitment.php
 * @ update 20150122
 */
namespace Site\Recruitment;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class Recruitment {

    /**
     * 人才理念
     * @route /talents
     * @access
     * @return string 
     */
    public static function talents($request) {

        $res['sidebar'] = Site\Index\Index::getSidebar('招贤纳士',$request);
        return new Response(theme()->render('talents.html',$res));
    }
    
    /**
     * 在招岗位
     * @route /recruit
     * @access
     * @return string 
     */
    public static function recruit($request) {
        $positions = config()->get('position');
        //conditions
        foreach($positions as $type => $name) {
            $request->setParameter('size',20);
            $request->setParameter('conditions',array(
                'type'   => array('value' => $type),
                'status' => array('value' => 1),
            ));
            $positions[$type] = Entity\Recruitment\Recruitment::search($request);
        }
        $res['positions'] =  $positions;
        $res['sidebar'] = Site\Index\Index::getSidebar('招贤纳士',$request);
        return new Response(theme()->render('recruit.html',$res));
    }
    
    /**
     * 在招岗位 详情
     * @route /recruit/show/{id}
     * @access
     * @param  int  id   职位ID
     * @return string 
     */
    public static function recruitDetail($request) {
        $id = (int) $request->route->getParameter('id');
        $position = Entity\Recruitment\Recruitment::load(entity_request(array('id'=>$id)));
        if (empty($position) || $position->status == 0) {
            return new Response(true,404);
        }
        $res['position'] = $position;
        $res['sidebar'] = Site\Index\Index::getSidebar('招贤纳士',$request);
        return new Response(theme()->render('recruit-detail.html',$res));
    }

    

}