
<!DOCTYPE html>
<html >
<head>
    <title>管理员界面</title>
	<script src="js/common.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){ 
        var data = JSON.parse(localStorage.getItem('userinfo'));
        if(data==null)window.location.href='index.php';
        if(data.isAdmin==0)window.location.href='userMain.php';
        $("#user").text(data.nick+"("+data.username+")");
    });
    </script>
    <style>
        .put-right{
            text-align:right;
            color:black;
        }
        html{
            background: url(/images/admin.jpg)  no-repeat 0 0;
            background-size: cover;
        }
        body{
            background-color: transparent;
            background-image:none;
        }
        .thumbnail{
            background-color: #cbcbcb;
            opacity: 0.8;
        }
        .caption{
            text-align: center ;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="page-header">
        管理员界面
    </h1>
    <?php
        session_start();
        if($_SESSION['username']==null){
            header("location:index.php");
        }
        echo '当前用户：<span id="user">'.$_SESSION['nick'].'（'.$_SESSION['username'].'）'.'</span>';
    ?>
    <button onclick="window.location.href='userSession.php?deleteFlag=1'" >注销</button>
    <div class="row">
        <div class="col-xs-4">
            <div class="thumbnail">
                <img src="/images/goodType.ico" alt="">
                <div class="caption">
                    <h3>电影管理</h3>
                    <p>电影信息的展示与添加</p>
                    <p>
                        <a href="moviesList.php" class="btn btn-primary" role="button">前往</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="thumbnail">
                <img src="/images/good.ico" alt="">
                <div class="caption">
                    <h3>用户管理</h3>
                    <p>用户信息的展示与添加</p>
                    <p>
                        <a href="userList.php" class="btn btn-primary" role="button">前往</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="thumbnail">
                <img src="/images/user.ico" alt="">
                <div class="caption">
                    <h3>评论审核管理</h3>
                    <p>审核用户的评论</p>
                    <p>
                        <a href="reviewList.php" class="btn btn-primary" role="button">前往</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
