<?php

class Iframe_EventController extends Zend_Controller_Action
{
	
  public function init()
  {
  }
  
  public function imgUploadFormAction(){
    if (!Zend_Auth::getInstance()->hasIdentity()){
        return false;
    }
    if (is_numeric($this->_getParam('event_id'))){
      $this->view->event_id = $this->_getParam('event_id');
    }else{
      $this->_helper->layout->disableLayout();
      return false;
    }
  }
  
  public function imgHandleAction(){
    if (!Zend_Auth::getInstance()->hasIdentity()){
        return false;
    }
    $this->_helper->layout->disableLayout();
    $imageService = new Service_Image();
    if($this->getRequest()->isPost()){
      //$this->post( );
      $this->_helper->json($imageService->upload($this->_getParam('event_id')));
    }
    if ($this->getRequest()->isGet()) {
      //$this->get();
      if (is_numeric($this->_getParam('event_id')))
        $this->_helper->json($imageService->getDbInfos($this->_getParam('event_id')));
      else  $this->_helper->json(false);
      
    }
    if ($this->getRequest()->isDelete() || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
      if (is_string($this->_getParam('filename')))
        $this->_helper->json($imageService->delete($this->_getParam('filename')));
      else  $this->_helper->json(false);
    }
  }
  
  public function imgGalleryAction(){
    if (is_numeric($this->_getParam('event_id'))){
      $imageService = new Service_Image();
      $this->view->img = $imageService->getImageInfos($this->_getParam('event_id'));
    }else{
      $this->_helper->layout->disableLayout();
      return false;
    }
  }
}

