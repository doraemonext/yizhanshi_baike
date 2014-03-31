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
                    <button class="btn btn-success" onclick="window.location.href='<?=site_url('add')?>'">新建问题</button>
                    <br><br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 30px;">编号</th>
                                <th>问题内容</th>
                                <th>回复内容</th>
                                <th style="width: 120px;">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($question as $row): ?>
                            <tr>
                                <td>
                                    <?=$row['id']?>
                                </td>
                                <td>
                                    <?=$row['title']?>
                                </td>
                                <td>
                                    <?php if ($row['reply_status'] == 0): ?>
                                    <span class="label label-important">您尚未回复该问题</span>
                                    <?php else: ?>
                                    <?=$row['reply']?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['reply_status'] == 0): ?>
                                    <button class="btn btn-small btn-primary" onclick="window.location.href='<?=site_url('question/view').'/'.$row['id']?>'">回复</button>
                                    <?php else: ?>
                                    <button class="btn btn-small btn-default" onclick="window.location.href='<?=site_url('question/view').'/'.$row['id']?>'">修改</button>
                                    <?php endif; ?>
                                    <button class="btn btn-small btn-danger" onclick="delete_question(<?=$row['id']?>)">删除</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?=$pagination?>
                </div><!--/span-->
            </div><!--/row-->
            <?php $this->load->view('admin/templates/footer'); ?>
        </div>

        <?php $this->load->view('admin/templates/js_global'); ?>

        <script>
        function delete_question(id) {
            $.ajax({
                url: '<?=site_url('admin/problem/delete_question')?>',
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
