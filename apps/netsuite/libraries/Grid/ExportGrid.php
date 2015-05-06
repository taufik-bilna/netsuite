<?php

namespace Ns\Netsuite\Libraries\Grid;

use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;

class ExportGrid extends AbstractGrid
{
    protected $_gridTitle = 'Export Status';

    /**
     * Initialize grid columns.
     *
     * @return array
     */
    protected function _initColumns()
    {
        $this
            ->addTextColumn('message_id', 'Message ID')
            ->addTextColumn('action', 'Operation')
            ->addTextColumn('entity_id', 'Entity ID')
            ->addDateRangeColumn('created', 'Created', ['use_between' => true, 'use_like' => false]);
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
            'Delete' => [
                'href' => ['for' => 'admin-export-status-delete', 'id' => $item['message_id']],
                'attr' => ['class' => 'grid-action-delete']
            ]
        ];

        //return [];
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
            //->columns(['m.message_id, SUBSTRING(m.body, 1, LOCATE(\'|\', m.body ) -1) as action, SUBSTRING(m.body, LOCATE(\'|\', m.body ) + 1, CHAR_LENGTH(m.body)) as entity_id, m.created'])
    		->columns(['m.message_id, m.action, m.entity_id, m.created'])
            ->where('queue_id = :queue_id:', array('queue_id'=> 2))
    		->orderBy('m.message_id DESC');

    	return $builder;
    }	
}