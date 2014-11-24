<?php
require_once('core/dao/conection.php');
require_once('core/helpers/helper.php');

class userDAO {	
	var $conection;
	var $mysqli;
	var $helper;
	
	function __construct() {
		$this->conection = new Conection();
		$this->helper = new helper();
		$this->mysqli = $this->conection->conect();
	}

	public function getEstados(){
		$estados = array();
		$SQL = 'SELECT id, abrev, nombre FROM cat_estados;';
		
		$e = $this->mysqli->query($SQL);
		
		if($e){
			while ($estado = $e->fetch_assoc()) {
				$estados[] = $estado;
			}
		}
		
		return $estados;
	}
	
	public function getMunicipios($estado=0){
		$municipios = array();
		$SQL = "SELECT id, sigla, nombre FROM cat_municipios WHERE estado_id = $estado;";
		$m = $this->mysqli->query($SQL);
		
		if($m){
			while ($municipio = $m->fetch_assoc()) {
				$municipios[] = $municipio;
			}
		}
		
		return $municipios;
	}
}
?>