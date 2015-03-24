<?php
/**
 *
 */

class dotflow{

	public $tempDir = "plugins/dotflow/data/temp/";

	//textarea
	function getFlow(){

	}

	//ajax
	function setFlow(){//echo $_REQUEST['text']."/".$_REQUEST['node'];

		if(!$_REQUEST['text'] || !$_REQUEST['node']){return;}

		if(!is_dir($this->tempDir)){mkdir($this->tempDir,0777,true);}

		//exec("pwd",$pwd);
		//$file = $pwd[0]."/".$this->tempDir.$_REQUEST['node'];
		$file = $this->tempDir.$_REQUEST['node'];

		file_put_contents($file.".dot",$_REQUEST['text']);
		$format = "png";//[gif , png , svg]
		unset($res);
		$cmd = '/usr/local/bin/'.'dot -T'.$format.' '.$file.'.dot -o '.$file.'.'.$format;
		//$cmd = '/usr/local/bin/'.'dot -T'.$format.' '.$file.'.dot';
		exec($cmd,$res);
		//system($cmd);
		//echo $cmd;
		//echo count($res);
		//print_r($cmd);
		//echo join("",$res);exit();
		//print_r($res."\n");exit();

		//error
		if(count($res)){
			if(is_file($file.".".$format)){
				unlink($file.".".$format);
				//echo "delete";
			}
		}
		else{
			echo $this->tempDir.$_REQUEST['node'].".".$format;
		}

	}
	function setFlowSvg(){

		if(!$_REQUEST['text'] || !$_REQUEST['node']){return;}

		if(!is_dir($this->tempDir)){mkdir($this->tempDir,0777,true);}

		//exec("pwd",$pwd);
		//$file = $pwd[0]."/".$this->tempDir.$_REQUEST['node'];
		$file = $this->tempDir.$_REQUEST['node'];

		file_put_contents($file.".dot",$_REQUEST['text']);
		$format = "svg";//[gif , png , svg]
		unset($res);
		$cmd = '/usr/local/bin/'.'dot -T'.$format.' '.$file.'.dot';
		exec($cmd,$res);

		echo join("",$res);exit();
		/*
		$res2 = join("",$res);

		//error
		if(preg_match("/Error/",$res2)){

		}
		else{
			echo $this->tempDir.$_REQUEST['node'].".".$format;
		}
		*/

	}



}
