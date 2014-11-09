<?php
	require_once('modules/user/model/user.php');
	class userController{
		var $user = NULL;
		
		public function __construct(){
			$this->user = new user();
		}

		//Show()
		public function home($view){
			$this->user->show($view);
		}

		public function acerca(){
			$this->user->show('about');
		}

	}
?>