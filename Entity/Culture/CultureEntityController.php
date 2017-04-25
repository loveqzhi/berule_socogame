<?php

/**
 * @file
 *
 * CultureEntityController 
 */

namespace Entity\Culture;

use Pyramid\Component\Entity\EntityController;
use Entity;

class CultureEntityController extends EntityController {
    
    //@inherited attachLoad
    protected function attachLoad(&$query_entities) {
        parent::attachLoad($query_entities);
        foreach ($query_entities as $entity_id => $entity) {
            $this->assembleAuthor($entity);
        }
    }

    //获取作者
    protected function assembleAuthor($entity) {
        $entity->admin_name = Entity\Admin\Admin::loadUserNameById($entity->adminid);
    }

}
