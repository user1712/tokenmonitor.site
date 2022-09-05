<?php
$pages = new Pages();
if(isset($_POST['h1'])) {
    $pages->h1 = $_POST['h1'];
    $pages->desc = $_POST['desc'];
    $pages->text = $_POST['text'];
    $pages->url = Db::translit($pages->h1);
    $result = $pages->setPages();
}

?>
<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
        <?php if ($_POST) { ?>
            <?php if ($result == false) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                    Неудалось сохранить данные! Проверьте правильность заполнения формы!
                </div>
            <?php } ?>
            <?php if ($result == true) { ?>
                <div class="alert alert-success alert-dismissible" role="sucess">
                    <button type="button" class="close" data-dismiss="sucess"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                    Данные успешно сохранение!
                </div>
            <?php } ?>
        <?php } ?>
        <ol class="breadcrumb">
            <li><a href="/admin/">Панель</a></li>
            <li><a href="/admin/newpage">Новая страница</a></li>
        </ol>
        <h1>Новая страница</h1>
        <div class="row">
            <div class="col-md-12">
                <form role="form" id="templatemo-preferences-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 margin-bottom-15">
                            <label for="firstName" class="control-label">Название старницы H1</label>
                            <input type="text" class="form-control" id="firstName" name="h1" required>
                        </div>
                        <div class="col-md-12 margin-bottom-15">
                            <label for="notes">Мета-тег Description</label>
                            <textarea class="form-control" rows="3" id="desc" name="desc"></textarea>
                        </div>
                        <div class="col-md-12 margin-bottom-15">
                            <label for="notes">Описание</label>
                            <textarea class="form-control" rows="20" id="text" name="text"></textarea>
                        </div>
                    </div>

                    <div class="row templatemo-form-buttons">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Сохранить</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="libs/js/jquery.min.js"></script>
<script>
    $("#singleSelect").change(function () {
        var category_id = $("#singleSelect option:selected").val();
        var block = `#block${category_id}`
        $(".checkbox").css("display", "none");
        $(block).css("display", "block");
    });
</script>
