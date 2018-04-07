<?php
include 'admin_check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>博客设置/分类管理 <?php echo $user -> username?>的博客 - 唯创个人博客</title>
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
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->

<?php include 'admin_header.php'?>
	<div id="OSC_Content">
<div id="AdminScreen">
    <div id="AdminPath">
        <a href="admin/index">返回我的首页</a>&nbsp;»
    	<span id="AdminTitle">博客设置/分类管理</span>
    </div>

    <?php include 'admin_menu.php'?>
    <div id="AdminContent">
<div class="MainForm BlogCatalogManage">
<form id="CatalogForm" action="" method="post">
    <h3> 修改博客分类 </h3>
    <div id="error_msg" class="error_msg" style="display:none;"></div>
    <label>分类名称:</label><input id="txt_link_name" name="name" size="15" tabindex="1" type="text">
    <span class="submit">
        <input value="添加 »" id="toggle-change" tabindex="3" class="BUTTON SUBMIT" type="button">
      	<input value="取消" id="cansel-change" class="BUTTON" type="button" style="display:none">
    </span>
</form>
<form class="BlogCatalogs">
<h3>博客分类 <span>(点击分类名编辑)</span></h3>
<table cellpadding="1" cellspacing="1">
	<tbody><tr>
		<th>序号</th>
		<th>分类名</th>
		<th>文章</th>
		<th>操作</th>
	</tr>

	<?php 
		foreach($results as $key => $result){
	?>
		<tr id="catalog_92334">
			<td class="idx"><?php echo ($key + 1) ?></td>
			<td class="name"><a href="javascript:change('<?php echo $result -> type_name?>','<?php echo $result -> type_id?>');" title="点击修改博客分类"><?php echo $result -> type_name?></a></td>
			<td class="num"><?php echo $result -> num?></td>
			<td class="opts">
				<a href="javascript:change('<?php echo $result -> type_name?>','<?php echo $result -> type_id?>');" title="点击修改博客分类">修改</a>
				<a href="javascript:deleteType(<?php echo $result -> type_id?>)">删除</a>
			</td>
		</tr>
	<?php
		}
	?>
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
	function change(typeName,id){
		$('#txt_link_name').val(typeName).attr('alt',id);
		$('#cansel-change').css('display','inline');
		$('#toggle-change').val('修改 »');
	}
	$('#toggle-change').on('click',function(){
		if($('#toggle-change').val()=='修改 »'){
			changeName()
		}else if($('#toggle-change').val()=='添加 »'){
			addType();
		}
	});
	$('#cansel-change').on('click',function(){
		$('#toggle-change').val('添加 »');
		$('#cansel-change').css('display','none');
		$('#txt_link_name').val('');
	})
	function changeName(){
		if(confirm("是否确定修改文章类型名？")){
			$.post('admin/update_blog_type',{
				'type_id':$('#txt_link_name').attr('alt'),
				'type_name':$('#txt_link_name').val()
			},function(res){
				if(res == 'success'){
					alert('修改成功！');
					location.href = 'admin/classification';
				}else{
					alert('修改失败！');
				}

			},'text')
		}
	}
	function addType(){
		if(confirm("是否确认添加新的文章类型？")){
			$.post('admin/save_blog_type',{
				'type_name':$('#txt_link_name').val()
			},function(res){
				if(res == 'success'){
					alert('添加成功！');
					location.href = 'admin/classification';
				}else{
					alert('添加失败！');
				}

			},'text');
		}
	}
	function deleteType(id){
		if(confirm("是否确认删除此文章类型？")){
			$.post('admin/delete_blog_type',{
				'type_id':id
			},function(res){
				if(res == 'success'){
					alert('删除成功！');
					location.href = 'admin/classification';
				}else{
					alert('删除失败！');
				}
			})
		}
	}
</script>
</body></html>