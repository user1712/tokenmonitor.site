<?php
$settings = new Settings();
$arr = $settings->getSetting();
if ($_POST) {
    $settings->name = $_POST['name'];
    $settings->email = $_POST['email'];
    $result = $settings->setSetting();
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
            <li><a href="/admin/settings">Настройки сайта</a></li>
        </ol>
        <h1>Настройки сайта</h1>
        <div class="row">
            <div class="col-md-12">
                <form role="form" id="templatemo-preferences-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label for="firstName" class="control-label">Название сайта</label>
                            <input type="text" class="form-control" id="firstName" name="name"
                                   value="<?php echo $arr['name'];?>" required>
                        </div>
                        <div class="col-md-6 margin-bottom-15">
                            <label for="lastName" class="control-label">E-mail</label>
                            <input type="text" class="form-control" id="lastName" name="email"
                                   value="<?php echo $arr['email'];?>">
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
