<div id="AdminMenu">
		<ul>
			<li class="caption">个人信息管理		
				<ol>
					<li><a href="inbox.htm">站内留言(0/1)</a></li>
					<li><a href="profile.htm">编辑个人资料</a></li>
					<li><a href="chpwd.htm">修改登录密码</a></li>
					<li><a href="userSettings.htm">网页个性设置</a></li>
				</ol>
			</li>		
		</ul>
		<ul>
			<li class="caption">博客管理	
				<ol>
					<li class='new_blog'><a href="admin/new_blog">发表博客</a></li>
					<li><a href="blogCatalogs.htm">博客设置/分类管理</a></li>
					<li><a href="blogs.htm">文章管理</a></li>
					<li class='blog_manage'><a href="admin/blog_manage">博客评论管理</a></li>
				</ol>
			</li>
		</ul>
</div>

<script src="js/jquery.min.js"></script>
<script>
    var str = location.href.split('/').pop();
    $('#AdminMenu .' + str).addClass('current');
</script>