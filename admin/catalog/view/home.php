<?php
$products = new Products();
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
                        <li class="active"><a href="/admin/newproduct">Добавить организацию</a></li>
                    </ul>

                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Компания</th>
                            <th>Локация</th>
                            <th>Телефон</th>
                            <th>Дата</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products->getProducts() as $value) { ?>
                            <tr>
                                <td><?php echo $value['company_id'];?></td>
                                <td><?php echo $value['name'];?></td>
                                <td><?php echo $value['location'];?></td>
                                <td><?php echo $value['phone'];?></td>
                                <td><?php echo $value['date'];?></td>
                                <td>
                                    <!-- Split button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info">Действие</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Изменить</a></li>
                                            <li><a href="#">Удалить</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <ul class="pagination pull-right">
                    <li class="disabled"><a href="#">«</a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>