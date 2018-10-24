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
							<a href="/main.php"  >返回</a>
						</li>
					</ul>
					<?php
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
					echo '<form id="ff" action="reviewList.php" method="POST">';
					echo '	评论人：<input class="input-medium search-query" type="text" name="createName" value="'.$createName.'" />';
					print <<<EOT
						<button  type="submit" class="btn">查找</button>
						</form>
					<table class="table" style="text-align: center" id="alternatecolor">
						<thead>
							<tr>
								<th style="width: 200px;">
									电影封面
								</th>
								<th>
									片名
								</th>
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
									是否通过
								</th>
								<th>
									操作
								</th>
							</tr>
						</thead>
						<tbody>
EOT;
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
								'createName' => $createName
							);
							$data =send_post("/movie/getReviews",$post_data);
							$moives = json_decode($data,true)['data'];
							foreach($moives as $value){ 
								echo '<tr align="center" style="border-bottom:1px solid #a2a2a2">';
								echo '<td><img src="'.$baseurl.$value['img'].'" /></td>';
								echo '<td>'.$value['name']."</td>"; 
								echo '<td>'.$value['createName']."</td>"; 
								echo '<td>'.microtime_format("Y/m/d H:i:s",$value['createTime']/1000)."</td>"; 
								echo '<td>'.$value['content']."</td>"; 
								echo '<td>'.(isset($value['isPass'])?($value['isPass']==1?'<span style="color:green">通过</span>':'<span style="color:red">不通过</span>'):'<span style="color:#c5c545">待审核</span>')."</td>"; 
								echo '<td><a href="javascript:;" onclick="passs('.$value['id'].')" >通过</a> | ';
								echo '<a href="javascript:;" onclick="unpass('.$value['id'].')">驳回</a></td>';
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
		function unpass(id){
			$.get("http://localhost:8080/review/movie/review/audit?isPass=0&id="+id,function(r){
                    if(r.code==200){
                        alert("Opterate success!");
                        window.location.href="reviewList.php";
                    }
                })
		}
		function passs(id){
			$.get("http://localhost:8080/review/movie/review/audit?isPass=1&id="+id,function(r){
                    if(r.code==200){
                        alert("Opterate success!");
                        window.location.href="reviewList.php";
                    }
                })
		}
	</script>
</html>
