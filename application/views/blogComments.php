<?php
include 'admin_check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title><?php echo $user -> username?>的博客 - 唯创个人博客</title>
  <base href="<?php echo base_url()?>">
      <link rel="stylesheet" href="css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/jquery.css" media="screen">
  <script type="text/javascript" src="js/jquery-1.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery_002.js"></script>
  <script type="text/javascript" src="js/oschina.js"></script>
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
    	<span id="AdminTitle">管理首页</span>
    </div>
    <?php include 'admin_menu.php'?>
    <div id="AdminContent">
<div class="MainForm BlogCommentManage">
  <h3>共有 3 篇博客评论，每页显示 20 个，共 1 页</h3>
  	<ul>
	<?php
		foreach($comments as $comment){

	?>
		<li id="cmt_24027_154693_261665734" class="row_1">
			<span class="portrait"><a href="#" target="_blank"><img src="images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
			<span class="comment">
			<div class="user"><b><?php echo $comment -> username?></b> 评论了 <a href="admin/blog_detail/<?php echo $comment -> blog_id?>" target="_blank"><?php echo $comment -> blog_title?></a></div>
			<div class="content"><p><?php echo $comment -> title?></p></div>
			<div class="opts">
				<span style="float:right;">
				<a href="javascript:deleteComment(<?php echo $comment -> comment_id?>)">删除</a> |
				<a href="javascript:deleteAllComment(<?php echo $comment -> send_user_id?>)">删除此人所有评论</a>
				</span>			
				<?php echo $comment -> post_time?>
			</div>
			</span>
			<div class="clear"></div>
		</li>

	<?php
	
	}
	?>
	</ul>

	<?php echo $link?>
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
function deleteComment(id){
	if(confirm("是否确认删除此条评论？")){
		$.post('admin/delete_one_comment',{
			'comment_id':id
		},function(res){
			if(res == 'success'){
				alert('删除成功！');
				location.href = 'admin/blogcomments';
			}else{
				alert('删除失败！');
			}
		},'text')
	}
}

function deleteAllComment(user_id){
	if(confirm("是否确认删除此人所有评论？")){
		$.post('admin/delete_this_all_comment',{
			'send_user_id':user_id
		},function(res){
			if(res == 'success'){
				alert('删除成功！');
				location.href = 'admin/blogcomments';
			}else{
				alert('删除失败！');
			}
		},'text')
	}
}

</script>
</body></html>