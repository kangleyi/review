<!DOCTYPE HTML>
<html >
	<head>
		<title>用户管理</title>
		<script src="js/common.js"></script>
	</head>
	<body class="content1" style="background-color: transparent;" >
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="page-header">
						<h3 style="text-align: center">
							用户管理
						</h3>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="javascript:;">数据列表</a>
						</li>
						<li >
							<a href="/main.php"  >返回</a>
						</li>
					</ul>
					<?php
						header('Content-type: text/html; charset=utf-8');
					$nick=isset($_POST['nick'])?$_POST['nick']:"";
					echo '<form id="ff" action="userList.php" method="POST">';
					echo '	nick：<input class="input-medium search-query" type="text" name="nick" value="'.$nick.'" />';
					print <<<EOT
						<button  type="submit" class="btn">查找</button>
						</form>
					<table class="table" style="text-align: center" id="alternatecolor">
						<thead>
							<tr>
								<th >
									昵称
								</th>
								<th>
									账号
								</th>
								<th>
									是否管理员
								</th>
								<th>
									是否禁用回复
								</th>
								<th>
									是否禁止登陆
								</th>
							</tr>
						</thead>
						<tbody>
EOT;
							$baseurl="http://localhost:8080/review/";
							function send_post($url,$post_data) {
							    global $baseurl;
							    $url=$baseurl.$url;
							    $postdata = http_build_query($post_data);
							    $options = array(
							        'http' => array(
							            'method' => 'POST',
							            'header' => 'Content-type:application/x-www-form-urlencoded',
							            'content' => $postdata,
							            'timeout' => 15 * 60 // 超时时间（单位:s）
							        )
							    );
							    $context = stream_context_create($options);
							    $result = file_get_contents($url, false, $context);
							    return $result;
							}
							$post_data = array(
								'nick' => $nick
							);
							$data =send_post("user/queryAll",$post_data);
							$moives = json_decode($data,true)['data'];
							foreach($moives as $value){ 
								echo '<tr align="center" style="border-bottom:1px solid #a2a2a2">';
								echo '<td>'.$value['nick']."</td>"; 
								echo '<td>'.$value['username']."</td>"; 
								echo '<td>'.$value['isAdmin']."</td>"; 
								echo '<td>'.$value['isForbid']."</td>"; 
								echo '<td>'.$value['delFlag']."</td>"; 
								echo '<td><a href="javascript:;" onclick="Forbid('.$value['id'].')">禁用</a> | ';
								echo '<a href="javascript:;" onclick="deletes('.$value['id'].')">删除</a></td>';
								echo '</tr>';
							} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		function deletes(id){
			$.get("http://localhost:8080/review/user/edit?delFlag=1&id="+id,function(r){
                    if(r.code==200){
                        alert("Opterate success!");
                        window.location.href="userList.php";
                    }
                })
		}
		function Forbid(id){
			$.get("http://localhost:8080/review/user/edit?isForbid=1&id="+id,function(r){
                    if(r.code==200){
                        alert("Opterate success!");
                        window.location.href="userList.php";
                    }
                })
		}
	</script>
</html>
