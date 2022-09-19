<?php
    $current_date = date('d/m/Y');
    if (isset($_POST['save_category']))
    {
        $add_cat_title=$_POST['cat_title'];
        $add_cat_desc=$_POST['cat_desc'];
        $add_cat_slug=$_POST['cat_slug'];
        $add_cat_date=$_POST['cat_date'];
        $add_cat_edit_date=$_POST['cat_edit_date'];
        $add_cat_status=$_POST['cat_status'];
        $add_cat_priority=$_POST['cat_priority'];

        $add_cat_title = mysqli_real_escape_string($dbconnection, $add_cat_title);
        $add_cat_desc = mysqli_real_escape_string($dbconnection, $add_cat_desc);
        $add_cat_slug = mysqli_real_escape_string($dbconnection, $add_cat_slug);
        $add_cat_status = mysqli_real_escape_string($dbconnection, $add_cat_status);

        $sql_add_category = "INSERT INTO categories(cat_title,cat_desc, cat_slug, cat_date, cat_edit_date, cat_status, cat_priority) VALUES('$add_cat_title', '$add_cat_desc', '$add_cat_slug', '$current_date', '$current_date', '$add_cat_status', '$add_cat_priority')";
        $result_sql_add_category= mysqli_query($dbconnection, $sql_add_category);
        if (!$result_sql_add_category){
                  die("Error description:" . mysqli_error());
                }else{
                  echo "Data added successfully";
        header("Location: category_admin.php");
        }
    }
?>

<div class="modal fade" id="InsertCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header modal-header-add">
                <h4 class="modal-title" id="exampleModalLongTitle" align="center"><i class="fa fa-th-list" aria-hidden="true"></i> Добавить новую категорию <button type="button" class="close btn btn-danger" data-dismiss="modal"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button></h4>
            </div>

            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="cat_title" class="col-form-label"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Заголовок: </label>
                        <input type="text" class="form-control" id="cat_title" name="cat_title" placeholder="Введите название здесь" required="">
                    </div>
                    <div class="form-group">
                        <label for="cat_desc" class="col-form-label"><i class="fa fa-indent" aria-hidden="true"></i> Описание: </label>
                        <input type="text" class="form-control" id="cat_desc" name="cat_desc" placeholder="Введите описание здесь" required="">
                    </div>
                    <div class="form-group">
                        <label for="cat_slug" class="col-form-label"><i class="fa fa-ioxhost" aria-hidden="true"></i> Слизняк: </label>
                        <input type="text" class="form-control" id="cat_slug" name="cat_slug" placeholder="Введите слаг здесь" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cat_status" class="col-form-label"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус: </label><br>
                        <input type="radio" name="cat_status" id="cat_status" value="1" checked=""> Публиковать
                        <input type="radio" name="cat_status" id="cat_status" value="0"> Не публиковать
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cat_priority" class="col-form-label"><i class="fa fa-line-chart" aria-hidden="true"></i> Приоритет категории: </label>
                        <input type="text" class="form-control" id="cat_priority" name="cat_priority" placeholder="Введите номер приоритета категории 0-9" required="">
                    </div>

                    <br><br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Закрывать </button>
                        <button type="submit" class="btn btn-success" name="save_category"> <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Сохранить </button>
                    </div>

              </form>
            </div>
          </div>
        </div>