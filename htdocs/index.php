<!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Review</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>

<div class="panel-lite">
  <div class="thumbur">
	<div class="icon-lock"></div>
  </div>
  <h4>用户登录</h4>
  <div class="form-group">
	<input id="username" required="required" class="form-control"/>
	<label class="form-label">用户名    </label>
  </div>
  <div class="form-group">
	<input id="password" type="password" required="required" class="form-control"/>
	<label class="form-label">密　码</label>
  <button class="floating-btn" onclick="login()"><i class="icon-arrow"></i></button>
</div>
<a href="register.php">注册</a>
</body>
<script type="text/javascript">
	function login(){
		var username=$("#username").val();
		var password=$("#password").val();
		if(username!='' && password!=''){
			$.post("http://localhost:8080/review/user/login",{"username":username,"password":password},function(r){
				if(r.code==500){
					alert(r.msg);
				}else{
					var data=r.data;
					localStorage.setItem('userinfo',JSON.stringify(data));
					window.location.href="userSession.php?isAdmin="+data.isAdmin+"&username="+data.username+"&nick="+data.nick+"&id="+data.id;
				}
			},"json")
		}else{
			alert("username or password is not empty!");
		}
	}
</script>
</html>