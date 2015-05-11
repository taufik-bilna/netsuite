<?php

namespace Ns\Netsuite\Libraries\Grid;

use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;
use Ns\Netsuite\Libraries\Grid\Renderer\Xml;

class ApilogGrid extends AbstractGrid
{
    protected $_gridTitle = 'API Log';

    /**
     * Initialize grid columns.
     *
     * @return array
     */
    protected function _initColumns()
    {
        $this
            ->addTextColumn('id', 'ID')
            ->addTextColumn('request', 'Request',
                [
                    'output_action' =>
                        function (GridItem $item, $di, $column) {
                            return Xml::render($item, $di, $column);
                        }
                ]
             )
            ->addTextColumn('response', 'Response',
                [
                    'output_action' =>
                        function (GridItem $item, $di, $column) {
                            return Xml::render($item, $di, $column);
                        }
                ]
             )
            ->addTextColumn('operation', 'Operation')
            ->addDateRangeColumn('call_date', 'Call Date', ['use_between' => true, 'use_like' => false]);
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
    		->from(['a' => 'Ns\Netsuite\Models\NetsuiteApiLog'])
    		->columns(['a.*'])
    		->orderBy('a.id DESC');

    	return $builder;
    }	
}