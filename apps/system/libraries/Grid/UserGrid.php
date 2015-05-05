<?php

namespace Ns\System\Libraries\Grid;

use Ns\System\Models\Admin\AdminUsers;
use Ns\System\Models\Admin\AdminRoles as Roles;
use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;

class UserGrid extends AbstractGrid
{
    protected $_gridTitle = 'Users List';

    /**
     * Initialize grid columns.
     *
     * @return array
     */
    protected function _initColumns()
    {
        $this
            ->addTextColumn('u.id', 'ID')
            ->addTextColumn('u.firstname', 'First Name')
            ->addTextColumn('u.lastname', 'Last Name')
            ->addTextColumn('u.username', 'Username')
            ->addTextColumn('u.username', 'Username')
            ->addTextColumn('u.email', 'Email', ['use_between' => false, 'use_like' => true])
            ->addDateRangeColumn('u.created', 'Created', ['use_between' => true, 'use_like' => false])
            ->addSelectColumn(
                'r.role_id',
                'Role',
                ['hasEmptyValue' => true, 'using' => ['role_id', 'role_name'], 'elementOptions' => Roles::find()],
                [
                    'use_having' => false,
                    'use_like' => false,
                    'output_action' =>
                        function (GridItem $item) {
                            return $item['r.role_name'];
                        }
                ]
            );
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
            'Edit' => ['href' => ['for' => 'admin-users-edit', 'id' => $item['u.id']]],
            'Delete' => [
                'href' => ['for' => 'admin-users-delete', 'id' => $item['u.id']],
                'attr' => ['class' => 'grid-action-delete']
            ]
        ];
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
    		->from(['u' => 'Ns\System\Models\Admin\AdminUsers'])
    		->columns(['u.*', 'r.*'])
    		->leftJoin('Ns\System\Models\Admin\AdminRoles', 'u.admin_role_id = r.role_id', 'r')
    		->orderBy('u.id DESC');

    	return $builder;
    }	
}