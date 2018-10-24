<!DOCTYPE HTML>
<html >
	<head>
		<title>电影评论列表</title>
		<script src="js/common.js"></script>
	</head>
	<body class="content1" style="background-color: transparent;" >

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="page-header">
						<h3 style="text-align: center">
							影评管理
						</h3>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="javascript:;">数据列表</a>
						</li>
						<li >
							<a href="javascript:;" onclick="review()" >添加评论</a>
						</li>
						<li >
							<a href="/userMovies.php"  >返回</a>
						</li>
					</ul>
					<?php
					session_start();
			        if($_SESSION['username']==null){
			            header("location:index.php");
			        }
					header('Content-type: text/html; charset=utf-8');
					date_default_timezone_set('PRC');
					error_reporting( E_ALL&~E_NOTICE );
					function microtime_format($tag, $time)
					{
					   list($usec, $sec) = explode(".", $time);
					   $date = date($tag,$usec);
					   return str_replace('x', $sec, $date);
					}
					$createName=isset($_POST['createName'])?$_POST['createName']:"";
					$id=isset($_POST['id'])?$_POST['id']:$_GET['id'];
					$userId=isset($_POST['userId'])?$_POST['userId']:-1;
					$baseurl="http://localhost:8080/review";
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
						'createName' => $createName,
						'isPass'=>'1',
						'movieId'=>$id,
						'userId'=>$_SESSION['id']
					);
					$data =send_post("/movie/getReviews",$post_data);
					$moives = json_decode($data,true)['data'];
							if($moives!=null&&sizeof(array_values($moives))>0){
								echo "<div style='text-align:center;font-size:20px'><span>".array_values($moives)[0]['name']."</span><br/><img src=".$baseurl.array_values($moives)[0]['img']." /></div>";
								echo '<form id="ff" action="userReviewList.php" method="post">';
								echo '	<input type="hidden" name="id" value="'.$id.'" />';
								echo '	<input type="hidden" name="userId" value="'.$$userId.'" />';
								echo '	评论人：<input class="input-medium search-query" type="text" name="createName" value="'.$createName.'" /><button  type="submit" class="btn">查找</button></form>';
								print <<<EOT
									<table class="table" style="text-align: center" id="alternatecolor">
										<thead>
											<tr>
												<th>
													评论人
												</th>
												<th>
													评论时间
												</th>
												<th>
													评论内容
												</th>
												<th>
													评论评价
												</th>
												<th>
													操作
												</th>
											</tr>
										</thead>
										<tbody>
EOT;
								foreach($moives as $value){ 
									echo '<tr align="center" style="border-bottom:1px solid #a2a2a2">';
									echo '<td>'.$value['createName']."</td>"; 
									echo '<td>'.microtime_format("Y/m/d H:i:s",$value['createTime']/1000)."</td>"; 
									echo '<td>'.$value['content']."</td>"; 
									echo '<td><select name="reply" id="reply" ><option value="-1">请选择</option><option value="1"';
									if($value['type']==1){

									}
									echo '>有用</option><option value="2";>中</option><option value="3">无用</option></select></td>';
									if($_SESSION['id']==$value['createName']){
										echo '<td><a href="javascript:;" onclick="deletes('.$value['id'].')" >删除</a></td>';
									}else{
										echo '<td></td>'; 
									}
									echo '</tr>';
								} 
							}else{
								echo "暂无评论";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function deletes(id) {
				$.get("http://localhost:8080/review/movie/review?id="+id+"&delFlag=1",function(r){
                    if(r.code==200){
                        alert("Opterate success!");
                        $("#ff").submit();
                    }
                })
			}
			function review() {
				var b = window.prompt("请输入您的评论","");
				if(b!=null||b!=''){
					$.post("http://localhost:8080/review/movie/review",{"movieId":$("movieId").val(),"userId":$("userId"),"content":b},function(r){
	                    if(r.code==200){
	                        alert("Opterate success!");
	                        $("#ff").submit();
	                    }
                	})
				}else{
					alert("您未输入内容！");
				}
		</script>
	</body>
</html>
