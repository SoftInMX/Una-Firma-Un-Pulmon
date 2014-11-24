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

		public function firmar(){
			$est = '';
			$estados = $this->userDAO->getEstados();
			foreach ($estados as $estado) {
				$est .= '<option value="'.$estado['abrev'].'" data-id="'.$estado['id'].'">'.$estado['nombre'].'</option>';
			}
			$this->view->showFirmar($est);
		}

		public function getMunicipios($estado=0){
			$municipios = '';
			$m = $this->userDAO->getMunicipios($estado);
			
			foreach ($m as $municipio) {
				$municipios .= '<option value="'.$municipio['sigla'].'">'.$municipio['nombre'].'</option>';
			}
			
			return $municipios;
		}

		public function firma($name, $sname, $mail, $estado, $ciudad, $street, $cp){
			//get an Auth_Key
			$api_key = 'b5e23ea22a08f9a42ba7947274a85364654179f7ec22dfe0506605fd0640f84b';
			$secret_token = '02c149f516d73babb93395d88eda3003d26195f6b04b2c92747156d5c150f254';
  			$petition_id = 2186229;
			$host = 'https://api.change.org';
			$endpoint = "/v1/petitions/$petition_id/auth_keys";
			$request_url = $host . $endpoint;
  		//Params Auth_Key
			$params = array();
			$params['api_key'] = $api_key;
			$params['source_description'] = 'Firma desde el sitio 1firma1pulmón.org';
			//$params['source'] = date('YmdHms');
			$source = $params['source'] = date('YmdHms');

			$params['requester_email'] = $mail;
			$params['timestamp'] = gmdate("Y-m-d\TH:i:s\Z");
			$params['endpoint'] = $endpoint;
			
			$query_string_with_secret_and_auth_key = http_build_query($params) . $secret_token;
			$params['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);

			$query = http_build_query($params);
			$curl_session = curl_init();
			curl_setopt_array($curl_session, array(
				CURLOPT_POST => 1,
				CURLOPT_URL => $request_url,
				CURLOPT_POSTFIELDS => $query,
				CURLOPT_RETURNTRANSFER => true
			));
			$result = curl_exec($curl_session);
			$result = curl_exec($curl_session);
			$json_response = json_decode($result, true);
			
			$petition_auth_key = $json_response['auth_key'];

			//SEND Signature
			$endpoint = "/v1/petitions/$petition_id/signatures";
  			$url = $host . $endpoint;

			$parameters = array();
			$parameters['api_key'] = $api_key;
			$parameters['timestamp'] = gmdate("Y-m-d\TH:i:s\Z");
			$parameters['endpoint'] = $endpoint;
			$parameters['source'] = $source;
			
			$parameters['email'] = $mail;
			$parameters['first_name']	= $name;
			$parameters['last_name']	= $sname;
			$parameters['address']		= $street;
			$parameters['city']			= $ciudad;
			$parameters['state_province']	= $estado;
			$parameters['postal_code']	= $cp;
			$parameters['country_code']	= 'MX';
			$query_string_with_secret_and_auth_key = http_build_query($parameters) . $secret_token . $petition_auth_key;

			$parameters['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);
			$data = http_build_query($parameters);
			$curl_session = curl_init();
			curl_setopt_array($curl_session, array(
				CURLOPT_POST => 1,
				CURLOPT_URL => $url,
				CURLOPT_POSTFIELDS => $data
			));
			$result = curl_exec($curl_session);
			return $result;
		}
	}
?>