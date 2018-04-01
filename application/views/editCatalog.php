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
<form id="CatalogForm" action="/action/blog/add_blog_catalog?space=154693&amp;id=92334" method="post">
    <h3> 修改博客分类 </h3>
    <div id="error_msg" class="error_msg" style="display:none;"></div>
    <label>分类名称:</label><input id="txt_link_name" name="name" value="工作日志" size="15" tabindex="1" type="text">
    <label>排序值:</label><input name="sort_order" value="1" size="3" type="text">
    <span class="submit">
          <input value="修改&nbsp;»" tabindex="3" class="BUTTON SUBMIT" type="submit">
      <input value="取消" class="BUTTON" onclick="location.href='blogCatalogs.htm';" type="button">
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
	<tr id="catalog_92334">
		<td class="idx">1</td>
		<td class="name"><a href="editCatalog.htm" title="点击修改博客分类">工作日志</a></td>
		<td class="num">3</td>
		<td class="opts">
			<a href="editCatalog.htm" title="点击修改博客分类">修改</a>
			<a href="#" onclick="return delete_catalog(154693,92334);">删除</a>
		</td>
	</tr>
	<tr id="catalog_92335">
		<td class="idx">2</td>
		<td class="name"><a href="#" title="点击修改博客分类">日常记录</a></td>
		<td class="num">0</td>
		<td class="opts">
			<a href="#" title="点击修改博客分类">修改</a>
			<a href="#" onclick="return delete_catalog(154693,92335);">删除</a>
		</td>
	</tr>
	<tr id="catalog_92336">
		<td class="idx">3</td>
		<td class="name"><a href="#" title="点击修改博客分类">转贴的文章</a></td>
		<td class="num">0</td>
		<td class="opts">
			<a href="#" title="点击修改博客分类">修改</a>
			<a href="#" onclick="return delete_catalog(154693,92336);">删除</a>
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
</body></html>