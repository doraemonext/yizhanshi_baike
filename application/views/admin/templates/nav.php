<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?=site_url('admin')?>"><?=$site_config['site_title']?> 管理后台</a>
            <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    欢迎您，<?=$this->ion_auth->user()->row()->username?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?=site_url('/')?>" class="navbar-link">返回前台</a>
                </p>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>