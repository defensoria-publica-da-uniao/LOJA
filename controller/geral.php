<?php 
	session_start();
	require_once '../application/configs/config.php';
	require_once MODELS . 'cGeral.php';
	require_once MODELS . 'cBanco.php';
		
	$oGeral = new cGeral();
	$oBanco = new cBanco();
	
	function remover_caracter($string) {
	    $string = preg_replace("/[áàâãä]/", "a", $string);
	    $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
	    $string = preg_replace("/[éèê]/", "e", $string);
	    $string = preg_replace("/[ÉÈÊ]/", "E", $string);
	    $string = preg_replace("/[íì]/", "i", $string);
	    $string = preg_replace("/[ÍÌ]/", "I", $string);
	    $string = preg_replace("/[óòôõö]/", "o", $string);
	    $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
	    $string = preg_replace("/[úùü]/", "u", $string);
	    $string = preg_replace("/[ÚÙÜ]/", "U", $string);
	    $string = preg_replace("/ç/", "c", $string);
	    $string = preg_replace("/Ç/", "C", $string);
	    $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
	    $string = preg_replace("/ /", "_", $string);
	    return $string;
	}
			
		if($_POST){ 
			$arrDadosForm = $_POST['arrDadosForm'];
			$tabela = $arrDadosForm['tabela'];
			unset($arrDadosForm['tabela']);
			
			if($tabela == 'eventos'){
				$arrDadosForm['dt_inicio'] = $oGeral->dataEn($arrDadosForm['dt_inicio']);
				$arrDadosForm['dt_fim'] = $oGeral->dataEn($arrDadosForm['dt_fim']);
				
				if(isset($_FILES['edital'])) {
					  date_default_timezone_set("Brazil/East"); 
					  $nome = $_FILES['edital']['name'];
					  $ext = strtolower(substr($_FILES['edital']['name'],-4)); 
					  
					  $new_name = remover_caracter($nome); 
					  $dir = '../public/editais/'; 
				 
					  $result = move_uploaded_file($_FILES['edital']['tmp_name'], $dir.$new_name);
				}
				$arrDadosForm['link_edital'] = $new_name;
			}
			if($tabela == 'inscricao'){
				
			}
			
			( (!empty($arrDadosForm['id_'.$tabela])) ? $id = $arrDadosForm['id_'.$tabela] : $id = null );
			unset($arrDadosForm['id_'.$tabela]);
			
			if(!empty($id)){ 
				$rs = $oBanco->update( $tabela, $id, $arrDadosForm );
			} else{ 
       			$rs = $oBanco->insert($tabela, $arrDadosForm );
			}
		}
        
		else {
			$tabela = $_GET['tabela'];
			$rs = $oBanco->delete($tabela, $_GET['id'] );
		}	
		
		if($rs){ 	
	       	$oGeral->redirect("1", "{$tabela}/lista");
		}else
       		$oGeral->redirect("2", "{$tabela}/lista");
	
?>
