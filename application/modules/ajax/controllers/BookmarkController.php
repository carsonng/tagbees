<?php

class Ajax_BookmarkController extends Zend_Controller_Action
{
	protected $bookmarkService;
	private $params;
    public function init()
    {
  		if(!$this->getRequest()->isPost()){
  			exit(0);
  		}else{
  			$this->params=$this->_request->getPost();
        $this->bookmarkService=new Service_Bookmark();
  		}
    }
    
    public function triggerAction()
    {
      $array["result"]=$this->bookmarkService->trigger(
        $this->params['id'],
        $this->params['set_status']
      );
      $this->_helper->json($array);
    }
    
    public function openBoxTriggerAction(){
        $this->_helper->json(array());
    }

    public function getUserBookmarkListAction()
    {
      $array["result"] = $this->bookmarkService->getUserBookmarkList($this->params['user_id']);
      $this->_helper->json($array);
    }
    
    public function getBookmarksAction()
    {
      $used_ids = array();
      if (isset($this->params['used_ids'])) 
        $used_ids = $this->params['used_ids'];
      
      $this->_helper->json($this->bookmarkService->getBookmarks(
        $used_ids, 
        (isset($this->params['sort_by'])) ? $this->params['sort_by'] : 'bookmark_time', 
        (isset($this->params['sort_order'])) ? $this->params['sort_order'] : 'desc'
      ));
    }
    
    public function getHighlightsAction()
    {
      $used_ids = array();
      if (isset($this->params['used_ids'])) $used_ids = $this->params['used_ids'];
      $this->_helper->json($this->bookmarkService->getHighlights($used_ids));
    }
}

