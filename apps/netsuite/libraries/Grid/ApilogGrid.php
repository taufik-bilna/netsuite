<?php

namespace Ns\Netsuite\Libraries\Grid;

use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;
use Ns\Netsuite\Libraries\Grid\Renderer\Xml;

class ApilogGrid extends AbstractGrid
{
    /**
     * Grid id.
     *
     * @var string
     */
    protected $_id = 'example-data-table';

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
        return $this->getDI()->getUrl()->get('apilog');
    }
    
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
                    'renderer' =>
                        function ($item, $column) {
                            return Xml::render($item, $column);
                        }
                ]
             )
            ->addTextColumn('response', 'Response',
                [
                    'renderer' =>
                        function ($item, $column) {
                            return Xml::render($item, $column);
                        }
                ]
             )
            ->addTextColumn('operation', 'Operation')
            ->addDateRangeColumn('call_date', 'Call Date');
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