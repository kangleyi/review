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
  <h4>用户注册</h4>
  <div class="form-group">
	<input id="nick" required="required" class="form-control"/>
	<label class="form-label">昵　称  </label>
  </div>
  <div class="form-group">
	<input id="username" required="required" class="form-control"/>
	<label class="form-label">用户名  </label>
  </div>
  <div class="form-group">
	<input id="password" type="password" required="required" class="form-control"/>
	<label class="form-label">密　码</label>
  </div>
  <div class="form-group">
	<input id="repassword" type="password" required="required" class="form-control"/>
	<label class="form-label">确认密码</label>
  </div>
<button class="floating-btn" onclick="login()"><i class="icon-arrow"></i></button>
<a href="index.php">返回登录</a>
</body>
<script type="text/javascript">
	function login(){
		var nick=$("#nick").val();
		var username=$("#username").val();
		var password=$("#password").val();
		var repassword=$("#repassword").val();
		if(nick!=''&& username!='' && password!=''&&repassword!=''){
			if(password!=repassword){
				alert("两次输入密码不一致！");
			}else{
				$.post("http://localhost:8080/review/user/register",{"username":username,"password":password,"nick":nick},function(r){
					if(r.code==500){
						alert(r.msg);
					}else{
						alert("创建成功！");
						window.location.href="index.php";
					}
				},"json")
			}
		}else{
			alert("您有信息不完整!");
		}
	}
</script>
</html>