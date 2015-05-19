<?php

namespace Ns\Netsuite\Libraries\Grid;

use Phalcon\Mvc\Model\Query\Builder;
use Ns\Core\Libraries\Grid\GridItem;
use Ns\Core\Libraries\Grid\AbstractGrid;

class ChangelogGrid extends AbstractGrid
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
        return $this->getDI()->getUrl()->get('changelog');
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
            ->addTextColumn('internal_id', 'Identifier')
            ->addTextColumn('comment', 'Comment')
            ->addDateRangeColumn('created_date', 'Created At', ['use_between' => true, 'use_like' => false]);
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
                'href' => ['for' => 'admin-changelog-delete', 'id' => $item['id']],
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
    		->from(['c' => 'Ns\Netsuite\Models\NetsuiteChangelog'])
    		->columns(['c.*'])
    		->orderBy('c.id DESC');

    	return $builder;
    }	
}