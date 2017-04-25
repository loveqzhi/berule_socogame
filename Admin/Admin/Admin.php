<?php

/**
 * @ Api file admin.php 
 * @ public for Back-stage management
 * @ 
 */
namespace Admin\Admin;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;

class Admin {

    /**
     * 后台跳转至索乐动态
     * @route /admin
     * @access 
     * @return json 
     */
    public static function goadmin($request) {
        $id = session()->get('admin')->id;
        if(empty($id)) {
            return new RedirectResponse($request->getUriForPath('/admin/login'));
        }
        return new RedirectResponse($request->getUriForPath('/admin/article/news'));
    }
    
    /**
     * 后台用户登录
     * @route /admin/login
     * @access 
     * @param string $username
     * @param string $password
     * @return json 
     */
    public static function login($request) {
        $id = session()->get('admin')->id;
        if(!empty($id)) {
            return new RedirectResponse($request->getUriForPath('/admin/article/news'));
        }
        
        if ($request->post->getParameters()) {
            $res = self::check($request);
            if ($res->getStatus() == 0) {
                if ($res->getData()->status=='0') {
                    return new Response(json_encode(
                        array('status'=>'error','msg'=>'账号被锁定')),'200',
                        array('Content-Type'=>'application/json'));
                }
                
                $admin = $res->getData();
                unset($admin->password);
                session()->set('admin',$admin);
                return new Response(json_encode(
                        array('status'=>'success','msg'=>'登录成功')),'200',
                        array('Content-Type'=>'application/json'));
            } else {
                $msg = config()->get('status')[$res->getStatus()];
                return new Response(json_encode(
                        array('status'=>'error','msg'=>$msg)),'200',
                        array('Content-Type'=>'application/json'));

            }
        } 
        else {
            return new Response(theme()->render('user-login.html',array()));
        }
    }
    
    //检测用户是否可以登录
    public static function check($request) {
        $username = $request->getParameter('username');
        $password = $request->getParameter('password');
        if (!$username || !$password) {
            return entity_response()->setStatus(10001);
        }
        $query = db_select('admin', 'u')->fields('u', array('id'));
        if ($username) {
            $query->condition('username', $username);
            $query->condition('status',1);
        }
        if ($id = $query->execute()->fetchField()) {
            $admin = Entity\Admin\Admin::load(entity_request(array('id'=>$id)));
            if (pyramid_password_verify($password, $admin->password)) {
                return entity_response($admin);
            } else {
                return entity_response()->setStatus(10002);
            }
        } else {
            return entity_response()->setStatus(10003);
        }
    }
    
    /**
     * 编辑用户
     * @route /admin/user/edit/{id}
     * @access admin_access
     * @param int $id
     * @return string 
     */
    public static function edit($request) {
        //判断权限 todo
        
        $id = (int)$request->route->getParameter('id');
        $res['user'] = Entity\Admin\Admin::load(entity_request(array('id'=>$id)));
        if (empty($res['user'])) {
            return new RedirectResponse($request->getUriForPath('/admin/user/search'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
        }

        $res['roles'] = Entity\Role\Role::search(entity_request(array('size'=>100,'page'=>1)));
        $res['menus'] = \Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        return new Response(theme()->render('user-edit.html',$res));
    }
    
    /**
     * 添加管理用户
     * @route /admin/user/add
     * @access admin_access
     * @param string $username
     * @param string $password
     * @return string 
     */
    public static function add($request){
        if ($request->post->getParameters()) {
            $res = Entity\Admin\Admin::loadByUsername(entity_request(array('username'=>$request->get('username'))));
            if ($res != null) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'用户已经存在')),'200',
                            array('Content-Type'=>'application/json'));
            } 
            if (!preg_match('/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{6,20}$/',
                    $request->get('password'))) {
                return new Response(json_encode(
                                array('status'=>'error','msg'=>'密码格式不正确')),'200',
                                array('Content-Type'=>'application/json'));
            }

            $res = Entity\Admin\Admin::insert($request);
            if (isset($res) && isset($res->id)) {
                return new Response(json_encode(
                                array('status'=>'success','msg'=>'ok')),'200',
                                array('Content-Type'=>'application/json'));
            } else {
                return new Response(json_encode(
                    array('status'=>'error','code'=>10004,'msg'=>'注册失败')));
            }
        }
        else {
            $res['menus'] = \Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
			//print_r($res['menus']);exit;
            return new Response(theme()->render('user-add.html',$res));
        }
    }
    
    /**
     * 更新用户信息
     * @route /admin/user/update
     * @access admin_access
     * @param string $username
     * @param string $email
     * @param string $telephone
     * @return string 
     */
    public static function update($request) {
        $tempPerms = \Admin\Role\Role::getAllPermissions();
        $post_data = $request->getParameters();
        $id = $request->getParameter('id');
        $username = $request->getParameter('username');
        if (empty($username)) {
            return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'用户名必须填写')),'200',
                            array('Content-Type'=>'application/json'));
        }
        if (!$id) {
            return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'非法操作')),'200',
                            array('Content-Type'=>'application/json'));
        }
        $user = Entity\Admin\Admin::loadByUsername(entity_request(array('username'=>$username)));
        if(!empty($user) && $user->id!=$id) {
            return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>'用户名已被使用')),'200',
                            array('Content-Type'=>'application/json'));
        }
        if (!empty($id) && isset($post_data['relation_admin_roles']) && !empty($post_data['relation_admin_roles'])) {
            \Admin\Role\Role::updateAdminRoleById($post_data['relation_admin_roles'],$id);
            unset($post_data['relation_admin_roles']);
        }
        else {
            \Admin\Role\Role::updateAdminRoleById(array(),$id);
        }

        //更新用户信息
        Entity\Admin\Admin::update(entity_request($post_data));    
        
        return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'ok')),'200',
                            array('Content-Type'=>'application/json'));
    }    
    
    /**
     * 管理员列表
     * @route /admin/user/search
     * @access admin_access
     * @param int $page
     * @param int $size
     * @param int $status
     * @return string 
     */
    public static function search($request) {
        if (($admin=self::checkLogin()) == null) {
            return new RedirectResponse($request->getUriForPath('/admin/user/login'),'2',
                        '请先登录系统',array('Content-type'=>'text/html; charset=utf-8'));
        }
		if ($admin->id != 1) {
			 return new RedirectResponse($request->getUriForPath('/admin/login'),'2',
                        '非法操作',array('Content-type'=>'text/html; charset=utf-8'));
		}
        $res = array(
            'list'  => Entity\Admin\Admin::search($request),
            'menus' => \Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
        );
        return new Response(theme()->render('user-search.html',$res));
    }
    
    //检查是否登录
    public static function checkLogin(){
        
        return session()->get('admin') ? session()->get('admin') : null;
    }
    /**
     * 退出登录
     * @route /admin/logout
     * @access 
     * @return mixd 
     */

    public static function logout($request) {
        session()->delete('admin');
        return new RedirectResponse($request->getUriForPath('/admin/login'),'0','退出成功');
    }
    
    /**
     * @route /admin/user/password/{id}
     * @access admin_access
     * @param int  $id
     * @param string $password
     * @param string $re_password
     * @return json
     */
    public static function password($request){
        if ($request->post->getParameters()) {
            $id = $request->get('id');
            $password = $request->get('password');
            $re_password = $request->get('re_password');
            if (!$id) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>lang('非法操作'))),'200',
                            array('Content-Type'=>'application/json'));
            }
            
            if ($password != $re_password) {
                return new Response(json_encode(
                            array('status'=>'error' ,'msg'=>lang('两次输入不一致'))),'200',
                            array('Content-Type'=>'application/json'));
            } 
            
            $array = array(
                'id' => $id,
                'password' => $password,
            );
            Entity\Admin\Admin::update(entity_request($array));
            return new Response(json_encode(
                            array('status'=>'success' ,'msg'=>'成功')),'200',
                            array('Content-Type'=>'application/json'));
        }
        else {
            $id = $request->route->getParameter('id');
            if (!$id) {
                return new RedirectResponse($request->getUriForPath('/admin/uesr/search'),'2',
                        lang('非法操作'),array('Content-type'=>'text/html; charset=utf-8'));
            }
            $res['user']  = Entity\Admin\Admin::load(entity_request(array('id'=>$id)));
            $res['menus'] = \Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
            return new Response(theme()->render('user-password.html',$res));
        }
    }
    
    /**
     * @route /admin/upload
     * @access 
     * @param object  $Filedata
     * @return string
     */
    public static function upload($request,$filename='Filedata') {
        $savePath = dirname(dirname(__DIR__ )). '/cache/upload/images/' . date('Ymd');
        mkdir($savePath,0700,true);
        $file = $request->files->getParameter($filename);
        $ext = substr(strrchr($file['name'], "."), 1);
        $savePath = $savePath . "/" . date('Ymd') . "_" . random() . "." . $ext;
        if (!empty($file) && !empty($file['tmp_name'])) {
            if(!move_uploaded_file($file['tmp_name'], $savePath)) {
              copy($file['tmp_name'], $savePath);
            }
            return new Response(json_encode(
                        array('status'=>'success','msg'=>'ok','image'=>str_replace(dirname(dirname(__DIR__)),'',$savePath))),'200',
                        array('Content-Type'=>'application/json'));
        }
        return new Response(json_encode(
                        array('status'=>'error','msg'=>'ok','image'=>'')),'200',
                        array('Content-Type'=>'application/json'));
    }
     /**
     * 百度编辑器使用
     * @route /admin/upfile
     * @access 
     * @param object  $upfile
     * @return string
     */
    public static function upfile($request,$filename='upfile') {
        $savePath = dirname(dirname(__DIR__ )). '/cache/upload/images/' . date('Ymd');
        mkdir($savePath,0700,true);
        $file = $request->files->getParameter($filename);
        $ext = substr(strrchr($file['name'], "."), 1);
        $savePath = $savePath . "/" . date('Ymd') . "_" . random() . "." . $ext;
        if (!empty($file) && !empty($file['tmp_name'])) {
            if(!move_uploaded_file($file['tmp_name'], $savePath)) {
              copy($file['tmp_name'], $savePath);
            }
            $lastPath = str_replace(dirname(dirname(__DIR__)),'',$savePath);
            return new Response(json_encode(
                         array(                        
                            "state"     => 'SUCCESS',
                            "url"       => $lastPath,
                            "name"     => substr($lastPath, strrpos($lastPath, '/') + 1),
                            "originalName"  => $file['name'],
                            "type"      => strtolower(strrchr($file['name'], '.')),
                            "size"      => $file['size'],
                        )),'200',
                        array('Content-Type'=>'application/json'));
        }
        return new Response(json_encode(
                        array('status'=>'error','msg'=>'ok','image'=>'')),'200',
                        array('Content-Type'=>'application/json'));
    }
    
}
