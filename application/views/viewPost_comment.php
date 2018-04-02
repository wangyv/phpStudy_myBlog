<?php
include 'admin_check.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title><?php echo $blog -> title?> -  <?php echo $user -> username?>的博客 - 唯创个人博客</title>
  <base href="<?php echo base_url()?>">
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
	<div id="OSC_Content"><div class="SpaceChannel">
	<div id="portrait"><a href="#"><img src="images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></div>
    <div id="lnks">
		<strong><?php echo $user -> username?>的博客</strong>
		<div>
			<a href="admin/index">TA的博客列表</a>&nbsp;|
			<a href="javascript:sendmsg(154693)">发送留言</a>
</span>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="Blog">
	

  <div class="BlogTitle">
    <h1><?php echo $blog -> title?></h1>
    <div class="BlogStat">
						<span class="admin">
			<a href="newBlog.htm">编辑</a>&nbsp;|&nbsp;<a href="javascript:delete_blog(24026)">删除</a>
		</span>
				发表于1小时前 , 
		已有<strong>4</strong>次阅读  
		共<strong><a href="#comments">2</a></strong>个评论
		<strong>1</strong>人收藏此文章
	</div> 
  </div>
  <div class="BlogContent TextContent"><?php echo $blog -> content?></div>
      <div class="BlogLinks">
	<ul>
          <li>上篇 <span>(1小时前)</span>：<a href="viewPost_logined.htm" class="prev">测试文章2</a></li>            	</ul>
  </div>
    <div class="BlogComments">
    <h2><a name="comments" href="#postform" class="opts">发表评论»</a>共有 <?php echo count($results)?> 条网友评论</h2>
	<ul id="BlogComments">

    <?php 
        foreach($results as $result){
    ?>

	<li id='cmt_24027_154693_261665734'>

        <div class='portrait'>

            <a href="#"><img src="images//portrait.gif" align="absmiddle" alt="sw0411" title="sw0411" class="SmallPortrait" user="154693"/></a>			

        </div>

        <div class='body'>

            <div class='title'>

                <?php echo $result->username?> 发表于 <?php echo $result->post_time?></div>

            <div class='post'><?php echo $result->title?></div>

            <div id='inline_reply_of_24027_154693_261665734' class='inline_reply'></div>

        </div>

        <div class='clear'></div>

    </li>
    <?php 
        }
    ?>

</ul>
		  </div>  
  <div class="CommentForm">
    <a name="postform"></a>
    <form id="form_comment" action="admin/add_comment/<?php echo $blog -> blog_id?>" method="POST">          
      <textarea id="ta_post_content" name="content" style="width: 450px; height: 100px;"></textarea><br>
	  <input value="发表评论" id="btn_comment" class="SUBMIT" type="submit"> 
	  <img id="submiting" style="display: none;" src="images/loading.gif" align="absmiddle">
	  <span id="cmt_tip">文明上网，理性发言</span>
    </form>
	<a href="#" class="more">回到顶部</a>
	<a href="#comments" class="more">回到评论列表</a>
  </div>
  </div>
<div class="BlogMenu"><div class="RecentBlogs SpaceModule">
	<strong>最新博文</strong><ul>
    		<li><a href="#">测试文章2</a></li>
				<li><a href="#">测试文章1</a></li>
			<li class="more"><a href="welcome/index">查看所有博文»</a></li>
    </ul>
</div>

</div>
<div class="clear"></div>

<div id="inline_reply_editor" style="display:none;">
<div class="CommentForm">
	<form id="form_inline_comment" action="/action/blog/add_comment?blog=24026" method="POST">
	  <input id="inline_reply_id" name="reply_id" value="" type="hidden">          
      <textarea name="content" style="width: 450px; height: 60px;"></textarea><br>
	  <input value="回复" id="btn_comment" class="SUBMIT" type="submit"> 
	  <input value="关闭" class="SUBMIT" id="btn_close_inline_reply" type="button"> 文明上网，理性发言
    </form>
</div>
</div>
<link type="text/css" rel="stylesheet" href="css/shCore.css">
<link type="text/css" rel="stylesheet" href="css/shThemeDefault.css">
</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 唯创网讯</div>
</div>
</body></html>