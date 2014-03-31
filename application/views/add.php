<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $this->load->view('templates/head'); ?>
    <body>
        <?php $this->load->view('templates/header'); ?>
        <div id="main">
            <div id="content">
                <div class="wrapper">
                    <div class="left" id="introduction">
                        <div class="division"></div>
                        <div class="caption">
                            <div></div>
                            <p>我要提问</p>
                        </div>
                        <div class="inside-list">
                            <?=form_open('add/process', array('class' => 'form add'))?>
                                <fieldset>
                                    <div>
                                        <label>问题类别</label>
                                        <select name="category" class="form-length">
                                            <option value="0"></option>
                                            <?php foreach ($category as $row): ?>
                                            <option value="<?=$row['id']?>"><?=$row['title']?></option>
                                            <?php endforeach; ?>
  	                                </select>
                                    </div><br>
                                    <div>
                                        <label>您的昵称</label>
                                        <input type="text" class="form-length" name="author" id="author">
                                    </div><br>
                                    <div>
                                        <label>Email地址</label>
                                        <input type="text" class="form-length" name="email" id="email" />
                                        <br>
                                        <p class="help-block">选填，填写电子邮件地址可以在您的问题被回复时第一时间通知您</p>
                                    </div><br>
                                    <div>
                                        <label>提问内容</label>
                                        <textarea id="ask-content" name="content" cols="40" rows="10"></textarea>
                                    </div><br><br>
                                    <input type="submit" class="button-submit" value="提交您的问题" />
                                </fieldset>
                            </form>
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
        <script>
        jQuery(document).ready(function() {
            $('.add').submit(function() { return submit_page(this) });
        });

        function submit_page(form) {
            var options = {
                dataType: 'json',
                error: function() {
                    alert('服务器连接出错');
                },
                success: function(info) {
                    if (info['status'] == 'error') {
                        alert(info['content']);
                    } else {
                        window.location.href = '<?=site_url('question/view')?>' + '/' + info['content'];
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }
        </script>
    </body>
</html>