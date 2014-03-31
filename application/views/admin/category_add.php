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
                        <h3>新建分类</h3>
                    </div>
                    <?=form_open('admin/category/add_process', array('class' => 'form-horizontal add'))?>
                        <div class="alert alert-error" id="tips" style="display:none"></div>
                        <div class="control-group">
                            <label class="control-label" for="title">分类名称</label>
                            <div class="controls">
                                <input id="title" name="title" type="text">
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
            $('.add').submit(function() { return submit_page(this) });
        });

        function submit_page(form) {
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
                        location.href = '<?=site_url('admin/category')?>';
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }
        </script>
    </body>
</html>
