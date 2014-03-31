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
                    <button class="btn btn-success" onclick="window.location.href='<?=site_url('admin/user/add')?>'">新建管理员</button>
                    <br><br>
                    <div class="alert alert-warning">
                        请注意，当删除某个管理员后，<strong>该管理员所回答问题的回复人将置空</strong>
                    </div>
                    <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success" id="flash-tips"><?=$this->session->flashdata('success')?></div>
                    <?php endif; ?>
                    <div class="alert alert-error" id="tips" style="display: none"></div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>管理员用户名</th>
                                <th style="width: 120px;">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $row): ?>
                            <tr>
                                <td>
                                    <?=$row['username']?>
                                </td>
                                <td>
                                    <button class="btn btn-small btn-primary" onclick="window.location.href='<?=site_url('admin/user/modify_password').'/'.$row['id']?>'">修改密码</button>
                                    <button class="btn btn-small btn-danger" onclick="delete_user(<?=$row['id']?>)">删除</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!--/span-->
            </div><!--/row-->
            <?php $this->load->view('admin/templates/footer'); ?>
        </div>

        <?php $this->load->view('admin/templates/js_global'); ?>

        <script>
        function delete_user(id) {
            $.ajax({
                url: '<?=site_url('admin/user/delete_user')?>',
                data: { id: id },
                cache: false,
                dataType: 'json',
                async: false,
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
            });
        }
        </script>
    </body>
</html>
