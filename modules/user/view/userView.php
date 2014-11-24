<?php
	class userView{
		var $path = '';
		
		public function __construct(){
			$this->path = HTML . 'user/';
		}
		
		function show($view = ''){
			$html = $this->path . $view . '.html';
			$jotaeses = '';
			if(is_file($html)){
				if($view == 'index'){
					$jotaeses = '
						<script src="/static/js/vendor/countdown.js" type="text/javascript"></script>
						<script src="/static/js/vendor/marquee.js" type="text/javascript"></script>
					';
					$activo_index = 'normal';
					$active = 'normal';
				}elseif ($view == 'about') {
					$activo_index = 'active';
					$active = 'normal';
				}elseif ($view == 'firmar') {
					$activo_index = 'normal';
					$active = 'active';
				}
				$template = file_get_contents(TEMPLATE);
				$content = array(
					'{TITLE}' => 'Un Firma Un Pulmón | Propuesta para ayudar a gente con cancer pulmonar',
					'{SCRIPT_PAGE}' => $jotaeses,
					'{CONTENIDO}' => file_get_contents($html),
					'{ACTIVE_INDEX}' => $activo_index,
					'{ACTIVE_FIRMA}' => $active
				);					
				echo str_replace(array_keys($content), array_values($content), $template);
			}else{
				header("Location: /404.html");
			}
		}

		function showFirmar($estados=array()){
			$html = $this->path . 'firmar.html';
			$template = file_get_contents(TEMPLATE);
			if(is_file($html)){
				$content = array(
					'{TITLE}' => 'Un Firma Un Pulmón | Firmar Propuesta',
					'{CONTENIDO}' => file_get_contents($html),
					'{ESTADOS}' => $estados,
					'{ACTIVE_INDEX}' => 'normal',
					'{ACTIVE_FIRMA}' => 'active'
				);
				echo $html = str_replace(array_keys($content), array_values($content), $template);
			}else{
				header("Location: /404.html");
			}
		}
	}
?>