<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <li class="nav-header">管理后台</li>
        <?php if ($page == 'problem'): ?>
        <li class="active"><a href="<?=site_url('admin/problem')?>"><i class="icon-book"></i> 问题管理</a></li>
        <?php else: ?>
        <li><a href="<?=site_url('admin/problem')?>"><i class="icon-book"></i> 问题管理</a></li>
        <?php endif; ?>

        <?php if ($page == 'category'): ?>
        <li class="active"><a href="<?=site_url('admin/category')?>"><i class="icon-th"></i> 分类管理</a></li>
        <?php else: ?>
        <li><a href="<?=site_url('admin/category')?>"><i class="icon-th"></i> 分类管理</a></li>
        <?php endif; ?>

        <?php if ($page == 'search_tags'): ?>
        <li class="active"><a href="<?=site_url('admin/search_tags')?>"><i class="icon-th"></i> 搜索热词管理</a></li>
        <?php else: ?>
        <li><a href="<?=site_url('admin/search_tags')?>"><i class="icon-th"></i> 搜索热词管理</a></li>
        <?php endif; ?>

        <?php if ($page == 'user'): ?>
        <li class="active"><a href="<?=site_url('admin/user')?>"><i class="icon-user"></i> 管理员帐号</a></li>
        <?php else: ?>
        <li><a href="<?=site_url('admin/user')?>"><i class="icon-user"></i> 管理员帐号</a></li>
        <?php endif; ?>

        <?php if ($page == 'config'): ?>
        <li class="active"><a href="<?=site_url('admin/config')?>"><i class="icon-pencil"></i> 系统设定</a></li>
        <?php else: ?>
        <li><a href="<?=site_url('admin/config')?>"><i class="icon-pencil"></i> 系统设定</a></li>
        <?php endif; ?>
    </ul>
</div><!--/.well -->