<?php
$categories = new Categories();
$products = new Products();
if ($_POST) {
    $products->product = $_POST['company'];
    $products->location = $_POST['location'];
    $products->phone = $_POST['phone'];
    $products->email = $_POST['email'];
    $products->text = $_POST['text'];
    $products->category_id = $_POST['category'];
    $products->category_id_2 = $_POST['category_2'];
    $products->image = $_FILES['userfile']['name'];


   $result = $products->setProduct($_FILES);


}

?>
<div class="templatemo-content-wrapper">
    <div class="templatemo-content">
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
        <ol class="breadcrumb">
            <li><a href="/admin/">Панель</a></li>
            <li><a href="/admin/newproduct">Новая компания</a></li>
        </ol>
        <h1>Новая компания</h1>
        <div class="row">
            <div class="col-md-12">
                <form role="form" id="templatemo-preferences-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label for="firstName" class="control-label">Название компании</label>
                            <input type="text" class="form-control" id="firstName" name="company" required>
                        </div>
                        <div class="col-md-6 margin-bottom-15">
                            <label for="lastName" class="control-label">Адрес</label>
                            <input type="text" class="form-control" id="lastName" name="location">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 margin-bottom-15">
                            <label for="firstName" class="control-label">Телефон</label>
                            <input type="text" class="form-control" id="firstName" name="phone" required>
                        </div>
                        <div class="col-md-6 margin-bottom-15">
                            <label for="lastName" class="control-label">E-mail</label>
                            <input type="text" class="form-control" id="lastName" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 margin-bottom-15">
                            <label for="notes">Описание</label>
                            <textarea class="form-control" rows="3" id="notes" name="text" required></textarea>
                        </div>
                    </div>
                    <label for="singleSelect">Категория</label>
                    <select class="form-control margin-bottom-15" id="singleSelect" name="category" required>>
                        <option value="0">Выберите...</option>
                        <?php foreach ($categories->getParentCategory() as $value) { ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['category'] ?></option>
                        <?php } ?>
                    </select>

                    <?php foreach ($categories->getBlockCategories() as $value) { ?>
                        <div class="checkbox" id="block<?php echo $value['parent']; ?>" style="display:none">
                            <?php foreach ($categories->getFinalCategories($value['parent']) as $category) { ?>
                                <label>
                                    <input type="radio" name="category_2"
                                           value="<?php echo $category['id'] ?>"> <?php echo $category['category']; ?>
                                </label><br>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12 margin-bottom-30">
                            <label for="exampleInputFile">Логотип</label>
                            <input type="file" id="exampleInputFile" name="userfile">
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
