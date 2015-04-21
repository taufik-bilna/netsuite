<?php

namespace Ns\Dashboard\Libraries\Grid;

use Ns\Dashboard\Models\Admin\AdminUsers;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\DI;
use Phalcon\DiInterface;

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
     * Get grid view name.
     *
     * @return string
     */
    public function getLayoutView()
    {
        return $this->_resolveView('partials/grid/layout', 'core');
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