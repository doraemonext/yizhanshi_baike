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
            <li><a href="#">问题内容</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="heading">
            <div id="brief"><?= auto_typography($question['title']) ?></div>
            <div id="time">
                <span>分类：<a
                        href="<?= site_url('home/category') . '/' . $question['category_id'] ?>"><?= $this->category_model->get_category_title($question['category_id']) ?></a></span>
                &nbsp;&nbsp;
                <span>点击数：<?= $question['heat'] ?></span>
                &nbsp;&nbsp;
                <span>发布时间: <?= $question['datetime'] ?></span>
                &nbsp;&nbsp;
                <span class="feedback"><a href="<?= site_url('feedback') . '/article/' . $question['id'] ?>">我要纠错</a></span>
            </div>
        </div>
        <div id="detail">
            <?php if ($question['reply_status']): ?>
                <strong>问题回复：</strong><br><br>
                <?= auto_typography($question['reply']) ?>
                <?php if ($this->ion_auth->logged_in()): ?>
                    <div class="info">
                        <p><strong><a href="##" id="modify-content">修改该回复</a></strong></p>
                    </div>
                <?php endif; ?>
            <?php else: ?>

                <?php if (!$this->ion_auth->logged_in()): ?>
                    <div class="red"><strong>老师尚未回复，请耐心等待</strong></div>
                <?php else: ?>
                    <div class="red"><strong>您尚未回复该同学，请在下面的回复框内进行回复</strong></div>
                <?php endif; ?>
                <br>
            <?php endif; ?>

            <?php if ($this->ion_auth->logged_in()): ?>

            <?php if ($question['reply_status']): ?>
            <div id="reply-content-none" style="display: none">
                <?php else: ?>
                <div id="reply-content-none" name="reply-content-none" style="display: block">
                    <?php endif; ?>
                    <hr>
                    <br>
                    <?= form_open('question/submit_answer', array('class' => 'reply-answer')) ?>
                    <input type="hidden" name="question-id" value="<?= $question['id'] ?>">

                    <div class="reply">修改标题：</div>
                    <br>
                    <textarea name="title" rows="3" cols="45"><?= $question['title'] ?></textarea>
                    <br>
                    <br>
                    <div class="reply">修改分类：</div>
                    <br>
                    <select name="category" class="form-length">
                        <?php foreach ($category as $row): ?>
                            <?php if ($category_id == $row['id']): ?>
                                <option value="<?= $row['id'] ?>" selected="selected"><?= $row['title'] ?></option>
                            <?php else: ?>
                                <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <br>

                    <div class="reply">对该问题进行回复：</div>
                    <br>
                    <textarea id="reply-content" name="content"><?= nl2br($question['reply']) ?></textarea>
                    <br>

                    <div><input id="reply-submit" type="submit" value="提交回复"/></div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php $this->load->view('templates/admin-footer'); ?>
    <?php $this->load->view('templates/js_global'); ?>
    <script type="text/javascript" src="<?php echo base_url() . 'templates/ueditor/ueditor.config.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'templates/ueditor/ueditor.all.min.js'; ?>"></script>
    <script>
        jQuery(document).ready(function () {
            $('#modify-content').click(function () {
                modify_content();
            });
            $('.reply-answer').submit(function () {
                return submit_page(this)
            });

            UE.getEditor('reply-content');
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
                        location.reload();
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }

        function modify_content() {
            $('#reply-content-none').css('display', 'block');
            setTimeout(function () {
                location.hash = 'reply-content-none';
            }, 100);
        }
    </script>
</body>
</html>