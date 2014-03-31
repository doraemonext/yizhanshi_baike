<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $this->load->view('templates/head'); ?>
    <body>
        <?php $this->load->view('templates/header'); ?>
        <div id="main">
            <div id="content">
                <div class="wrapper">
                    <div class="left" id="search-result">
                        <div class="division-long"></div>
                        <div class="caption-long">
                            <div></div>
                            <p>搜索结果（搜索到<?=$total_result?>条结果）</p>
                        </div>
                        <div class="inside-list">
                            <?php if (count($question) == 0): ?>
                            <div><strong>未搜索到任何结果，<a href="<?=site_url('add')?>">点此进行提问</a></strong></div>
                            <?php else: ?>
                            <?php foreach ($question as $row): ?>
	                    <li>
                                <div>
                                    <div class="title">
                                        <a href="<?=site_url('question/view').'/'.$row['id']?>"><?=$row['title']?></a>
                                    </div>
		                    <div class="type">
                                        <p>分类：<a href="<?=site_url('home/category').'/'.$row['category_id']?>"><?=$this->category_model->get_category_title($row['category_id'])?></a>
                                        &nbsp;|&nbsp;
                                        点击数：<span><?=$row['heat']?></span>
                                        &nbsp;|&nbsp;
                                        发布时间：<span><?=$row['datetime']?></span>
                                        </p>
                                    </div>
                                    <?php if ($row['reply_status'] == 0): ?>
                                    <div class="answer well">
                                        <p class="none">老师尚未回复，请耐心等待</p>
                                    </div>
                                    <?php else: ?>
                                    <div class="answer well">
                                        <?php if (mb_strlen($row['reply']) <= 200): ?>
                                        <?=auto_typography($row['reply'])?>
                                        <?php else: ?>
                                        <?php
                                        $config = array('indent' => TRUE,
                                                'output-xhtml' => TRUE,
                                                'show-body-only'=>TRUE,
                                                'wrap' => 200); 
                                        $content = tidy_parse_string(mb_substr(strip_tags(nl2br($row['reply']), '<img><br>'), 0, 200), $config, "UTF8");
                                        $content->cleanRepair();
                                        echo $content."&nbsp;&nbsp;<strong><a href='".site_url('question/view').'/'.$row['id']."'>...</a></strong>";
                                        ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
	                    </li>
                            <hr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?=$pagination?>
                        </div>
                    </div>
                    <?php $this->load->view('templates/sidebar'); ?>
                </div>
                <div id="footer">
                    <div></div>
                    <div></div>
                </div>
            </div>
            <?php $this->load->view('templates/footer'); ?>
        </div>
        <?php $this->load->view('templates/admin-footer'); ?>
        <?php $this->load->view('templates/js_global'); ?>
    </body>
</html>
