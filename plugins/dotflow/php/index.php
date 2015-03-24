<?php

date_default_timezone_set('Asia/Tokyo');

new uniqurl_index();

class uniqurl_index extends fw_define{

	function __construct(){

		//cookieの書き込みは、表示前に行う
		$dotflow = new dotflow();
		$dotflow->getUUID();

		if(!isset($_REQUEST['mode'])){$_REQUEST['mode']="";}

		if($_REQUEST['mode']=="upload"){
			die("upload");
			//redirect
			$url = new libUrl();
			$url->setUrl($url->getUrl());
		}
		else if($_REQUEST['mode']=="ajax"){
			$dotflow->setFlow($_REQUEST['loadType'],$_REQUEST['format']);
			exit();
		}
		else if($_REQUEST['mode']=="download"){
			$dotflow->getDownload($_REQUEST['format'],$_REQUEST['uuid']);
			exit();
		}
	}


}
