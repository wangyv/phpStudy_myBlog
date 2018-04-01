<?php
include 'admin_check.php';
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>修改登录密码 <?php echo $user -> username?>的博客 - 唯创个人博客</title>
  <base href="<?php echo site_url()?>">
      <link rel="stylesheet" href="css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/jquery.css" media="screen">
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
	.error-pwd{color:red;}
  </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {padding: 3px 10px 3px 10px;}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {padding: 3px 10px 4px 10px;}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
<?php include 'admin_header.php'?>
	<div id="OSC_Content">
<div id="AdminScreen">
    <div id="AdminPath">
        <a href="admin/index">返回我的首页</a>&nbsp;»
    	<span id="AdminTitle">修改登录密码</span>
    </div>
    <?php include 'admin_menu.php'?>
    <div id="AdminContent">

<div class="MainForm">
<form class="AutoCommitJSONForm" action="" method="POST">
<h2>修改我的登录密码</h2>
<table width="100%">
	<tbody><tr>
		<th width="110">旧的登录密码</th>		
		<td>
			<input name="pwd" size="20" class="TEXT" tabindex="1" type="password" id="old-pwd">&nbsp;&nbsp;&nbsp;&nbsp;		
			<a href="#" target="_blank">忘记登录密码</a>
		</td>    		
	</tr>
	<tr>
		<th>新密码</th>		
		<td><input name="newpwd" size="20" class="TEXT" tabindex="2" type="password"></td>    		
	</tr>
	<tr>
		<th>再次输入新密码</th>		
		<td><input name="newpwd2" size="20" class="TEXT" tabindex="3" type="password">&nbsp;&nbsp;&nbsp;<small class="error-pwd"></small></td>    		
	</tr>
	<tr><th colspan="2"></th></tr>
	<tr class="submit">
		<th></th>
		<td>
		<input value="修改密码" class="BUTTON SUBMIT" tabindex="4" type="button" id="change-btn">
		<span id="error_msg" style="display:none"></span>
		</td>
	</tr>
</tbody></table>
</form>
</div></div>
	<div class="clear"></div>
</div>
</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 唯创网讯</div>
</div>
<script src="js/jquery.min.js"></script>
<script>
	$('[name=newpwd2]').on('keyup',function(){
		var pwd = $('[name=newpwd]').val();
		var pwd2 = $('[name=newpwd2]').val();
		if(pwd2 != pwd){
			$('.error-pwd').html('两次请输入相同密码');
		}else{
			$('.error-pwd').html('');
		}
	}).on('blur',function(){
		$('.error-pwd').html('');
	})
	$('#change-btn').on('click',function(){
		$.post('user/check_old_pwd', {
			'old_pwd':$('[name=pwd]').val(),
			'new_pwd':$('[name=newpwd]').val()
		}, function(res){
			if(res == 'fail_oldpwd'){
				alert('错误的旧密码！');
			}else if(res == 'success'){
				alert('密码修改成功！');
			}else if(res == 'fail_change'){
				alert('密码修改失败！');
			}
		}, 'text')
	})

</script>
</body></html>