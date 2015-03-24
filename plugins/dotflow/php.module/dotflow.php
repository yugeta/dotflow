<?php
/**
 *
 */

class dotflow{

	public $tempDir = "plugins/dotflow/data/temp/";
	public $dot     = "/usr/local/bin/dot";

	//textarea
	function getFlow(){

		$uuid = $this->getUUID();
		$path = "plugins/dotflow/data/temp/";
		if(is_file($path.$uuid.".dot")){
			return file_get_contents($path.$uuid.".dot");
		}
	}

	//install-check
	function checkDot(){
		unset($res);
		exec($this->dot." -V 2>&1",$res);
		//print_r($res);exit();
		//if(!count($res)){return true;}
		if(preg_match("/version/",$res[0])){return true;}
	}

	//ajax
	/*
	function setFlow($loadType="save",$format){

		if(!$_REQUEST['text'] || !$_REQUEST['node']){return;}

		if(!is_dir($this->tempDir)){mkdir($this->tempDir,0777,true);}

		$file = $this->tempDir.$_REQUEST['node'];

		if($loadType=="save"){
			file_put_contents($file.".dot",$_REQUEST['text']);
		}
		$format = "png";//[gif , png , svg]
		unset($res);
		$cmd = '/usr/local/bin/'.'dot -T'.$format.' '.$file.'.dot -o '.$file.'.'.$format;
		//$cmd = '/usr/local/bin/'.'dot -T'.$format.' '.$file.'.dot';
		exec($cmd,$res);

		//error
		if(count($res)){
			if(is_file($file.".".$format)){
				unlink($file.".".$format);
			}
		}
		else{
			echo $this->tempDir.$_REQUEST['node'].".".$format;
		}

	}
	*/
	function setFlow($loadType="save",$format="svg"){

		if(!$_REQUEST['text'] || !$_REQUEST['uuid']){return;}

		if(!is_dir($this->tempDir)){mkdir($this->tempDir,0777,true);}

		$file = $this->tempDir.$_REQUEST['uuid'];

		if($loadType=="save"){
			file_put_contents($file.".dot",$_REQUEST['text']);
		}
		//$format = "svg";//[gif , png , svg]
		unset($res);
		$cmd = $this->dot.' -T'.$format.' '.$file.'.dot ';
		exec($cmd,$res);

		echo join("",$res);
		exit();
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

	function getUUID(){
		$cookie_key = "__a";
		//cookie読み込み(3rd-party)
		$cookie = $_COOKIE[$cookie_key];

		//初回の場合cookie作成
		if(!$cookie){
			list($date,$time,$msec) = $this->getDatetime();
			$cookie = $date.$time.".".$msec;
		}

		//cookie書き込み(3rd-party) *有効期間は365日
		setcookie($cookie_key,$cookie,time()+365*24*60*60);

		return $cookie;
	}
	function getDatetime(){
		//日時取得
		$date = date("Ymd");
		//時刻取得
		$time = date("His");
		//マイクロタイム取得
		list($usec, $sec) = explode(" ", microtime());
		list($sec0,$msec) = explode(".",$usec);

		return array($date,$time,$msec);
	}
	function getDownload($format,$uuid){
		$file = $this->tempDir.$uuid;
		unset($res);
		$cmd = $this->dot.' -T'.$format.' '.$file.'.dot -o '.$file.".".$format;
		exec($cmd,$res);
		/*
		if($format=="png"){
			header('Content-Type: image/png');
		}
		else{
			header('Content-Type: application/octet-stream');
		}
		*/
		/*
		$img_data = join("",$res);
		//file_put_contents("plugins/dotflow/data/test.png",$img_data);
		$content_length = strlen($img_data);
		*/
		$content_length = filesize($file.".".$format);
		header('Content-Type: image/png');
		//header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.date("YmdHis").'.'.$format.'"');
		header("Content-Length: ".$content_length);
		//print $img_data;
		readfile($file.".".$format);
	}

}
