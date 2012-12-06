<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage examples
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage examples
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class EventController extends Zend_Controller_Action
{
    
    public function preDispatch(){
       /*
        if (Zend_Auth::getInstance()->hasIdentity()){
                   $this->identity=Zend_Auth::getInstance()->getIdentity();
                   $_SESSION['language']=$this->identity->display_lang;
                   $this->view->headTitle($this->identity->name);
               }*/
       
    }
    
    public function indexAction()
    {
        if ($this->slug_name == 'new' || $this->slug_name == 'new_advanced'){
            $this->redirect('event/new');
        }
        
    }
    
    public function newAction()
    {
        
    }
    
    public function newAdvancedAction()
    {
        
    }
}
