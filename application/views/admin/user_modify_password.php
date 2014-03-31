<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/templates/head'); ?>
    <body>
        <?php $this->load->view('admin/templates/nav'); ?>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3">
                    <?php $this->load->view('admin/templates/sidebar'); ?>
                </div><!--/span-->
                <div class="span8">
                    <div class="page-header">
                        <h3>修改密码</h3>
                    </div>
                    <?=form_open('admin/user/modify_password_process', array('class' => 'form-horizontal modify'))?>
                        <div class="alert alert-error" id="tips" style="display:none"></div>
                        <input type="hidden" name="user-id" value="<?=$user->id?>">
                        <div class="control-group">
                            <label class="control-label" for="username">用户名</label>
                            <div class="controls">
                                <input id="username" type="text" value="<?=$user->username?>" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">密码</label>
                            <div class="controls">
                                <input id="password" name="password" type="password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="confirm-password">确认密码</label>
                            <div class="controls">
                                <input id="confirm-password" name="confirm-password" type="password">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div><!--/span-->
            </div><!--/row-->
            <?php $this->load->view('admin/templates/footer'); ?>
        </div>

        <?php $this->load->view('admin/templates/js_global'); ?>
        <script type="text/javascript" src="<?=base_url('js/plugins/jquery-form/jquery.form.js')?>"></script>

        <script>
        jQuery(document).ready(function() {
            $('.modify').submit(function() { return submit_page(this) });
        });

        function submit_page(form) {
            var password = $("#password").val();
            var confirm_password = $("#confirm-password").val();

            if (password != confirm_password) {
                $("#tips").css('display', 'block');
                $("#tips").html('密码与确认密码不一致');
                return false;
            }

            var options = {
                dataType: 'json',
                error: function() {
                    $("#tips").css('display', 'block');
                    $("#tips").html('连接服务器时发生错误，请重试');
                },
                success: function(info) {
                    if (info['status'] == 'error') {
                        $("#tips").css('display', 'block');
                        $("#tips").html(info['content']);
                    } else {
                        $("#tips").css('display', 'none');
                        location.href = '<?=site_url('admin/user')?>';
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }
        </script>
    </body>
</html>
