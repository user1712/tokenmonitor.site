<?php

$category = new Categories();
if (isset($_POST['remove'])) {
    $category->category_id = $_POST['category_id'];
    $category->removeCategory();
}
if (isset($_POST['remove2'])) {
    $category->category_id = $_POST['category_id2'];
    $category->removeCategory();
}
?>
<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
        <ol class="breadcrumb">
            <li><a href="/admin">Панель</a></li>
            <li><a href="/admin">Каталог организаций</a></li>
        </ol>
        <h1>Каталог организаций</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
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
                                <input type="hidden" value="<?php echo $value['id']; ?>" name="category_id">
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <td onclick="list<?php echo $value['id']; ?>()">
                                        <a><?php echo $value['category']; ?></a></td>
                                    <td>
                                        <button type="submit" name="remove" class="btn btn-info">Удалить</button>
                                    </td>
                                </tr>

                            <?php foreach ($category->getFinalCategories($value['id']) as $item) { ?>
                            <input type="hidden" value="<?php echo $item['id']; ?>" name="category_id2">
                                <tr class="ind<?php echo $value['id']; ?>" style="display: none">
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['category']; ?></td>
                                    <td>
                                        <button type="submit" name="remove2" class="btn btn-info">Удалить</button>
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