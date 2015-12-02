/**
 * api首页公用js
 */
var SeeedApiInfo = {
	config:function(){
	},
	init:function(){
		this.main();//自动加载的部分
	},
	main:function(){
	    $('.clicktest').on('click',function(){
	    	alert(111);
	    });
	    
	    $('.go-next').on('click',function(){
	    	alert(222);
	    	var self = $(this);
	    	var go_url = $.trim(self.parents('form').attr('action'));
	    	alert(go_url);
	    	var cid = parseInt(self.parent('.form-group').attr('data-cid'));
	    	alert(cid);
	    	window.location.href = getHostUrl()+go_url+"&type=next&cid="+cid;
	    });

	},
	poster:function(){

	},
};
//初始化
$(function() {
	SeeedApiInfo.init();
});
function getHostUrl(){
	return "http://"+window.location.host;
}