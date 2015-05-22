<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name='viewport' content='initial-scale=1.0,width=device-width'>
    <link rel="stylesheet" href="<?= base_url('templates/default/css/style.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('templates/default/css/index.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('templates/default/css/home.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('templates/default/css/sub-content.css') ?>"/>
    <script src="<?= base_url('templates/default/js/jquery.js') ?>"></script>
    <script src="<?= base_url('templates/default/js/slider.js') ?>"></script>
    <title><?= $site_config['site_title'] ?></title>
</head>

<body>
<?php $this->load->view('templates/header'); ?>
<div id="main">
    <div id="sub-nav">
        <ul>
            <li><a href="http://yzs.whu.edu.cn/">首页</a></li>
            <li><a href="<?= site_url('/') ?>">学生百科</a></li>
            <li><a href="#">问题反馈</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="heading">
            <div id="brief"><span class="red">问题反馈：</span><?= $question['title'] ?></div>
        </div>
        <div id="detail">
            <form action="<?= site_url('feedback/submit') ?>" method="post" class="feedback-form">
                <input type="hidden" name="question-id" value="<?= $question['id'] ?>">
                <table>
                    <tr>
                        <td>请输入您对该问题的反馈内容：</td>
                    </tr>
                    <tr>
                        <td><textarea id="feedback" name="feedback" rows="10" cols="80"></textarea></td>
                    </tr>
                </table>
                <br>
                <input type="submit" class="button-submit" value="提交反馈">
            </form>
        </div>
    </div>
    <?php $this->load->view('templates/admin-footer'); ?>
    <?php $this->load->view('templates/js_global'); ?>
    <script>
        jQuery(document).ready(function () {
            $(".feedback-form").submit(function() {
                return submit_page(this);
            });
        });

        function submit_page(form) {
            var options = {
                dataType: 'json',
                error: function () {
                    alert('服务器连接发生错误');
                },
                success: function (info) {
                    if (info['status'] == 'error') {
                        alert(info['content']);
                    } else {
                        alert('您的反馈已成功提交！');
                        window.location.href = '<?= site_url('question/view') . '/' . $question['id'] ?>';
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }
    </script>
</body>
</html>