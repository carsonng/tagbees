<?php

class Ajax_FilterController extends Zend_Controller_Action
{
	private $params;
    public function init()
    {
		if(!$this->getRequest()->isPost()){
			exit(0);
		}else{
			$this->params=$this->_request->getPost();
		}
    }
    public function openSaveLocationAction(){
        $array = array();
        if (Zend_Auth::getInstance()->hasIdentity()){
            $array['result'] = false;
        } else{
            // Normal login page
            $array['result'] = true;
        }
        
        $this->_helper->json($array);
    }
    
    public function openManageLocationAction(){
        $array = array();
        if (Zend_Auth::getInstance()->hasIdentity()){
            $array['result'] = false;
        } else{
            // Normal login page
            $array['result'] = true;
        }
        
        $this->_helper->json($array);
    }
    
    public function openConfirmLocationRemoveAction(){
        $array = array();
        if (Zend_Auth::getInstance()->hasIdentity()){
            $array['result'] = false;
        } else{
            // Normal login page
            $array['result'] = true;
        }
        
        $this->_helper->json($array);
    }
    
    public function saveLocationAction(){
        $filterService=new Service_Filter();
        $result=$filterService->save(
            $this->params['name'], 
            $this->params['lat'], 
            $this->params['lng'], 
            $this->params['radius'],
            $this->params['override']
        );
        $this->_helper->json(array('result'=>$result));
    }
    public function deleteLocationAction(){
        $filterService=new Service_Filter();
        $result=$filterService->delete(
            $this->params['name']
        );
        $this->_helper->json(array('result'=>$result));
    }

}
