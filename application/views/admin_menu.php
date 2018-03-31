<div id="AdminMenu">
		<ul>
			<li class="caption">个人信息管理		
				<ol>
					<li class="inbox"><a href="admin/inbox">站内留言(0/1)</a></li>
					<li class="profile"><a href="admin/profile">编辑个人资料</a></li>
					<li class="chpwd"><a href="admin/chpwd">修改登录密码</a></li>
					<li class="usersettings"><a href="admin/usersettings">网页个性设置</a></li>
				</ol>
			</li>		
		</ul>
		<ul>
			<li class="caption">博客管理	
				<ol>
					<li class='new_blog'><a href="admin/new_blog">发表博客</a></li>
					<li class='classification'><a href="admin/classification">博客设置/分类管理</a></li>
					<li class='blog_manage'><a href="admin/blog_manage">文章管理</a></li>
					<li class='blogcomments'><a href="admin/blogcomments">博客评论管理</a></li>
				</ol>
			</li>
		</ul>
</div>

<script src="js/jquery.min.js"></script>
<script>
    var str = location.href.split('/').pop();
	var substr = str.split('?')[0];
	console.log(substr);
	if(str == 'outbox'){
		str = 'inbox';
	}else if(substr == 'change_blog'){
		str = 'new_blog';
	}
    $('#AdminMenu .' + str).addClass('current');
</script>