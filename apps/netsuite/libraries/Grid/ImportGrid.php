<?php

namespace Ns\Netsuite\Libraries\Grid;

use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;

class ImportGrid extends AbstractGrid
{
    protected $_gridTitle = 'Import Status';

    /**
     * Initialize grid columns.
     *
     * @return array
     */
    protected function _initColumns()
    {
        $this
            ->addTextColumn('message_id', 'Message ID')
            ->addTextColumn('body', 'Operation')
            ->addTextColumn('body', 'Entity ID')
            ->addDateRangeColumn('u.created', 'Created', ['use_between' => true, 'use_like' => false]);
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
        /*return [
            'Edit' => ['href' => ['for' => 'admin-users-edit', 'id' => $item['u.id']]],
            'Delete' => [
                'href' => ['for' => 'admin-users-delete', 'id' => $item['u.id']],
                'attr' => ['class' => 'grid-action-delete']
            ]
        ];*/

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
    		->from(['m' => 'Ns\Netsuite\Models\Message'])
    		->columns(['*'])
            ->where('queue_id = :queue_id:', array('queue_id'=>1))
    		->orderBy('m.message_id DESC');

    	return $builder;
    }	
}