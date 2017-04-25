<?php

namespace Admin\Role;

use Pyramid\Component\HttpFoundation\Response;
use Pyramid\Component\HttpFoundation\RedirectResponse;
use Entity;
use Admin;

class Role {

    /**
     * 返回权限配置数组
     * @route 
     * @access
     * @param 
     * @return array
     */
    protected static function getPermissions(){
        return  array(
            '索乐动态' => array(
				'/admin/article/news' => array(
                        'title'         => '新闻动态',
                        'description'   => '新闻动态',
                        'module'        => 'article',
                        'quantity'      => '2',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/article/game' => array(
                        'title'         => '游戏资讯',
                        'description'   => '游戏资讯',
                        'module'        => 'article',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
			),
            '文化产品' => array(
                '/admin/culture/game/search' => array(
                        'title'         => '游戏产品',
                        'description'   => '游戏产品',
                        'module'        => 'culture',
                        'quantity'      => '1',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/culture/cartoon' => array(
                        'title'         => '动画产品',
                        'description'   => '动画产品',
                        'module'        => 'culture',
                        'quantity'      => '2',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/culture/music' => array(
                        'title'         => '音乐作品',
                        'description'   => '音乐作品',
                        'module'        => 'culture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/culture/caricature' => array(
                        'title'         => '图书绘本',
                        'description'   => '图书绘本',
                        'module'        => 'culture',
                        'quantity'      => '2',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/culture/other' => array(
                        'title'         => '更多产品',
                        'description'   => '更多产品',
                        'module'        => 'culture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
			),
            '招贤纳士' => array(
                '/admin/recruitment/search' => array(
                        'title'         => '在招岗位',
                        'description'   => '在招岗位',
                        'module'        => 'recruitment',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                /*
				'/admin/recruitment/talents' => array(
                        'title'         => '人才理念',
                        'description'   => '人才理念',
                        'module'        => 'recruitment',
                        'quantity'      => '2',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                */
				
			),
            '联系我们' => array(
                '/admin/contact/search' => array(
                        'title'         => '商务合作',
                        'description'   => '商务合作',
                        'module'        => 'contact',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
            ),
            '图片管理' => array(
                '/admin/picture/home' => array(
                        'title'         => '首页横幅',
                        'description'   => '首页横幅',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/picture/member' => array(
                        'title'         => '集团成员',
                        'description'   => '集团成员',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/picture/news' => array(
                        'title'         => '新闻栏目',
                        'description'   => '新闻栏目',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/picture/game' => array(
                        'title'         => '游戏产品',
                        'description'   => '游戏产品',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/picture/culture' => array(
                        'title'         => '文化产品',
                        'description'   => '文化产品',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/picture/partner' => array(
                        'title'         => '合作品牌',
                        'description'   => '合作品牌',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
                '/admin/picture/staff' => array(
                        'title'         => '员工风采',
                        'description'   => '员工风采',
                        'module'        => 'picture',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
            ),
			'管理员管理' => array(
				'/admin/user/search' => array(
                        'title'         => '用户列表',
                        'description'   => '更新地区',
                        'module'        => 'user',
                        'quantity'      => '1',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/user/add' => array(
                        'title'         => '添加用户',
                        'description'   => '添加用户',
                        'module'        => 'user',
                        'quantity'      => '2',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/user/edit' => array(
                        'title'         => '编辑用户',
                        'description'   => '编辑用户',
                        'module'        => 'user',
                        'quantity'      => '3',
                        'inherited'     => '',
                        'warning'       => '',
                ),
			),
            '角色管理' => array(                
                '/admin/role/search' => array(
                        'title'         => '角色列表',
                        'description'   => '更新角色',
                        'module'        => 'role',
                        'quantity'      => '1',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/role/add' => array(
                        'title'         => '添加角色',
                        'description'   => '更新角色',
                        'module'        => 'role',
                        'quantity'      => '1',
                        'inherited'     => '',
                        'warning'       => '',
                ),
				'/admin/role/edit' => array(
                        'title'         => '编辑角色',
                        'description'   => '更新角色',
                        'module'        => 'role',
                        'quantity'      => '1',
                        'inherited'     => '',
                        'warning'       => '',
                ),
            ),
        );
    }
    
    
    /**
     * 获取扁平化权限数组
     * @route 
     * @access 
     * @return array
     */
    public static function getAllPermissions() {
        $tempPermissions = array();
		foreach (self::getPermissions() as $v) {
			$tempPermissions = array_merge($tempPermissions,$v);
		}
        return $tempPermissions;
    }
    
    /**
     * 更新用户角色
     * @route
     * @access
     * @param $param 角色ID数组
     * @param $id   用户ID
     * @return boolean
     */
    public static function updateAdminRoleById($param,$id) {
        //删除原角色
        $thisdb = db_transaction(); //开启事务
        try {
            db_delete("relation_admin_roles")
                ->condition("id",$id)
                ->execute();
            foreach($param as $v) {
                db_insert("relation_admin_roles")
                    ->fields(array('id'=>$id,'rid'=>$v))
                    ->execute();
            }
        } catch (Exception $e) {
            $thisdb->rollback(); //回滚
            logger()->warn("更新用户角色失败了: ".$e->getMessage());
        }
        
        return true;
    }
    
    /**
     * 角色列表
     * @route /admin/role/search
     * @param int $page
     * @param int $size
     * @ return array
     */
    public static function search($request) {
        
        $res = array(
            'menus' => Admin\Menu\Menu::getMenu($request->route->get('path'))[0],
            'list'  => Entity\Role\Role::search($request),
        );
		
        return new Response(theme()->render('role.html',$res));  
    }
    
    /**
     * 添加角色权限
     * @route /admin/role/add
     * @param $request
     * @return mixed
     */
    public static function add ($request) {
        //判断权限 todo
                
        $temproles = self::getAllPermissions();       
        if ($request->post->getParameters()) {
            $post_data = $request->getParameters();
            if (empty($post_data['name'])) {
                return new Response(json_encode(
                                array('status'=>'error','msg'=>'角色名称必须填写')),'200',
                                array('Content-Type'=>'application/json'));
            }
            if (!empty($post_data['field_role_permission'])) {
                foreach ($post_data['field_role_permission'] as $k => $v) {
                    if (isset($temproles[$v])) {
                        $post_data['field_role_permission'][$k] = array('permission'=>$v,'data'=>serialize($temproles[$v]));
                    } else {
                        unset($post_data['field_role_permission'][$k]);
                    }
                }
            }
            Entity\Role\Role::insert(entity_request($post_data));
            return new Response(json_encode(
                                array('status'=>'success','msg'=>'ok')),'200',
                                array('Content-Type'=>'application/json'));
        }
        else {
            $res['temproles'] = self::getPermissions();
            $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0]; 
            return new Response(theme()->render('role-add.html',$res));
        }
    }
    /**
     * 编辑角色权限
	 * @route /admin/role/edit/{rid}
	 * @access
	 * @param $request 
	 * @return redirect
	 */
	public static function edit($request) {
        //判断权限 todo
        
        $rid = (int)$request->route->getParameter('rid');
        $res['role'] = Entity\Role\Role::load(entity_request(array('rid'=>$rid)));
        if (empty($res['role'])) {
            return new RedirectResponse($request->getUriForPath('/admin/role/search'),'2',
                        lang('非法操作'),array('Content-type'=>'text/html; charset=utf-8'));
        }

        $res['temproles'] = self::getPermissions();
        $res['menus'] = Admin\Menu\Menu::getMenu($request->route->get('path'))[0];
        return new Response(theme()->render('role-edit.html',$res));
    
    }
    
    /**
     * 更新角色权限
	 * @route /admin/role/update
	 * @access
	 * @param $request 
	 * @return redirect
	 */
	public static function update($request) {
		$tempPerms = self::getAllPermissions();
		$post_data = $request->getParameters();
		if (!empty($post_data['rid'])) {
			$array['rid'] = (int) $post_data['rid'];
            $array['name'] = trim($post_data['name']);
            $array['weight'] = (int)$post_data['weight'];
			foreach ($post_data['field_role_permission'] as $key) {
				if (isset($tempPerms[$key])) {
					$array['field_role_permission'][] = array('permission'=>$key,'data'=>serialize($tempPerms[$key]));
				}
			}
			Entity\Role\Role::update(entity_request($array));
            return new Response(json_encode(
                                array('status'=>'success','msg'=>'ok')),'200',
                                array('Content-Type'=>'application/json'));
		}
        else {
            return new Response(json_encode(
                                array('status'=>'error','msg'=>lang('非法操作'))),'200',
                                array('Content-Type'=>'application/json'));
        }

	}
    
}