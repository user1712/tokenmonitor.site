<?php
$categories = new Categories();
$products = new Products();
$reviews = new Reviews();


if ($_POST['delete'] > 0) {
    $result = $products->removeProduct($_POST['delete']);
    if ($result) {
        header("Location: /admin");
    }
}

if ($_POST['save'] == 1) {
    $products->product = $_POST['company'];
    $products->product_id = $_POST['product_id'];
    $products->location = $_POST['location'];
    $products->phone = $_POST['phone'];
    $products->email = $_POST['email'];
    $products->text = $_POST['text'];
    $products->site = $_POST['site'];
    $products->category_id = $_POST['category'];
    $products->category_id_2 = $_POST['category_2'];
    $products->image = $_FILES['userfile']['name'];


    $result = $products->updateProduct($_FILES);

    if ($result) {
        header("Refresh: 1");
    }
}

if ($_POST['star'] > 0) {
    $reviews->product_id = $_POST['product_id'];
    $reviews->name = $_POST['name'];
    $reviews->email = $_POST['email'];
    $reviews->rate = $_POST['star'];
    $reviews->text = $_POST['review'];
    $result = $reviews->addReview();

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
            <li><a href="/admin/newproduct">Редактирование компании</a></li>
        </ol>
        <h1>Редактирование компании</h1>
        <div class="col-md-8 col-sm-8">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="templatemo-tabs">
                <li class="active"><a href="#home" role="tab" data-toggle="tab">Редактирование</a></li>
                <li class=""><a href="#profile" role="tab" data-toggle="tab">Добавить отзыв</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" id="templatemo-preferences-form" method="post"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="firstName" class="control-label">Название компании</label>
                                        <input type="text" class="form-control" id="firstName" name="company"
                                               value="<?php echo $sbi['arr']['name']; ?>" required>
                                    </div>
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="lastName" class="control-label">Адрес</label>
                                        <input type="text" class="form-control" id="lastName" name="location"
                                               value="<?php echo $sbi['arr']['location']; ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $sbi['arr']['company_id']; ?>">

                                <div class="row">
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="firstName" class="control-label">Телефон</label>
                                        <input type="text" class="form-control" id="firstName" name="phone"
                                               value="<?php echo $sbi['arr']['phone']; ?>" required>
                                    </div>
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="firstName" class="control-label">Сайт</label>
                                        <input type="text" class="form-control" id="firstName" name="site"
                                               value="<?php echo $sbi['arr']['site']; ?>">
                                    </div>
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="lastName" class="control-label">E-mail</label>
                                        <input type="text" class="form-control" id="lastName" name="email"
                                               value="<?php echo $sbi['arr']['email']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 margin-bottom-15">
                                        <label for="notes">Описание</label>
                                        <textarea class="form-control" rows="3" id="notes" name="text" value=""
                                                  required><?php echo $sbi['arr']['text']; ?></textarea>
                                    </div>
                                </div>
                                <label for="singleSelect">Категория</label>
                                <select class="form-control margin-bottom-15" id="singleSelect" name="category"
                                        required>>
                                    <option value="0">Выберите...</option>
                                    <?php foreach ($categories->getParentCategory() as $value) { ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['category'] ?></option>
                                    <?php } ?>
                                </select>

                                <?php foreach ($categories->getBlockCategories() as $value) { ?>
                                    <div class="checkbox" id="block<?php echo $value['parent']; ?>"
                                         style="display:none">
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
                                        <button type="submit" name="save" value="1" class="btn btn-primary">Сохранить</button>
                                        <button type="submit" name="delete"
                                                value="<?php echo $sbi['arr']['company_id']; ?>"
                                                class="btn btn-danger">Удалить
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile">
                    <style>
                        form .stars {
                            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAABaCAYAAACv+ebYAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMDcvMDMvMTNJ3Rb7AAACnklEQVRoge2XwW3bMBSGPxa9NxtIGzTAW8DdRL7o3A0qb+BrdNIm9QAm0G7gbJBMwB5MoVJNUSRFIXGqHwhkmXr68hOPNH9ljOEt9OlNqBs4RlrrSmtdpdZ/Ti0EGnvtUoqTHFunBVCkuk6d6mbi83rggdteSa5THDeB3+UDO9z2inatXFum1roESuAReAB29vp15n2/gRfgZK+/gIuIXLxgrfUO+Bnzn0fom4ic+pvRVNuB/QrQ/RB6A7bwLjN8b985krO5MsKd0ElwJvgk1AteCPdCYWI5/SutddQxRUTU3DOzG4hd01EKqQnZuaLBITUh4F0CeLYm5CDw6PjuFTjaz9+BLwE1I8VO9StwAEoRaUSkseMHO+aqcWq2qwcdfQCOIvIy8dwDV/c/YL6zvWDbnQ3QuH5hltQEreM1dH/n6g28gT8eWLVUqqVKrb+vtGidFkCR6vp+0uLAba8k1/eRFh1ue0W7dv4sqpaSjGnR1Fy8YNWyY8W0aGpO/c1oqu3AKmlxCL0BW3iXGb637xzJ2VwZ4U7oJDgTfBLqBS+Ee6EQeMpULVFHUVOzPC3aNR2lkJotLbr0vtKiqWlMTcNaaXHQ0QfgaGqcaVG1jNLibGcbYyb/eDIlT6bjyZS+51JqtrS4gTfw/wzWqkKrKrU8fQPR6gKAmDKlPM3x1WkBFKmu0xxf3fZR5jnFdbzjv257JbmOdzx22yvadZzjW7e9ol27HWtVkjEtIubiB2u1Y8W0iJhTfzOe6uvAKmlxCL0FX+FdZvjevnMkd3Plgzuh0+A88EmoH7wM7oVC6AaiVdwuI2Z5WrRrOk4BNVtadOl9pUXENIhpWCstDjr6ABwR40yLaDVKi7Od7U1/Z0pzpjNngtNiaM2WFj8++A+motm0NTqjmwAAAABJRU5ErkJggg==") repeat-x 0 0;
                            width: 150px;
                        }

                        .ie7 form .stars {
                            *zoom: 1;
                        }

                        form .stars:before,
                        form .stars:after {
                            display: table;
                            content: "";
                        }

                        form .stars:after {
                            clear: both;
                        }

                        form .stars input[type="radio"] {
                            position: absolute;
                            opacity: 0;
                            filter: alpha(opacity=0);
                        }

                        form .stars input[type="radio"].star-5:checked ~ span {
                            width: 100%;
                        }

                        form .stars input[type="radio"].star-4:checked ~ span {
                            width: 80%;
                        }

                        form .stars input[type="radio"].star-3:checked ~ span {
                            width: 60%;
                        }

                        form .stars input[type="radio"].star-2:checked ~ span {
                            width: 40%;
                        }

                        form .stars input[type="radio"].star-1:checked ~ span {
                            width: 20%;
                        }

                        form .stars label {
                            display: block;
                            width: 30px;
                            height: 30px;
                            margin: 0 !important;
                            padding: 0 !important;
                            text-indent: -999em;
                            float: left;
                            position: relative;
                            z-index: 10;
                            background: transparent !important;
                            cursor: pointer;
                        }

                        form .stars label:hover ~ span {
                            background-position: 0 -30px;
                        }

                        form .stars label.star-5:hover ~ span {
                            width: 100% !important;
                        }

                        form .stars label.star-4:hover ~ span {
                            width: 80% !important;
                        }

                        form .stars label.star-3:hover ~ span {
                            width: 60% !important;
                        }

                        form .stars label.star-2:hover ~ span {
                            width: 40% !important;
                        }

                        form .stars label.star-1:hover ~ span {
                            width: 20% !important;
                        }

                        form .stars span {
                            display: block;
                            width: 0;
                            position: relative;
                            top: 0;
                            left: 0;
                            height: 30px;
                            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAABaCAYAAACv+ebYAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNXG14zYAAAAWdEVYdENyZWF0aW9uIFRpbWUAMDcvMDMvMTNJ3Rb7AAACnklEQVRoge2XwW3bMBSGPxa9NxtIGzTAW8DdRL7o3A0qb+BrdNIm9QAm0G7gbJBMwB5MoVJNUSRFIXGqHwhkmXr68hOPNH9ljOEt9OlNqBs4RlrrSmtdpdZ/Ti0EGnvtUoqTHFunBVCkuk6d6mbi83rggdteSa5THDeB3+UDO9z2inatXFum1roESuAReAB29vp15n2/gRfgZK+/gIuIXLxgrfUO+Bnzn0fom4ic+pvRVNuB/QrQ/RB6A7bwLjN8b985krO5MsKd0ElwJvgk1AteCPdCYWI5/SutddQxRUTU3DOzG4hd01EKqQnZuaLBITUh4F0CeLYm5CDw6PjuFTjaz9+BLwE1I8VO9StwAEoRaUSkseMHO+aqcWq2qwcdfQCOIvIy8dwDV/c/YL6zvWDbnQ3QuH5hltQEreM1dH/n6g28gT8eWLVUqqVKrb+vtGidFkCR6vp+0uLAba8k1/eRFh1ue0W7dv4sqpaSjGnR1Fy8YNWyY8W0aGpO/c1oqu3AKmlxCL0BW3iXGb637xzJ2VwZ4U7oJDgTfBLqBS+Ee6EQeMpULVFHUVOzPC3aNR2lkJotLbr0vtKiqWlMTcNaaXHQ0QfgaGqcaVG1jNLibGcbYyb/eDIlT6bjyZS+51JqtrS4gTfw/wzWqkKrKrU8fQPR6gKAmDKlPM3x1WkBFKmu0xxf3fZR5jnFdbzjv257JbmOdzx22yvadZzjW7e9ol27HWtVkjEtIubiB2u1Y8W0iJhTfzOe6uvAKmlxCL0FX+FdZvjevnMkd3Plgzuh0+A88EmoH7wM7oVC6AaiVdwuI2Z5WrRrOk4BNVtadOl9pUXENIhpWCstDjr6ABwR40yLaDVKi7Od7U1/Z0pzpjNngtNiaM2WFj8++A+motm0NTqjmwAAAABJRU5ErkJggg==") repeat-x -60px;
                            -webkit-transition: -webkit-width 0.5s;
                            -moz-transition: -moz-width 0.5s;
                            -ms-transition: -ms-width 0.5s;
                            -o-transition: -o-width 0.5s;
                            transition: width 0.5s;
                        }

                    </style>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" id="templatemo-preferences-form" method="post"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="firstName" class="control-label">Имя</label>
                                        <input type="text" class="form-control" id="firstName" name="name" required>
                                    </div>
                                    <div class="col-md-6 margin-bottom-15">
                                        <label for="lastName" class="control-label">E-mail</label>
                                        <input type="text" class="form-control" id="lastName" name="email">
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $sbi['arr']['company_id']; ?>">

                                <div class="radio margin-bottom-15">
                                    <div class="stars">
                                        <input type="radio" name="star" value="1" class="star-1" id="star-1"/>
                                        <label class="star-1" for="star-1">1</label>
                                        <input type="radio" name="star" value="2" class="star-2" id="star-2"/>
                                        <label class="star-2" for="star-2">2</label>
                                        <input type="radio" name="star" value="3" class="star-3" id="star-3"/>
                                        <label class="star-3" for="star-3">3</label>
                                        <input type="radio" name="star" value="4" class="star-4" id="star-4"/>
                                        <label class="star-4" for="star-4">4</label>
                                        <input type="radio" name="star" value="5" class="star-5" id="star-5"/>
                                        <label class="star-5" for="star-5">5</label>
                                        <span></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 margin-bottom-15">
                                        <label for="notes">Отзыв</label>
                                        <textarea class="form-control" rows="3" id="notes" name="review"></textarea>
                                    </div>
                                </div>


                                <div class="row templatemo-form-buttons">
                                    <div class="col-md-12">
                                        <button type="submit" name="review_button" class="btn btn-primary">Сохранить
                                        </button>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- tab-content -->
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
