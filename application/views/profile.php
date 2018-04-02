<?php
include 'admin_check.php';
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>会员资料设置 <?php echo $user -> username?>的博客 - 唯创个人博客</title>
  <base href="<?php echo site_url()?>">
      <link rel="stylesheet" href="css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/jquery.css" media="screen">
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
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
    	<span id="AdminTitle">会员资料设置</span>
    </div>
    <?php include 'admin_menu.php'?>
    <div id="AdminContent">
<ul class="tabnav"> 
	<li class="current"><a href="#">会员基本资料</a></li> 
</ul>

<div class="MainForm">
<form class="AutoCommitJSONForm" action="/action/profile/update_basic_info" method="POST">
<table>
	<tbody><tr>
		<th>登录帐号</th>		
		<td class="user-email" alt="<?php echo $user -> email?>">
			<?php echo $user -> email?>
		</td>
	</tr>
	<tr>
		<th>姓名</th>		
		<td>
			<input id="user-name" name="name" size="20" maxlength="20" class="TEXT" value="<?php echo $user -> username?>" type="text">
			<span class="Info" id="name_msg">不能超过10个字</span>
		</td>
	</tr>
	<tr>
    	<th>性别</th>		
		<td>
			<input name="gender" value="1" type="radio" <?php echo $user->sex==1?'checked':''?>>男
			<input name="gender" value="2" type="radio" <?php echo $user->sex==2?'checked':''?>>女
		</td>	
    </tr>
	<tr>
    	<th>出生年月</th>		
		<td alt="<?php echo $user->birthday ?>" class="user-birthday">
			<select name="y"><option selected="selected" value="0">--</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option></select> 年
            <select name="m"><option selected="selected" value="0">--</option><option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select> 月
            <select name="d"><option selected="selected" value="0">--</option><option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select> 日
		</td>	
    </tr>
	<tr>
		<th>居住地区</th>		
		<td><select name="province" id="userProvince">
	<option value="">--请选择省份--</option>
	<option value="北京">北京</option> 
	<option value="上海">上海</option> 
	<option value="广东">广东</option> 
	<option value="江苏">江苏</option> 
	<option value="浙江">浙江</option> 
	<option value="重庆">重庆</option> 
	<option value="安徽">安徽</option> 
	<option value="福建">福建</option> 
	<option value="甘肃">甘肃</option> 
	<option value="广西">广西</option> 
	<option value="贵州">贵州</option> 
	<option value="海南">海南</option> 
	<option value="河北">河北</option> 
	<option selected="selected" value="黑龙江">黑龙江</option> 
	<option value="河南">河南</option> 
	<option value="湖北">湖北</option> 
	<option value="湖南">湖南</option> 
	<option value="江西">江西</option> 
	<option value="吉林">吉林</option> 
	<option value="辽宁">辽宁</option> 
	<option value="内蒙古">内蒙古</option> 
	<option value="宁夏">宁夏</option> 
	<option value="青海">青海</option> 
	<option value="山东">山东</option> 
	<option value="山西">山西</option> 
	<option value="陕西">陕西</option> 
	<option value="四川">四川</option> 
	<option value="天津">天津</option> 
	<option value="新疆">新疆</option> 
	<option value="西藏">西藏</option> 
	<option value="云南">云南</option> 
	<option value="香港">香港特别行政区</option> 
	<option value="澳门">澳门特别行政区</option>
	<option value="台湾">台湾</option> 
	<option value="海外">海外</option>
</select>
<select name="city" id="userCity"><option selected="selected" value="哈尔滨">哈尔滨</option><option value="北安">北安</option><option value="大庆">大庆</option><option value="大兴安岭">大兴安岭</option><option value="鹤岗">鹤岗</option><option value="黑河">黑河</option><option value="佳木斯">佳木斯</option><option value="鸡西">鸡西</option><option value="牡丹江">牡丹江</option><option value="齐齐哈尔">齐齐哈尔</option><option value="七台河">七台河</option><option value="双鸭山">双鸭山</option><option value="绥化">绥化</option><option value="伊春">伊春</option></select>
</td>
	</tr>
	<tr>
		<th>个性签名<br>不超过100字</th>		
		<td><textarea name="signature" style="width: 300px; height: 100px;" class="TEXT"><?php echo $user->signature?></textarea></td>    		
	</tr>
	<tr><th colspan="2"></th></tr>
	<tr class="submit">
		<th></th>
		<td>
		<input value="保存修改" class="BUTTON SUBMIT" type="button" id="edit-user">
		<span id="error_msg" style="display:none"></span>
		</td>
	</tr>
</tbody></table>
</form>
</div>

</div>
	<div class="clear"></div>
</div>

</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 唯创网讯</div>
</div>
<script src="js/jquery.min.js"></script>
<script>
	var dateStr = $('.user-birthday').attr('alt');
	var userEmail = $('.user-email').attr('alt');
	// console.log(userEmail);
	var aDates = dateStr.split('-');
	// console.log(aDates);
	var arrY = Array.from($('select[name=y] option'));
	arrY.forEach(function(elem, index){
		if($(elem).attr('value') == aDates[0]){
			$(elem).attr('selected','selected');
		}
	});
	var arrM = Array.from($('select[name=m] option'));
	arrM.forEach(function(elem, index){
		if($(elem).attr('value') == aDates[1]){
			$(elem).attr('selected','selected');
		}
	});
	var arrD = Array.from($('select[name=d] option'));
	arrD.forEach(function(elem, index){
		if($(elem).attr('value') == aDates[2]){
			$(elem).attr('selected','selected');
		}
	});


	$('#edit-user').on('click',function(){
		var birthday = $('[name=y]').val()+'-'+$('[name=m]').val()+'-'+$('[name=d]').val();
		var local = $('[name=province]').val()+$('[name=city]').val();
		// console.log(local);
		// console.log(birthday);
		if(confirm("是否确认修改？")){
			$.post('admin/edit_user', {
				'email' : userEmail,
				'username' : $('#user-name').val(),
				'gender' : $('input[name=gender]:checked').val(),
				'birthday' : birthday,
				'city' : local,
				'signature' : $('[name=signature]').val()
			}, function(res){
				if(res == 'success'){
					alert('修改成功！');
					location.href = 'admin/adminindex';
				}else{
					alert('修改失败！');
				}
			}, 'text');
		}
	})

</script>
</body></html>