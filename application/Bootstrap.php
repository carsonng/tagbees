<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload(){
        Zend_Controller_Action_HelperBroker::addPrefix('Helper');

        Zend_Layout::startMvc(APPLICATION_PATH . '/layouts');
        Zend_Layout::getMvcInstance()->setLayout('1-col-left');

        $documentType = new Zend_View_Helper_Doctype();
        $documentType->doctype('XHTML5');


        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);
    }
    
    protected function _initModules(){
        $this->bootstrap("frontController");
        $front = $this->getResource("frontController");
        $front->setParam('useDefaultControllerAlways', true);
        $front->addModuleDirectory(APPLICATION_PATH .'/modules');

        //add the global helper + scripts directory path
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->initView();
        $viewRenderer->view->addHelperPath(APPLICATION_PATH .'/views/helpers');
        $viewRenderer->view->addScriptPath(APPLICATION_PATH .'/views/scripts');
    }
    
    protected function _initTimezone(){
        date_default_timezone_set("Asia/Hong_Kong");
    }
    
    protected function _initConfig()
    {
        $config_ini = new Zend_Config($this->getOptions(), true);
        Zend_Registry::set('config_ini', $config_ini);
        
       
       $display_lang = Common::getSiteDisplayLang();
       $translate = new Zend_Translate('csv', APPLICATION_PATH . '/configs/lang/'.$display_lang.'.csv', $display_lang);
       $translate->setLocale($display_lang);
       Zend_Registry::set('Zend_Translate', $translate);
       
       Zend_Registry::set('config', new Zend_Config(require APPLICATION_PATH . '/configs/config.php'));
       
       //Zend_Registry::set('feed_input_prefix', Zend_Registry::get('config_ini')->html->feed_inputs->prefix);
       
    }
    
    protected function _initRouter(){
        $router  = Zend_Controller_Front::getInstance()->getRouter();

        $route = new Zend_Controller_Router_Route_Regex(
            'user/(.+)',
            array(
                'controller'=>'user',
                'action'=>'index'
            ),
            array(
                1=>'username'
            )
        );
        $router->addRoute('user', $route);

        $route = new Zend_Controller_Router_Route_Regex(
            'user/(.+)/bookmark',
            array(
                'controller'=>'user',
                'action'=>'bookmark'
            ),
            array(
                1=>'username'
            )
        );
        $router->addRoute('user_bookmark', $route);

        $route = new Zend_Controller_Router_Route_Regex(
            'user/(.+)/bookmark-log',
            array(
                'controller'=>'user',
                'action'=>'bookmark-log'
            ),
            array(
                1=>'username'
            )
        );
        $router->addRoute('user_bookmark_log', $route);

        $route = new Zend_Controller_Router_Route_Regex(
            'user/(.+)/interest',
            array(
                'controller'=>'user',
                'action'=>'interest'
            ),
            array(
                1=>'username'
            )
        );
        $router->addRoute('user_interest', $route);

        $route = new Zend_Controller_Router_Route_Regex(
                'edit/(.+)',
                array(
                        'controller'=>'edit',
                        'action'=>'index'
                ),
                array(
                        1=>'id'
                )
        );
        $router->addRoute('item_edit', $route);

        $route = new Zend_Controller_Router_Route_Regex(
            'event/(.+)',
            array(
                'controller'=>'event',
                'action'=>'index'
            ),
            array(
                1=>'slug_name'
            )
        );
        $router->addRoute('event', $route);

        $route = new Zend_Controller_Router_Route_Regex(
            'tag/(.+)',
            array(
                'controller'=>'tag',
                'action'=>'index'
            ),
            array(
                1=>'slug_name'
            )
        );
        $router->addRoute('tag', $route);

        $route = new Zend_Controller_Router_Route_Regex(
            'tree/(.+)',
            array(
                'controller'=>'tree',
                'action'=>'index',
                'level'=>1
            ),
            array(
                1=>'cat1'
            )
        );
        $router->addRoute('tree1', $route);
        $route = new Zend_Controller_Router_Route_Regex(
            'tree/(.+)/(.+)',
            array(
                'controller'=>'tree',
                'action'=>'index',
                'level'=>2
            ),
            array(
                1=>'cat1',
                2=>'cat2'
            )
        );
        $router->addRoute('tree2', $route);
        $route = new Zend_Controller_Router_Route_Regex(
            'tree/(.+)/(.+)/(.+)',
            array(
                'controller'=>'tree',
                'action'=>'index',
                'level'=>3
            ),
            array(
                1=>'cat1',
                2=>'cat2',
                3=>'cat3'
            )
        );
        $router->addRoute('tree3', $route);
        
        $route = new Zend_Controller_Router_Route_Regex(
            'auth/signup/confirm',
            array(
                'controller'=>'auth',
                'action'=>'signup_confirm'
            )
        );
        $router->addRoute('signup_confirm', $route);
    }
    
    protected function _initActionDelimter(){
        $frontController = Zend_Controller_Front::getInstance();
        $dispatcher = $frontController->getDispatcher();
        $dispatcher ->setWordDelimiter('_')
                    ->setPathDelimiter('_');
    }
}