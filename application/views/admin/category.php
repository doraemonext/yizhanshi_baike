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
                    <button class="btn btn-success" onclick="window.location.href='<?=site_url('admin/category/add')?>'">新建分类</button>
                    <br><br>
                    <div class="alert alert-warning">
                        请注意，当删除某个分类后，<strong>该分类下的所有问题及回复也将一并删除</strong>，请慎重
                    </div>
                    <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success" id="flash-tips"><?=$this->session->flashdata('success')?></div>
                    <?php endif; ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>分类名称</th>
                                <th style="width: 120px;">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($category as $row): ?>
                            <tr>
                                <td>
                                    <?=$row['title']?>
                                </td>
                                <td>
                                    <button class="btn btn-small btn-primary" onclick="window.location.href='<?=site_url('admin/category/modify_category').'/'.$row['id']?>'">修改</button>
                                    <button class="btn btn-small btn-danger" onclick="delete_category(<?=$row['id']?>)">删除</button>
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
        function delete_category(id) {
            $.ajax({
                url: '<?=site_url('admin/category/delete_category')?>',
                data: { id: id },
                cache: false,
                dataType: 'json',
                async: false,
                success: function(info) {
                    location.reload();
                }
            });
        }
        </script>
    </body>
</html>
