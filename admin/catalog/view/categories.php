<?php

$category = new Categories();

if (isset($_POST['category_id'])) {
    $category->category_id = $_POST['category_id'];
    $category->removeCategory();
}
if (isset($_POST['category_id2'])) {
    $category->category_id = $_POST['category_id2'];
    $category->removeCategory();

}
?>
<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
        <ol class="breadcrumb">
            <li><a href="/admin">Панель</a></li>
            <li><a href="/admin/categories">Категории</a></li>
        </ol>
        <h1>Категории</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="/admin/newcategory">Добавить категорию</a></li>
                    </ul>
                    <br>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Компания</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form method="post">
                            <?php foreach ($category->getParentCategory() as $value) { ?>
                                 <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <td onclick="list<?php echo $value['id']; ?>()">
                                        <a><?php echo $value['category']; ?></a></td>
                                    <td>
                                        <a href="<?php echo $category->getCategoryUrl($value['id']); ?>" type="submit"
                                           name="edit" class="btn btn-primary">Редактировать</a>
                                        <button type="submit" name="category_id" class="btn btn-info" value="<?php echo $value['id']; ?>" >Удалить</button>
                                    </td>
                                </tr>

                            <?php foreach ($category->getFinalCategories($value['id']) as $item) { ?>
                                <tr class="ind<?php echo $value['id']; ?>" style="display: none">
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['category']; ?></td>
                                    <td>
                                        <a href="<?php echo $category->getCategoryUrl($item['id']); ?>" type="submit"
                                           name="edit" class="btn btn-primary">Редактировать</a>
                                        <button type="submit" name="category_id2" value="<?php echo $item['id']; ?>" class="btn btn-info">Удалить</button>
                                    </td>
                                </tr>
                            <?php } ?>
                                <script>
                                    function list<?php echo $value['id']; ?>() {
                                        $(".ind<?php echo $value['id'];?>").toggle();
                                    }
                                </script>
                            <?php } ?>
                        </form>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>