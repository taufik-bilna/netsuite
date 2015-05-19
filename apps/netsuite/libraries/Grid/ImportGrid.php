<?php

namespace Ns\Netsuite\Libraries\Grid;

use Phalcon\Mvc\Model\Query\Builder;
//use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;

class ImportGrid extends AbstractGrid
{
    /**
     * Grid id.
     *
     * @var string
     */
    protected $_id = 'data-table-import';

    /**
     * Grid identifier.
     *
     * @var string
     */
    protected $identifier = 'grid';

    /**
     * Rerieve grid URL
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getDI()->getUrl()->get('import');
    }
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
            ->addDateRangeColumn('created', 'Created');
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
            'View' => ['href' => ['for' => 'admin-import-status-view', 'id' => $item['message_id']]],
            'Delete' => [
                'href' => ['for' => 'admin-import-status-delete', 'id' => $item['message_id']],
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
            ->where('queue_id = :queue_id:', array('queue_id'=>1))
    		->orderBy('m.message_id DESC');

    	return $builder;
    }	
}