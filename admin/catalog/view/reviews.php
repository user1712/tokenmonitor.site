<?php
$products = new Products();
$reviews = new Reviews();

if ($_POST['success']) {
    $reviews->reviews_id = $_POST['success'];
    $reviews->setRate();
}
if ($_POST['remove']) {
    $reviews->reviews_id = $_POST['remove'];
    $reviews->removeRate();
}
?>
<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
        <ol class="breadcrumb">
            <li><a href="/admin">Панель</a></li>
            <li><a href="/admin/reviews">Отзывы</a></li>
        </ol>
        <h1>Отзывы</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-right" id="templatemo_sort_btn">
                    <button type="button" class="btn btn-default">Sort by</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">First Name</a></li>
                        <li><a href="#">Last Name</a></li>
                        <li><a href="#">Username</a></li>
                    </ul>
                </div>
                <div class="table-responsive">

                    <ul class="nav nav-pills">
                        <li class="active"><a href="/admin/newproduct">Добавить отзыв</a></li>
                    </ul>

                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Компания</th>
                            <th>Оценка</th>
                            <th>Отзыв</th>
                            <th>Дата</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($reviews->getReviews() as $value) {
                            $products->product_id = $value['product_id'];
                            if ($value['status'] == 0) {
                                $status = 'danger';
                            } else {   $status = 'success';}
                            ?>
                            <tr class="<?php echo $status;?>">
                                <td><?php echo $value['product_id']; ?></td>
                                <td><?php echo $products->getProduct()['name']; ?></td>
                                <td><?php echo $value['rate']; ?></td>
                                <td><?php echo $value['text']; ?></td>
                                <td><?php echo $value['date']; ?></td>
                                <td>
                                    <form method="post">
                                        <button class="btn btn-success" name="success"
                                                value="<?php echo $value['id']; ?>">Одобрить
                                        </button>
                                        <button class="btn btn-danger" name="remove"
                                                value="<?php echo $value['id']; ?>">Удалить
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            <?php
                            {
                                unset($status);
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
                        <?php if ($value > 10) {
                            if ($page < 5) {
                                continue;
                            }
                        } ?>
                        <?php if ($value == $page) {
                            $act = 'class="active"';
                        } ?>
                        <li <?php echo $act; ?>><a href="/admin/page_<?php echo $value; ?>"><?php echo $value; ?> <span
                                        class="sr-only">(current)</span></a></li>

                        <?php unset($act);
                    } ?>
                    <li><a href="/admin/page_<?php echo $products->getProductsPages(); ?>">»</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>