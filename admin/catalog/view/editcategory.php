<?php
$categories = new Categories();

if ($_POST['edit']) {
    $categories->category_id = $_POST['edit'];
    $categories->category_name = $_POST['company'];
    $categories->parent = $_POST['category'];
    $categories->url = Db::translit($categories->category_name);
    $result = $categories->updCategory();
    if ($result) {
        header("Refresh: 1");
    }
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
            <li><a href="/admin/newcategory">Новая Категория</a></li>
        </ol>
        <h1>Новая компания</h1>
        <div class="row">
            <div class="col-md-12">
                <form role="form" id="templatemo-preferences-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label for="firstName" class="control-label">Название категории</label>
                            <input type="text" class="form-control" id="firstName" name="company" value="<?php echo $sbi['arr']['category'];?>" required>
                        </div>
                        <div class="col-md-6 margin-bottom-15">
                            <label for="singleSelect">Категория</label>
                            <select class="form-control margin-bottom-15" id="singleSelect" name="category" required>>
                                <?php if($sbi['arr']['parent'] == 0) { ?>
                                    <option value="0"><?php if($sbi['arr']['parent'] == 0) {echo 'Категория 1-го уровня'; };?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $sbi['arr']['parent'];?>"><?php echo $categories->getCategoryName($sbi['arr']['parent']);?></option>
                                <?php } ?>
                                   <?php foreach ($categories->getParentCategory() as $value) { ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['category'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row templatemo-form-buttons">
                        <div class="col-md-12">
                            <button type="submit" name="edit" value="<?php echo $sbi['arr']['id'];?>" class="btn btn-primary">Сохранить</button>

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
