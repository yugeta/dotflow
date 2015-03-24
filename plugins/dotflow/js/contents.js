(function(){
	var $$={};

	$$.set = function(){
		var flow = document.getElementsByClassName("flow");
		for(var i=0;i<flow.length;i++){
			$$LIB.eventAdd(flow[i],"keyup",$$.keyup);
			if(flow[i].value){
				$$.loadData(flow[i]);
			}
		}

		var download = document.getElementsByClassName("download");
		for(var i=0;i<download.length;i++){
			var btns = download[i].getElementsByTagName("input");
			for(var j=0;j<btns.length;j++){
				if(btns[j].type!="button"){continue}
				$$LIB.eventAdd(btns[j],"click",$$.download);
			}
		}

	};

	$$.keyup = function(elm){
		if(this.nodeType==1){elm = this}
		$$LIB.ajax.set({
			query:{
				"mode":"ajax",
				"loadType":"save",
				"uuid":document.form1.uuid.value,
				"format":"svg",
				"text":this.value
			},
			querys:[],
			method:"post",
			url:"index.php",
			async:true,
			onSuccess:function(res){

				var div = document.getElementById("preview");
				if(div!=null){
					div.innerHTML = res;
				}
				/*
				if(res && div!=null){
					var img = document.createElement("img");
					img.src = res+"?"+(+new Date());
					div.appendChild(img);
				}
				*/
			}
		});
	};
	$$.loadData = function(elm){
		if(this.nodeType==1){elm = this}
		$$LIB.ajax.set({
			query:{
				"mode":"ajax",
				"loadType":"load",
				"uuid":document.form1.uuid.value,
				"format":"svg",
				"text":this.value
			},
			querys:[],
			method:"post",
			url:"index.php",
			async:true,
			onSuccess:function(res){
				var div = document.getElementById("preview");
				if(div!=null){
					div.innerHTML = res;
				}
			}
		});
	};
	$$.download = function(elm){
		if(this.nodeType==1){elm = this}
		if(!document.getElementById("preview").innerHTML){return}

		var url = "index.php?mode=download&uuid="+document.form1.uuid.value+"&format="+document.form2.fileType.value;
		location.href=url;

		/*
		$$LIB.ajax.set({
			query:{
				"mode":"download",
				"uuid":document.form1.uuid.value,
				"format":document.form2.fileType.value
			},
			method:"post",
			url:"index.php",
			async:true,
			onSuccess:function(res){
				//console.log(res);

			}
		});
		*/
	};


	$$LIB.eventAdd(window,"load",$$.set);
	return $$;
})();
