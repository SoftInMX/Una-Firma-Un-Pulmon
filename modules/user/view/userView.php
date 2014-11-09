<?php
	class userView{
		var $path = '';
		
		public function __construct(){
			$this->path = HTML . 'user/';
		}
		
		function show($view = ''){
			$html = $this->path . $view . '.html';
			if(is_file($html)){
				$template = file_get_contents(TEMPLATE);
				$content = array(
					'{TITLE}' => 'Un Firma Un Pulmón | Propuesta para ayudar a gente con cancer pulmonar',
					'{CONTENIDO}' => file_get_contents($html)
				);					
				echo str_replace(array_keys($content), array_values($content), $template);
			}else{
				header("Location: /404.html");
			}
		}
	}
?>