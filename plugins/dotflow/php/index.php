<?php

date_default_timezone_set('Asia/Tokyo');

new uniqurl_index();

class uniqurl_index extends fw_define{




	function __construct(){

		if(!isset($_REQUEST['mode'])){$_REQUEST['mode']="";}

		if($_REQUEST['mode']=="upload"){
			die("upload");
			//redirect
			$url = new libUrl();
			$url->setUrl($url->getUrl());
		}
		else if($_REQUEST['mode']=="ajax"){//die("--:".$_REQUEST['text']);
			$dotflow = new dotflow();
			//
			if($_REQUEST['format']=="svg"){
				$dotflow->setFlowSvg();
			}
			else{
				$dotflow->setFlow();
			}
			exit();
		}



	}


}
