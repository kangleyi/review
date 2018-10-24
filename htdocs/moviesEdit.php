<!DOCTYPE HTML>
<html>
<head>
    <title>编辑电影</title>
    <script src="js/common.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){ 
            var id=GetQueryString("id");
            if(id!=null){
                $.get("http://localhost:8080/review/movie/editInit?id="+id,function(r){
                    if(r.code==200){
                        $("#id").val(r.data.id);
                        $("#name").val(r.data.name);
                        $("#type").val(r.data.type);
                        $("#years").val(r.data.years);
                        $("#director").val(r.data.director);
                        $("#actor").val(r.data.actor);
                        $("#remark").val(r.data.remark);
                    }
                })
            }
        });
        function GetQueryString(name){
             var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
             var r = window.location.search.substr(1).match(reg);
             if(r!=null)return  unescape(r[2]); return null;
        }
        function submitForm(){
            $.ajax({
                url:"http://localhost:8080/review/movie/save",
                type:"post",
                data:new FormData($("#ff")[0]),
                processData:false,
                contentType:false,
                success:function(data){
                    if(data.code==200){
                        alert("Opterate success!");
                        window.location.href="moviesList.php";
                    }
                }
            });
        }
    </script>
</head>

<body class="content1" style="background-color: transparent">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="page-header">
                <h3>
                    编辑电影
                </h3>
            </div>
            <ul class="nav nav-tabs">
                <li >
                    <a href="moviesList.php">电影列表</a>
                </li>
                <li class="active">
                    <a href="javascript:;"  >电影添加</a>
                </li>
                <li >
                    <a href="main.php"  >返回</a>
                </li>
            </ul>
            <form  id="ff" >
                <table style="display: inline-block">
                    <tr>
                        <td>电影名</td>
                        <td>
                            <input name="name" type="text" id="name" />
                            <input name="id" type="hidden" id="id" />
                        </td>
                    </tr>
                    <tr>
                        <td>电影图片</td>
                        <td><input name="file" type="file"  /></td>
                    </tr>
                    <tr>
                        <td>电影类型</td>
                        <td><input name="type" type="text" id="type" /></td>
                    </tr>
                    <tr>
                        <td>电影年份</td>
                        <td><input name="years" type="number" id="years" /></td>
                    </tr>
                    <tr>
                        <td>导演</td>
                        <td><input name="director" type="text"  id="director"/></td>
                    </tr>
                    <tr>
                        <td>主演</td>
                        <td><input name="actor" type="text" id="actor" /></td>
                    </tr>
                    <tr>
                        <td>简介</td>
                        <td><textarea name="remark" id="remark" ></textarea></td>
                    </tr>
                </table>

                <div class="buttons">
                    <input value="提交" type="button" onclick="submitForm()" style="margin-right:20px; margin-top:20px;"/>
                </div>

                <br class="clear"/>
            </form>

        </div>
    </div>
</div>
</body>
</html>
