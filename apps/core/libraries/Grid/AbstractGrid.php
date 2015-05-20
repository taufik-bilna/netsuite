<?php

namespace Ns\Core\Libraries\Grid;

use Phalcon\Mvc\View;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\DI;
use Phalcon\DiInterface;

class AbstractGrid 
{
	   /**
     * View object.
     *
     * @var View
     */
    protected $_view;

    /**
     * Response object.
     *
     * @var ResponseInterface
     */
    protected $_response;

    /**
     * Grid columns.
     *
     * @var array
     */
    protected $_columns;

    /**
     * Grid title.
     *
     * @var string
     */
    protected $_gridTitle;
	
    /**
     * Create grid.
     *
     * @param ViewInterface $view View object.
     * @param DIBehaviour   $di   DI object.
     */
    public function __construct(ViewInterface $view)
    {
        $this->_view = $view;
        $this->_id = $this->_id . 'grid';
        $this->_view->{$this->identifier} = $this;

        $source = $this->getSource();

        $this->_applyFilter($source);
        $this->_applySorting($source);

        /**
         * Paginator.
         */
        $limit = $this->getDI()->getRequest()->getQuery('iDisplayLength', null, 10);
        $page = ($this->getDI()->getRequest()->getQuery('iDisplayStart', null, 1) / $limit ) + 1;
        $paginator = new QueryBuilder(
            [
                "builder" => $source,
                "limit" => $limit,
                "page" => $page
            ]
        );

        $this->_paginator = $paginator->getPaginate();

        if( $this->getDI()->getRequest()->isAjax() )
        {
            $view->disable();
            $this->_response = $this->getDI()->getResponse();
            $this->_response->setContentType('application/json', 'UTF-8');
            $this->_response->setContent(json_encode(
                array(
                    "sEcho" => $this->getDI()->getRequest()->getQuery('sEcho', null, 1),
                    "iTotalRecords" => $this->_paginator->total_items,
                    "iTotalDisplayRecords" => $this->_paginator->total_items,
                    "aaData" => $this->getItems()
                )
            ));
        }

    }

    public function getId()
    {
        return $this->_id;
    }

    /**
     * Apply filter data on array.
     *
     * @param Builder $source Data.
     *
     * @return array
     */
    protected function _applyFilter(Builder &$source)
    {
        $sSearch = $this->getDI()->getRequest()->getQuery('sSearch');
        if( isset($sSearch) && $sSearch != '' )
        {
            foreach ($this->getColumns() as $key => $column)
            {
                if($column['type'] == 'date-range' ) continue;                
                $alias = str_replace('.', '_', $column['colname']);
                $bSearchable = 'bSearchable_'.$key;
                $$bSearchable = $this->getDI()->getRequest()->getQuery($bSearchable); 
                if( isset($$bSearchable) && $$bSearchable == "true" )
                {
                    $source->orWhere($column['colname'] . ' LIKE :' . $alias . ':', [$alias => '%' . $sSearch . '%']);
                }
            }
        }
        foreach ($this->getColumns() as $key => $column)
        {
            $alias = str_replace('.', '_', $column['colname']);
            $sSearch = 'sSearch_'.$key;
            $bSearchable = 'bSearchable_'.$key;
            $$bSearchable = $this->getDI()->getRequest()->getQuery($bSearchable);
            $$sSearch = $this->getDI()->getRequest()->getQuery($sSearch);

            if( isset($$bSearchable) && $$bSearchable == "true" && $$sSearch != '' && $column['type'] != 'date-range' )
            {
                $source->where($column['colname'] . ' LIKE :' . $alias . ':', [$alias => '%' . $$sSearch . '%']);
            }elseif( isset($$bSearchable) && $$bSearchable == "true" && $$sSearch != '' && $column['type'] == 'date-range' ){
                $dateRangeArr = explode("~", trim($$sSearch));
                if( !empty($dateRangeArr[0]) )
                    $source->where($column['colname'] . ' > :' . $alias . '_from:', [$alias.'_from' => $dateRangeArr[0]]);
                if( !empty($dateRangeArr[1]) )
                    $source->where($column['colname'] . ' < :' . $alias . '_to:', [$alias.'_to' => $dateRangeArr[0]]);
            }
        }

    }

    /**
     * Apply sorting data on array.
     *
     * @param Builder $source Data.
     *
     * @return array|void
     */
    protected function _applySorting(Builder &$source)
    {
        $iSortCol_0 = $this->getDI()->getRequest()->getQuery('iSortCol_0');
        if( isset($iSortCol_0) )
        {
            $iSortingCols = $this->getDI()->getRequest()->getQuery('iSortingCols');

            for( $i=0; $i<intval($iSortingCols); $i++ )
            {
                $iSortCol = intval($this->getDI()->getRequest()->getQuery('iSortCol_'.$i));
                $bSortable = $this->getDI()->getRequest()->getQuery('bSortable_'.intval($iSortCol));
                if( $bSortable == "true" )
                {
                    $sort = $this->_columns[$iSortCol]['colname'];
                    $sSortDir = $this->getDI()->getRequest()->getQuery('sSortDir_'.$i);
                    $direction = ($sSortDir =='asc' ? 'asc' : 'desc');
                    //$source->orderBy(sprintf('%s %s', $sort, $direction));
                    $orderBy[] = sprintf('%s %s', $sort, $direction);
                }
            }

            $source->orderBy(implode(",", $orderBy));
        }
    }

    /**
     * Get current grid items.
     *
     * @return AbstractModel[]
     */
    public function getItems()
    {
        $items = [];
        foreach ($this->_paginator->items as $item) {
            //$keys = array_keys($item->toArray());
            //$values = array_values($item->toArray());
            $data = $item->toArray();

            foreach( $this->getColumns() as $column)
            {
                if( isset($column['renderer']) )
                {
                    $data[$column['colname']] = $column['renderer']($item->toArray(), $column);
                }
            }
            $items[] = array_values($data);
        }

        return $items;
    }

    public function addDateRangeColumn($id, $label, array $params = [])
    {
        $this->_columns[] = $this->_getDefaultColumnParams($id, array_merge($params,['type'=>'date-range']), $label);

        return $this;
    }

    /**
     * Add column to grid.
     *
     * @param int    $id     Column id.
     * @param string $label  Column label.
     * @param array  $params Column params.
     *
     * @return $this
     */
    public function addTextColumn($id, $label, array $params = [])
    {
        $this->_columns[] = $this->_getDefaultColumnParams($id, array_merge($params,['type'=>'text']), $label);

        return $this;
    }

    public function addSelectColumn($id, $label, $options, array $params = [])
    {
        $values = [];
        foreach ($options as $key => $value) {
            $values[] = ['value' => $key, 'label' => $value];
        }

        $this->_columns[] = $this->_getDefaultColumnParams(
            $id, 
            array_merge($params,['type'=>'select', 'value' => $values]), 
            $label
        );

        return $this;
    }

    public function getColumns()
    {
        if (!$this->_columns) {
            $result = $this->_initColumns();
            if (is_array($result)) {
                $this->_columns = $result;
            }
        }

        return $this->_columns;
    }

    /**
     * Render grid.
     *
     * @param string $viewName Name of the view file.
     *
     * @return string
     */
    public function render($viewName = null)
    {
        if (!$viewName) {
            $viewName = $this->getLayoutView();
        }
        /** @var View $view */
        $view = $this->getDI()->get('view');
        ob_start();
        $view->partial($viewName, ['grid' => $this]);
        $html = ob_get_contents();
        ob_end_clean();

        if ($this->getDI()->getRequest()->isAjax()) {
            $view->setContent($html);
        }

        return $html;
    }

    /**
     * Get grid view name.
     *
     * @return string
     */
    public function getLayoutView()
    {
        return $this->_resolveView('partials/grid/layout', 'core');
    }

    /**
     * Get grid table body view name.
     *
     * @return string
     */
    public function getTableBodyView()
    {
        return $this->_resolveView('partials/grid/body', 'core');
    }

    /**
     * Resolve view.
     *
     * @param string $view   View path.
     * @param string $module Module name (capitalized).
     *
     * @return string
     */
    protected function _resolveView($view, $module = 'Core')
    {
        return '../../' . $module . '/views/' . $view;
    }

    /**
     * Get grid title.
     *
     * @return string
     */
    public function getGridTitle()
    {
        return $this->_gridTitle;
    }

    /**
     * Get request param.
     *
     * @param string $name    Param name.
     * @param mixed  $default Default value for param.
     *
     * @return mixed
     */
    protected function _getParam($name, $default = null)
    {
        return $this->getDI()->getRequest()->get($name, null, $default);
    }

    /**
     * Get DI.
     *
     * @return DIBehaviour|DI
     */
    public function getDI()
    {
        return DI::getDefault();
    }

    /**
     * Set default data to params.
     *
     * @param array  $params Columns params.
     * @param string $label  Columns label.
     *
     * @return array
     */
    protected function _getDefaultColumnParams($colname, $params, $label)
    {
        return array_merge(
            [
                'label' => $label,
                'colname' => $colname
            ],
            $params
        );
    }
    
}