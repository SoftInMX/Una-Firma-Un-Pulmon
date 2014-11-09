<?php
	require_once('core/dao/user/userDAO.php');
	require_once('modules/user/view/userView.php');
	
	class user{
			
		var $view = NULL;
		var $userDAO = NULL;
		
		public function __construct(){
			$this->view = new userView();
			$this->userDAO = new userDAO();
		}
		
		public function show($view){
			$this->view->show($view);
		}
	}
?>