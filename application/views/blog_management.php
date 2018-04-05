<?php
include 'admin_check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>博客文章管理 <?php echo $user -> username?>的博客 - 唯创个人博客</title>
  <base href="<?php echo site_url()?>">
      <link rel="stylesheet" href="css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/jquery.css" media="screen">
	<style>
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
    	<span id="AdminTitle">博客文章管理</span>
    </div>
    <?php include 'admin_menu.php'?>
    <div id="AdminContent">
<div class="MainForm BlogArticleManage">
  <h3 class="title">共有 <?php echo count($blogs)?> 篇博客，每页显示 40 个，共 1 页</h3>
    <div id="BlogOpts">
	<a href="javascript:checkAll();">全选</a>&nbsp;|
	<a href="javascript:removeCheckAll();">取消</a>&nbsp;|
	<a href="javascript:inverseElection();">反向选择</a>&nbsp;|
	<a href="javascript:deleteBlog();">删除选中</a>
  </div>
  <ul>
		<?php
			foreach($blogs as $blog){

		?>
			<li class="row_1">
			<input name="blog" value="<?php echo $blog->blog_id?>" type="checkbox">
			<a href="admin/blog_detail/<?php echo $blog->blog_id?>" target="_blank"><?php echo $blog -> title?></a>
			<small><?php echo $blog -> post_time?></small>
			</li>
		<?php

		}
		?>
	  </ul>
    </div>
</div>
	<div class="clear"></div>
</div>
<script src="js/jquery.min.js"></script>
<script>
	function checkAll(){
		$('[name=blog]').prop('checked','checked');
	}
	function removeCheckAll(){
		$('[name=blog]').prop('checked',null);
	}
	function inverseElection(){
		$('[name=blog]').each(function(index,elem){
			// console.log($(elem).prop('checked'));
			if($(elem).prop('checked')){
				$(elem).prop('checked',null);
			}else{
				$(elem).prop('checked','checked');
			}
		});
	}
	function deleteBlog() {
		var arr = [];
		$('[name=blog]').each(function(index,elem){
			if($(elem).prop('checked')){
				arr.push($(elem).val());
			}
		});
		if(confirm("是否确认删除这些博客，一旦删除，将无法恢复")){
			$.post('admin/delete_blogs',{
				'blog_ids':arr
			},function(res){
				if(res == 'success'){
					alert('删除成功！');
					location.href = 'admin/blog_manage';
				}else{
					alert('删除失败！');
				}
			},'text')
		}
	}
</script>
</body></html>