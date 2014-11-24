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

		public function firmar(){
			$this->user->firmar();
		}

		public function getMunicipios(){
			$municipios = '';
			$estado = isset($_POST['estado'])?trim($_POST['estado']):0;
			
			if (is_numeric($estado) && $estado != 0) {
				$municipios = $this->user->getMunicipios($estado);
			}
			
			echo $municipios;
		}

		public function firma(){
			$name 	= $_POST['name'];
			$sname 	= $_POST['sname'];
			$mail 	= $_POST['email'];
			$estado = $_POST['state'];
			$ciudad = $_POST['city'];
			$street = $_POST['address'];
			$cp 	= $_POST['zipcode'];

			if(isset($name) && isset($sname) && isset($mail) && isset($estado) && isset($ciudad) && isset($street) && isset($cp)){
				$res = $this->user->firma($name, $sname, $mail, $estado, $ciudad, $street, $cp);
			}else{
				$res = false;
			}
			return $res;
		}

	}
?>