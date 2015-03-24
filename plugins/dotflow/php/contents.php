<?php

new CONTENTS();

class CONTENTS extends fw_define{
	function __construct(){
		$fw_define = new fw_define();
		$libView   = new libView();
		$dotflow   = new dotflow();

		//dot-module-check
		if(!$dotflow->checkDot()){
			$file = $fw_define->define_plugins."/".$_REQUEST['plugins']."/html/not-dot.html";
		}
		else{
			$file = $fw_define->define_plugins."/".$_REQUEST['plugins']."/html/contents.html";
		}
		echo $libView->file2HTML($file);
	}
}
