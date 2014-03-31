<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $this->load->view('templates/head'); ?>
    <body>
        <?php $this->load->view('templates/header'); ?>
        <div id="main">
            <div id="content">
                <div class="wrapper">
                    <div class="left-long" id="introduction">
                        <div class="division"></div>
                        <div class="caption">
                            <div></div>
                            <p>管理登录</p>
                        </div>
                        <div class="inside-list centered">
                            <?=form_open('login/process', array('class' => 'form form-signin'))?>
                                <fieldset>
                                    <div>
	                                <label>账号:</label>
	                                <input type="text" name="username" id="username" value="" />
                                    </div>
	                            <br>
	                            <div>
                                        <label>密码:</label>
	                                <input type="password" name="password" id="password" />
                                    </div>
                                    <br><br>
	                            <input class="button-submit" type="submit" value="登录" />
                                </fieldset>
	                    </form>
                        </div>
                    </div>
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
            $('.form-signin').submit(function() { return submit_page(this) });
        });

        function submit_page(form) {
            var options = {
                dataType: 'json',
                error: function() {
                    alert('服务器连接失败');
                },
                success: function(info) {
                    if (info['status'] == 'error') {
                        alert(info['content']);
                    } else {
                        window.location.href = '<?=$back_url?>';
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }
        </script>
    </body>
</html>
