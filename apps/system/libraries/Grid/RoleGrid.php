<?php

namespace Ns\System\Libraries\Grid;

//use Ns\System\Models\Admin\AdminUsers;
//use Ns\System\Models\Admin\AdminRoles as Roles;
use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;

class RoleGrid extends AbstractGrid
{
    protected $_gridTitle = 'Roles List';
    /**
     * Initialize grid columns.
     *
     * @return array
     */
    protected function _initColumns()
    {
        $this
            ->addTextColumn('role_id', 'ID')
            ->addTextColumn('role_name', 'Role Name');
    }

    /**
     * Get item action (Edit, Delete, etc).
     *
     * @param GridItem $item One item object.
     *
     * @return array
     */
    public function getItemActions(GridItem $item)
    {
        return [
            'Edit' => ['href' => ['for' => 'admin-roles-edit', 'id' => $item['role_id']]],
            /*'Delete' => [
                'href' => ['for' => 'admin-users-delete', 'id' => $item['u.id']],
                'attr' => ['class' => 'grid-action-delete']
            ]*/
        ];
        return [];
    }
    
	/**
     * Get main select builder.
     *
     * @return Builder
     */
    public function getSource()
    {
    	$builder = new Builder();
    	$builder
    		->from(['r' => 'Ns\System\Models\Admin\AdminRoles'])
    		->columns(['r.*'])
    		->orderBy('r.role_id DESC');

    	return $builder;
    }	
}