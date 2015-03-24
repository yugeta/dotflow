(function(){
	var $$={};

	$$.set = function(){
		var flow = document.getElementsByClassName("flow");
		for(var i=0;i<flow.length;i++){
			$$LIB.eventAdd(flow[i],"keyup",$$.keyup);
		}

	};

	$$.keyup = function(){
		$$LIB.ajax.set({
			query:{
				"mode":"ajax",
				"node":document.form1.node.value,
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



	$$LIB.eventAdd(window,"load",$$.set);
	return $$;
})();
