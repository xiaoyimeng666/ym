<?php /*a:1:{s:59:"E:\phpstudy_pro\WWW\new\public/../app/view/Index/index.html";i:1605183453;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<textarea name="text" id="name" cols="30" rows="10"></textarea>
<button id="do">转换</button>
<textarea name="text2" id="name2" cols="30" rows="10"></textarea>

<p>------------------------------------分割线-----------------------------------</p>
<form action="index/add" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="upload">
</form>
11
/***for k,v in arr ***/ <br />
/***endfor ***/ <br />
<?php echo $good ?>

<p>------------------------------------分割线-----------------------------------</p>

<div id="b1" style="height: 300px;width: 300px;background: #005cbf">
    <div id="b2" style="height: 200px;width: 300px;background: #007bff;">
        <div id="b3" style="height: 100px;width: 300px;background: #7abaff">

        </div>
    </div>
</div>
</body>
<script src="static/jquery/jquery.min.js"></script>
<script>
    $("#do").click(function(){
        var text = $("#name").val();
        $("#name2").val(text.split('').reverse().join(''));
    })
    $("#b1").click(function () {
        console.log('1');
        event.stopPropagation();
    })
    $("#b2").click(function () {
        console.log('2');
        event.stopPropagation();
    })
    $("#b3").click(function () {
        console.log('3');
        event.stopPropagation();
    })
    $("#name").val('1,5,9,6,4,8,2,7,3');
    kp();
function kp() {
}
</script>
</html>