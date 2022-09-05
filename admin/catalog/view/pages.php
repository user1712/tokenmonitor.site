<?php
$pages = new Pages();

if ($_POST['dea']) {
    $pages->deaPage($_POST['dea']);
}
if ($_POST['good']) {
    $pages->actPage($_POST['good']);
}
if ($_POST['remove']) {
    $pages->removePage($_POST['remove']);
}
?>
<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
        <ol class="breadcrumb">
            <li><a href="/admin">Панель</a></li>
            <li><a href="/admin/pages">Страницы</a></li>
        </ol>
        <h1>Страницы</h1>
        <div class="row">
            <div class="col-md-12">

                <div class="table-responsive">

                    <ul class="nav nav-pills">
                        <li class="active"><a href="/admin/newpage">Добавить страницу</a></li>
                    </ul>
                    <br>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Страница</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($pages->getPages() as $value) {
                            if ($value['status'] == 0) {
                                $status = 'danger';
                            } else {   $status = 'success';}
                            ?>
                            <tr class="<?php echo $status;?>">
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['h1']; ?></td>
                                <td>
                                    <form method="post">
                                        <a class="btn btn-success" name="edit" href="<?php echo $pages->getPageUrl($value['id']);?>">Редактировать
                                        </a>
                                        <button class="btn btn-warning" name="dea"
                                                value="<?php echo $value['id']; ?>">Отключить
                                        </button>
                                        <button class="btn btn-primary" name="good"
                                                value="<?php echo $value['id']; ?>">Включить
                                        </button>
                                        <button class="btn btn-danger" name="remove"
                                                value="<?php echo $value['id']; ?>">Удалить
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>