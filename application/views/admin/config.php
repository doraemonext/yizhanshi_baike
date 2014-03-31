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
                        <h3>系统设定</h3>
                    </div>
                    <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success" id="flash-tips"><?=$this->session->flashdata('success')?></div>
                    <?php endif; ?>
                    <?=form_open('admin/config/process', array('class' => 'form-horizontal config'))?>
                        <div class="alert alert-error" id="tips" style="display: none"></div>
                        <div class="control-group">
                            <label class="control-label" for="title">网站名称</label>
                            <div class="controls">
                                <input id="title" name="title" type="text" value="<?=$site_config['site_title']?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pagination">每页显示问题数目</label>
                            <div class="controls">
                                <input id="pagination" name="pagination" type="text" value="<?=$site_config['pagination_number']?>">
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
            $('.config').submit(function() { return submit_page(this) });
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
                        $("#flash-tips").css('display', 'none');
                        $("#tips").css('display', 'block');
                        $("#tips").html(info['content']);
                    } else {
                        $("#tips").css('display', 'none');
                        location.reload();
                    }
                }
            };
            $(form).ajaxSubmit(options);
            return false;
        }
        </script>
    </body>
</html>
