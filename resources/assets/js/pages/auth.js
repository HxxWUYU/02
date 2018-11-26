(function(){
	'use strict';
	HXXSTORE.auth.validate=function(){
		$("#registerForm").validate({
			rules:{
				password_again:{
					equalTo:password
				}
			}
		});
		$("#loginForm").validate();
	}
})();