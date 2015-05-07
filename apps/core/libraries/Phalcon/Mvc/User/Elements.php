<?php

namespace Ns\Core\Libraries\Phalcon\Mvc\User;

use Phalcon\Mvc\User\Component;

class Elements extends Component
{
	private $_headerMenu = array(
		'dashboard' => array(
			'sub-menu' => array(
				'caption' => 'Dashboard',
				'action'  => 'dashboard',
				'icon'    => 'icon-dashboard'
			)
		),
        'system' => array(
            'sub-menu' => array(
                'caption' => 'System',
                'action' => null,
                'icon'   => 'icon-sitemap',
                'sub'  => array(
                	'configuration' => array(
                		'caption' => 'Configuration',
                		'action'  => 'javascript:;'
                	),
                	'permission' => array(
                		'caption' => 'Permission',
                		'action'  => 'javascript:;',
                		'sub-menu'	  => array(
                			'users' => array(
                				'caption' => 'Users',
                				'action'  => 'users'
                			),
                			'roles' => array(
                				'caption' => 'Roles',
                				'action'  => 'roles'
                			)
                		)
                	)
                )
            )
        ),
        'netsuite' => array(
        	'sub-menu' => array(
        		'caption' => 'Netsuite',
        		'action'  => null,
        		'icon'    => 'icon-cogs',
        		'sub'	  => array(
        			'import' => array(
        				'caption' => 'Import Status',
        				'action'  => 'import'
        			),
        			'export' => array(
        				'caption' => 'Export Status',
        				'action'  => 'export'
        			),
                    'log' => array(
                        'caption' => 'Log',
                        'action'  => 'javascript:;',
                        'sub-menu'=> array(
                            'api' => array(
                                'caption' => 'API Log',
                                'action'  => 'apilog'
                            ),
                            'changelog' => array(
                                'caption' => 'Change Log',
                                'action'  => 'changelog'
                            ),
                            'general' => array(
                                'caption' => 'General Log',
                                'action'  => 'general-log'
                            )
                        )
                    )
        		)
        	)
        )
    );

	/**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        /*$auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = array(
                'caption' => 'Log Out',
                'action' => 'end'
            );
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }*/
        $namespaceName = $this->dispatcher->getNamespaceName();
        $moduleName = $this->router->getModuleName();
        $controllerName = $this->view->getControllerName();
        $namespaceNameArr = explode("\\", $namespaceName); 
        $nsMenu = count($namespaceNameArr) - 1;
//debug(explode("\\",$namespaceName));
        foreach ($this->_headerMenu as $keyMenu => $valMenu)
        {
        	$classActive = '';
        	if( strtolower($moduleName) == strtolower($keyMenu) ) $classActive = 'class="active"';
			foreach($valMenu as $position => $menu)
			{
//
	        	echo '<li class="'.$position.'">';
	        	echo '<a href="'.$menu['action'].'" '.$classActive.'>
	                          <i class="'.$menu['icon'].'"></i>
	                          <span>'.$menu['caption'].'</span>
	                      </a>';
	            if( isset($menu['sub']) )
	            {

	            	echo '<ul class="sub">';
	            	foreach ($menu['sub'] as $key => $value) {
	            		$class = '';
	            		if( isset($value['sub-menu']) ) $class='class="sub-menu"';

	            		$clsAction = '';
	            		if( strtolower($key) == strtolower($namespaceNameArr[$nsMenu]) ) $clsAction = 'class="active"';
                        elseif( strtolower($key) == strtolower($controllerName) ) $clsAction = 'class="active"';
//echo ($key);
//echo ($controllerName);
	            		echo '<li '.$class.$clsAction.'><a href="'.$value['action'].'" '.$clsAction.'>'.$value['caption'].'</a>';

	            		if( isset($value['sub-menu']) )
	            		{	
//debug($value);
	            			//if( isset() )
	            			echo '<ul class="sub">';
	            			foreach ($value['sub-menu'] as $keySub => $valueSub) {
	            				//echo '<li class="active"><a href="'.$valueSub['action'].'">'.$valueSub['caption'].'</a></li>';
	            				$classKeySub = '';
	            				if( strtolower($keySub) == strtolower($controllerName) ) $classKeySub = 'class="active"';
	            				echo '<li '.$classKeySub.'><a href="'.$valueSub['action'].'">'.$valueSub['caption'].'</a></li>';
	            			}
	            			echo '</ul>';
	            		}
	            	}
	            	echo '</li></ul>';
	            }
	            echo '</li>';
        	}
            /*echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';*/
        }
//die;
    }

    /*protected function setAttribute($name, $value)
    {
    	parent::setAttribute($name, $value);
    }*/
}