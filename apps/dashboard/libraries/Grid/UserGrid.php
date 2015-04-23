<?php

namespace Ns\Dashboard\Libraries\Grid;

use Ns\Dashboard\Models\Admin\AdminUsers;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\DI;
use Phalcon\DiInterface;
use Phalcon\Db\Column;
use Ns\Core\Libraries\Form\Element\Text;
use Ns\Core\Libraries\Grid\GridItem;

class UserGrid
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
     * Paginator.
     *
     * @var \stdClass
     */
    protected $_paginator;

    /**
     * Grid columns.
     *
     * @var array
     */
    protected $_columns;

	/**
     * Create grid.
     *
     * @param ViewInterface $view View object.
     * @param DIBehaviour   $di   DI object.
     */
    public function __construct(ViewInterface $view, $di = null)
    {
    	$this->_view = $view;
        $this->_view->grid = $this;

        $source = $this->getSource();

        //$this->_applyFilter($source);
        /**
         * Paginator.
         */
        $paginator = new QueryBuilder(
            [
                "builder" => $source,
                "limit" => 10,
                "page" => 1
            ]
        );
        $this->_paginator = $paginator->getPaginate();
        
        if($this->getDI()->getRequest()->isAjax())
        {
        	$view->disable();
        	$this->_response = $this->getDI()->getResponse();
        	$this->_response->setContent($this->render($this->getTableBodyView()));
        }
    }

    /**
     * Initialize grid columns.
     *
     * @return array
     */
    protected function _initColumns()
    {
        $this
            ->addTextColumn('u.username', 'Username')
            ->addTextColumn('u.email', 'Email');
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
        $this->_columns[$id] = $this->_getDefaultColumnParams($params, $label);

        if (!empty($this->_columns[$id]['filter'])) {
            $this->_columns[$id]['filter'] = new Text($id);
        }
        return $this;
    }

    /**
     * Get grid columns.
     *
     * @return array
     */
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
     * Set default data to params.
     *
     * @param array  $params Columns params.
     * @param string $label  Columns label.
     *
     * @return array
     */
    protected function _getDefaultColumnParams($params, $label)
    {
        return array_merge(
            [
                'label' => $label,
                'type' => Column::BIND_PARAM_INT,
                'filter' => true,
                'sortable' => true
            ],
            $params
        );
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
     * Grid has filter form?
     *
     * @return bool
     */
    public function hasFilterForm()
    {
        return true;
    }

    /**
     * Get grid item view name.
     *
     * @return string
     */
    public function getItemView()
    {
        return $this->_resolveView('partials/grid/item', 'core');
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
     * Get grid view name.
     *
     * @return string
     */
    public function getLayoutView()
    {
        return $this->_resolveView('partials/grid/layout', 'core');
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
            $items[] = new GridItem($this, $item);
        }
        return $items;
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
     * Apply filter data on array.
     *
     * @param Builder $source Data.
     *
     * @return array
     */
    protected function _applyFilter(Builder $source)
    {

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
    		->from(['u' => 'Ns\Dashboard\Models\Admin\AdminUsers'])
    		->columns(['u.*'])
    		->orderBy('u.id DESC');

    	return $builder;
    }

    /**
     * Returns response object if grid has something to say =)... (has it's own response).
     *
     * @return null|ResponseInterface
     */
    public function getResponse()
    {
        return $this->_response;
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
/*debug('test');
debug($viewName);die;        */
        ob_start();
        $view->partial($viewName, ['grid' => $this, 'paginator' => $this->_paginator]);
        $html = ob_get_contents();
        ob_end_clean();
//debug($html);die;
        if ($this->getDI()->getRequest()->isAjax()) {
            $view->setContent($html);
        }

        return $html;
    }	
}