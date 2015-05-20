<?php

namespace Ns\Netsuite\Libraries\Grid;


use Phalcon\DI;
use Phalcon\DiInterface;
//use Phalcon\Mvc\View;
//use Phalcon\Mvc\ViewInterface;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Paginator\Adapter\QueryBuilder;
//use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;
use Ns\Netsuite\Libraries\Grid\Renderer\Xml;

class Apilogtest2Grid extends AbstractGrid
{
    /**
     * Grid id.
     *
     * @var string
     */
    protected $_id = 'data-table-api-log';

    /**
     * Grid identifier.
     *
     * @var string
     */
    protected $identifier = 'imports';

    /**
     * Rerieve grid URL
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getDI()->getUrl()->get('apilogtestgrid');
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
            ->addTextColumn('action', 'Action')
            ->addDateRangeColumn('created_date', 'Created Date')
            ->addTextColumn('internal_id', 'Internal ID')
            ->addTextColumn('comment', 'Comment'/*,
                [
                    'renderer' =>
                        function ($item, $column) {
                            return Xml::render($item, $column);
                        }
                ]*/
            );
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
            ->from(['c' => 'Ns\Netsuite\Models\NetsuiteChangelog'])
            ->columns(['c.*'])
            ->orderBy('c.id DESC');

        return $builder;
    }
}