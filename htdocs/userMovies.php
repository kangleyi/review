<!DOCTYPE HTML>
<html >
	<head>
		<title>电影列表</title>
		<script src="js/common.js"></script>
	</head>
	<body class="content1" style="background-color: transparent;" >

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="page-header">
						<h3 style="text-align: center">
							电影评价
						</h3>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="javascript:;">数据列表</a>
						</li>
						<li >
							<a href="/userMain.php"  >返回</a>
						</li>
					</ul>
					<?php
						header('Content-type: text/html; charset=utf-8');
					$name=isset($_POST['name'])?$_POST['name']:"";
					$type=isset($_POST['type'])?$_POST['type']:"";
					$years=isset($_POST['years'])?$_POST['years']:"";
					$director=isset($_POST['director'])?$_POST['director']:"";
					$actor=isset($_POST['actor'])?$_POST['actor']:"";
					echo '<form id="ff" action="userMovies.php" method="POST">';
					echo '	电影名：<input class="input-medium search-query" type="text" name="name" value="'.$name.'" />';
					echo '	类型：<input class="input-medium search-query" type="text" name="type" value="'.$type.'" />';
					echo '	年份：<input class="input-medium search-query" type="text" name="years" value="'.$years.'" />';
					echo '	导演：<input class="input-medium search-query" type="text" name="director" value="'.$director.'" />';
					echo '	主演：<input class="input-medium search-query" type="text" name="actor" value="'.$actor.'" />';
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
									类型
								</th>
								<th>
									年份
								</th>
								<th>
									导演
								</th>
								<th>
									主演
								</th>
								<th>
									简介
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
								'name' => $name,
								'type' => $type,
								'years' => $years,
								'director' => $director,
								'actor' => $actor
							);
							$data =send_post("/movie/all",$post_data);
							$moives = json_decode($data,true)['data'];
							foreach($moives as $value){ 
								echo '<tr align="center" style="border-bottom:1px solid #a2a2a2">';
								echo '<td><img src="'.$baseurl.$value['img'].'" /></td>';
								echo '<td>'.$value['name']."</td>"; 
								echo '<td>'.$value['type']."</td>"; 
								echo '<td>'.$value['years']."</td>"; 
								echo '<td>'.$value['director']."</td>"; 
								echo '<td>'.$value['actor']."</td>"; 
								echo '<td>'.$value['remark'].'</td>';
								echo '<td><a href="userReviewList.php?id='.$value['id'].'" >评价</a> ';
								echo '</tr>';
							} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
