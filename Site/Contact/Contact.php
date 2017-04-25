<?php
/**
 * @ file Contact.php
 * @ update 20150122
 */
namespace Site\Contact;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Site;

class Contact {

    /**
     * 公司信息
     * @route /company
     * @access
     * @return string 
     */
    public static function company($request) {

        $res['sidebar'] = Site\Index\Index::getSidebar('联系我们',$request);
        return new Response(theme()->render('company.html',$res));
    }
    
    /**
     * 商务合作
     * @route /business
     * @access
     * @return string 
     */
    public static function business($request) {
        //conditions
        $request->setParameter('size',50);
        $request->setParameter('conditions',array(
            'status' => array('value' => 1),
        ));
        $res['business'] = Entity\Contact\Contact::search($request);
        $res['sidebar'] = Site\Index\Index::getSidebar('联系我们',$request);
        return new Response(theme()->render('business.html',$res));
    }
   
}