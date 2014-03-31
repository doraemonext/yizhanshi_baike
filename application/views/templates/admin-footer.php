<div id="support">
    <a href="http://developer.ziqiang.net/" target="_blank">小强车间</a>技术支持
            Copyright©ziqiang.net 2013 all rights reserved 鄂ICP备05008352号<br>
    <?php if ($this->ion_auth->logged_in()): ?>
    您已作为 <a><?=$this->ion_auth->user()->row()->username?></a> 登陆，
    <a href="<?=site_url('logout').'?back_url='.current_url()?>">登出</a>
    <a href="<?=site_url('admin')?>">管理后台</a>
    <?php else: ?>
    <a href="<?=site_url('login').'?back_url='.current_url()?>">管理员登陆</a>
    <?php endif; ?>
    <p> <span></span></p>
</div>

<!--[if IE 6]>
<script src="/static/js/pngie6.js"></script>
<script src="/static/js/others.js"></script>
<script>
DD_belatedPNG.fix('#menu, #search, #searchicon, .dot-2, img, .flag, .transparent');
</script>
<![endif]-->