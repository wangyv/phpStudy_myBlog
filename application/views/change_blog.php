<?php
 include 'admin_check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>发表博客 <?php echo $user->username?>的博客 - 唯创个人博客</title>
  <base href="<?php echo site_url()?>">
  <link rel="stylesheet" href="css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/jquery.css" media="screen">
  <link rel="stylesheet" type="kindeditor/themes/default/default.css">
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
<div id="OSC_Screen">
<?php include 'admin_header.php'?>
	<div id="OSC_Content">
<div id="AdminScreen">
    <div id="AdminPath">
        <a href="admin/index">返回我的首页</a>&nbsp;»
    	<span id="AdminTitle">发表博客</span>
    </div>
    <?php include 'admin_menu.php'?>
    <div id="AdminContent">
<div class="MainForm">
<form id="BlogForm" action="admin/insert_article" method="POST">
<input id="hdn_blog_id" name="draft" value="0" type="hidden">
  <table>
  <tbody><tr><td class="t">标题（必填）</td></tr>
  <tr>
	<td>
    <input name="title" id="f_title" class="TEXT" style="width: 400px;" type="text" value="<?php echo $blog -> title?>">
	存放于 
	<select name="type_id" id="type_id">
        <?php
            foreach($blog_types as $type){        
        ?>
        <option value="<?php echo $type -> type_id?>"><?php echo $type -> type_name?></option>
        <?php
            }
        ?>
	</select>
	<a href="blogCatalogs.htm" onclick="return confirm('是否放弃当前编辑进入分类管理？');">分类管理»</a>
	</td>
  </tr>
  <tr><td class='t'>内容（必填） 
		<span id='save_draft_msg' style='display:none;color:#666;'></span>

  </td></tr>

  <tr>

    <td><textarea name="content" id="ta_blog_content" style="width:750px;height:300px;" value="<?php echo $blog -> content?>"></textarea></td>
  </tr>

  <tr class="option">
	<td><strong>文章类型？</strong>
    <input id="blog_type_1" name="type" value="1" onclick="switch_src(this)" checked="checked" type="radio"> <label for="blog_type_1">原创&nbsp;</label>
	<input id="blog_type_4" name="type" value="4" onclick="switch_src(this)" type="radio"> <label for="blog_type_1">转贴&nbsp;</label>
	<span id="f_origin_url" style="display:none">
		<strong>原文链接: </strong><input id="t_origin_url" name="origin_url" class="TEXT" size="50" type="text">
	</span>
	</td>
  </tr>
  <tr class="option">
	<td><strong>隐私设置？</strong>		
		<input id="privacy_1" name="privacy" value="0" checked="checked" type="radio"> <label for="privacy_1">所有人可见&nbsp;</label>
		<input id="privacy_0" name="privacy" value="1" type="radio"> <label for="privacy_0">保密（只有本人可见）</label>
		<span class="tip">设置为保密的文章，标题对任何人是可见的</span>
	</td>
  </tr>
  <tr class="option">
	<td><strong>评论设置？	</strong>	
		<input id="can_comment_1" name="deny_comment" value="0" checked="checked" type="radio"> <label for="can_comment_1">允许评论&nbsp;</label>
		<input id="can_comment_0" name="deny_comment" value="1" type="radio"> <label for="can_comment_0">禁止评论</label>
	</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr class="submit">
	<td>
	<input value=" 发 表 " class="BUTTON SUBMIT" type="submit" id="blog_btn">
	<input name="as_top" value="1" type="checkbox"> 
	设置为置顶	
    <span id="ajax_processing" style="margin-left:10px;">正在提交，请稍候...</span>
	<span id="submit_msg" style="display:none;"></span>
	</td>
  </tr>
  </tbody></table>
</form>
</div>

<style>

.ke-icon-code {

	background-image: url(/img/code.gif);

	background-position: 0px 0px;

	width: 16px;

	height: 16px;

}

</style>
</div>

	<div class='clear'></div>

</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 唯创网讯</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="kindeditor/kindeditor-all-min.js"></script>
<script>
    $(function(){
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                allowFileManager : true
            });
        });

        // $('#blog_btn').on('click', function(){
        //     $.post('admin/insert_article',{
        //         title: $('#f_title').val(),
        //         content: $('#ta_blog_content').val(),
        //         type_id: $('#type_id').val()
        //     }, function(res){
        //         if(res == 'success'){
        //             alert('博客发表成功！');
        //             window.location.href = 'admin/index';
        //         }else{
        //             alert('博客发表失败！');
        //         }
        //     },'text');
        // })
    })
</script>
</body></html>