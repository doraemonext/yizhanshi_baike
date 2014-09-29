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
                <h3>管理日志</h3>
            </div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>管理员</th>
                    <th>日期</th>
                    <th>操作记录</th>
                </tr>
                <?php foreach ($log as $item): ?>
                <tr>
                    <td>
                        <?=$item['username']?>
                    </td>
                    <td>
                        <?=$item['datetime']?>
                    </td>
                    <td>
                        <?=$item['content']?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div><!--/span-->
    </div><!--/row-->
    <?php $this->load->view('admin/templates/footer'); ?>
</div>

<?php $this->load->view('admin/templates/js_global'); ?>
</body>
</html>
