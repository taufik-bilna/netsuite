<?php

namespace Ns\Dashboard\Libraries\Grid;

use Ns\Dashboard\Models\Admin\AdminUsers;
use Ns\Dashboard\Models\Admin\AdminRoles as Roles;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\DI;
use Phalcon\DiInterface;
use Phalcon\Db\Column;
use Ns\Core\Libraries\Form\Element\Text;
use Ns\Core\Libraries\Form\Element\Select;
use Ns\Core\Libraries\Form\Element\DateRange;
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
//error_log("\ngdf".json_encode($source->getPhql()), 3, '/tmp/phalcon.log');  
        $this->_applyFilter($source);
        $this->_applySorting($source);
        /**
         * Paginator.
         */
var_dump($source->getPhql());        
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
     * Apply filter data on array.
     *
     * @param Builder $source Data.
     *
     * @return array
     */
    protected function _applyFilter(Builder &$source)
    {
        $data = json_decode(base64_decode($this->_getParam('filter')), true);
//error_log("\n".print_r(json_encode(base64_decode($data)),1), 3, '/tmp/bilnaNs.log');
error_log("\ndata ".print_r($data,1), 3, '/tmp/bilnaNs.log');
        $i=0;
		foreach ($this->getColumns() as $name => $column)
		{
//error_log("\nhhhhhhhh".print_r(array_values($data['u.created']), 1), 3, '/tmp/bilnaNs.log');
//error_log("\ncolumn ".print_r($column, 1), 3, '/tmp/bilnaNs.log');
            if($i=0) $where = 'where';
            else $where = 'andWhere';
            // Can't use empty(), coz value can be '0'.
            if (!isset($data[$name]) || $data[$name] == '')
            {
                continue;
            }

            $conditionLike = !isset($column['use_like']) || $column['use_like'];
            $conditionBetween = !isset($column['use_between']) || $column['use_between'];

            if (!empty($column['use_having']))
            {
                if ($conditionLike)
                {
                    $value = '%' . $data[$name] . '%';
                } else {
                    $value = $data[$name];
                }
                if (isset($column['type'])) {
                    $value = $this->getDI()
                        ->getDb()
                        ->getInternalHandler()
                        ->quote($value, $column['type']);
                }
                if ($conditionLike) {
                    $source->having($name . ' LIKE ' . $value);
                } else {
                    $source->having($name . ' = ' . $value);
                }
            }elseif(!empty($column['use_between'])){ 

                $from = '31-12-1970';
                $to = '31-12-9999';
                foreach($data[$name] as $between){
error_log("\nbetween ".print_r($between,1), 3, '/tmp/bilnaNs.log');                              
                    if(isset($between['from']))
                        $from = $between['from'];
                    if(isset($between['to']))
                        $to = $between['to'];
                }
                $arrFrom = explode("/", $from);
                $arrTo = explode("/", $to);
error_log("\narrFrom ".$from, 3, '/tmp/bilnaNs.log');                              

error_log("\ntest ".$arrFrom[2].'-'.$arrFrom[0].'-'.$arrFrom[1], 3, '/tmp/bilnaNs.log');                                                  
                //$source->$where($name . ' > :' .$alias . '_from AND ' . $name . ' < :' .$alias . '_to', [$alias.'_from' => $from, $alias.'_to' => $to]);
                $source->$where($name . ' > :' .$alias . '_from:', [$alias.'_from' => $arrFrom[2].'-'.$arrFrom[0].'-'.$arrFrom[1]]);
                $source->$where($name . ' < :' .$alias . '_to:', [$alias.'_to' => $arrTo[2].'-'.$arrTo[0].'-'.$arrTo[1]]);

            }else {
            	$bindType = null;
                $alias = str_replace('.', '_', $name);
                if (isset($column['type'])) {
                    $bindType = [$alias => $column['type']];
                }
error_log("\n".$name . ' LIKE :' . $alias . ': use like ' .$conditionLike . ' use between '.$conditionBetween, 3, '/tmp/bilnaNs.log');      
//error_log("\n".$data[$name], 3, '/tmp/bilnaNs.log');                
//error_log("\n".print_r($bindType,1), 3, '/tmp/bilnaNs.log');                
                if ($conditionLike) {
                    //$source->$where($name . ' LIKE :' . $alias . ':', [$alias => '%' . $data[$name] . '%'], $bindType);
                    $source->$where($name . ' LIKE :' . $alias . ':', [$alias => '%' . $data[$name] . '%']);
                } else{                      
                    $source->$where($name . ' = :' . $alias . ':', [$alias => $data[$name]], $bindType);
                }

            }
            $i++;
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
        $sort = json_decode(base64_decode($this->_getParam('sort')),true);
        $direction = json_decode(base64_decode($this->_getParam('direction', 'DESC')), true);
error_log("\nsort ".$sort, 3, '/tmp/bilnaNs.log');
error_log("\ndirection ".$direction, 3, '/tmp/bilnaNs.log');
        // Additional checks.
        if (!$sort || ($direction != 'DESC' && $direction != 'ASC')) {
error_log("\nreturn ", 3, '/tmp/bilnaNs.log');
            return;
        }

        $source->orderBy(sprintf('%s %s', $sort, $direction));
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

    public function addDateRangeColumn($id, $label, array $params = [])
    {
        $this->_columns[$id] = $this->_getDefaultColumnParams($params, $label);
        
        if (!empty($this->_columns[$id]['filter'])) {
            $this->_columns[$id]['filter'] = new DateRange($id);
        }

        return $this;
    }
    /**
     * Add column to grid with select filter.
     *
     * @param int    $id      Column id.
     * @param string $label   Column label.
     * @param array  $options Select options
     * @param array  $params  Column params.
     *
     * @return $this
     */
    public function addSelectColumn(
        $id,
        $label,
        array $options,
        array $params = []
    )
    {
        $this->_columns[$id] = $this->_getDefaultColumnParams($params, $label);

        if (!empty($this->_columns[$id]['filter']))
        {
			$element = new Select($id);
            foreach ($options as $key => $value) {
                $element->setOption($key, $value);
            }
            $this->_columns[$id]['filter'] = $element;
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
//error_log("\nitem get ".json_encode($this->_paginator), 3, '/tmp/phalcon.log');
        $items = [];
        foreach ($this->_paginator->items as $item) {
//error_log("\nitem".json_encode($item), 3, '/tmp/phalcon.log');                
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
     * Get main select builder.
     *
     * @return Builder
     */
    public function getSource()
    {
    	$builder = new Builder();
    	$builder
    		->from(['u' => 'Ns\Dashboard\Models\Admin\AdminUsers'])
    		//->addFrom('Ns\Dashboard\Models\Admin\AdminUsers', 'u')
    		->columns(['u.*', 'r.*'])
    		//->columns(['u.*'])    		
    		->leftJoin('Ns\Dashboard\Models\Admin\AdminRoles', 'u.admin_role_id = r.role_id', 'r')
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