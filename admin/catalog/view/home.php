<?php
$products = new Products();
$category = new Categories();
if($_SESSION['sort'] == 1) {
    $products->sort = 'rate';
}
if($_SESSION['sort'] == 2) {
    $products->sort = 'company_id';
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
                <div class="btn-group pull-right" id="templatemo_sort_btn">
                    <button type="button" class="btn btn-default">Сортировка</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/admin/sort1">По рейтигу</a></li>
                        <li><a href="/admin/sort2">По новизне</a></li>

                    </ul>
                </div>
                <div class="table-responsive">

                    <ul class="nav nav-pills">
                        <li class="active"><a href="/admin/newproduct">Добавить организацию</a></li>
                    </ul>

                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Компания</th>
                            <th>Локация</th>
                            <th>Телефон</th>
                            <th>E-mail</th>
                            <th>Категория</th>
                            <th>Дата</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($products->getProducts($page) as $value) { ?>
                            <?php if (strlen($value['site']) > 5) {
                                $site = '<li><a href="https://' . $value['site'] . '" target="_blank">Сайт</a></li>';
                            }
                            $category->category_id = $value['category_id'];
                            ?>
                            <tr>
                                <td><?php echo $value['company_id']; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['location']; ?></td>
                                <td><?php echo $value['phone']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $category->getCategory()['category']; ?></td>
                                <td><?php echo $value['date']; ?></td>
                                <td>
                                    <!-- Split button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">Действие</button>
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <?php $products->product = $value['company_id']; ?>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo $products->getProductUrl(); ?>">Изменить</a></li>
                                            <?php echo $site; ?>
                                            <li><a href="<?php echo $products->getProductUrl(); ?>">Удалить</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <?php
                            {
                                unset($site);
                            }
                        } ?>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination pull-right">
                    <li class=""><a href="/admin/page_1">«</a></li>
                    <?php if ($page > 10) {
                        $start = $page - 10;
                    } else {
                        $start = 1;
                    }
                    ?>
                    <?php foreach (range($start, $products->getProductsPages()) as $value) { ?>
                        <?php if($value > 10) {if($page < 5){continue;}} ?>
                            <?php if($value == $page) {$act = 'class="active"';} ?>
                        <li <?php echo $act;?>><a href="/admin/page_<?php echo $value; ?>"><?php echo $value; ?> <span
                                        class="sr-only">(current)</span></a></li>

                    <?php unset($act);} ?>
                    <li><a href="/admin/page_<?php echo $products->getProductsPages();?>">»</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>