<?php
  ob_start();
  include "db_connection.php";
?>

<!DOCTYPE html>
<html>

<?php include "layout/head.php"; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

    <?php include "layout/header.php"; ?>
    <?php include "layout/leftsidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-th-list" aria-hidden="true"></i> Все Категории </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

           <?php
             if (isset($_POST['selectOneCheckBoxArray']))
             {
                 //header("Location: index.php");
               foreach ($_POST['selectOneCheckBoxArray'] as $checked_Box_Category_Id)
               {
                $group_options = $_POST['group_options'];
                switch ($group_options) {
                  case '1':
                    $sql_group_publish = "UPDATE categories SET cat_status= '{$group_options}' WHERE id={$checked_Box_Category_Id}";
                     $result_sql_group_publish= mysqli_query($dbconnection, $sql_group_publish);
                    break;
                  case '0':
                    $sql_group_unpublish = "UPDATE categories SET cat_status= '{$group_options}' WHERE id={$checked_Box_Category_Id}";
                     $result_sql_group_unpublish= mysqli_query($dbconnection, $sql_group_unpublish);
                    break;
                  case 'delete':
                  $sql_group_delete = "DELETE FROM categories WHERE id ={$checked_Box_Category_Id}";
                  $result_sql_group_delete = mysqli_query($dbconnection, $sql_group_delete);
                  header("Location: category_admin.php");
                    # code...
                    break;

                  default:
                    # code...
                    break;
                }
               }
               header("Location: category_admin.php");
             }

              ?>


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InsertCategory"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Добавить новую категорию </button>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <form action="" method="post">
           <table width=100%>
            <tr>
               <th>
                 <select class="form-control" id="group_options" name="group_options">
                    <option value="" disabled selected> Выберите Групповое действие </option>
                    <option value="delete"> Удалить </option>
                    <option value="1"> Публиковать </option>
                    <option value="0"> Не публиковать </option>
                 </select>
               </th>
               <th>&nbsp;</th>



               <th>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
                </script>
                  <input class="col-xs-4" type="text" id="myInput" aria-label="Search" placeholder="Поиск">&nbsp;
                   <button class="btn btn-search" type="submit" name="applyed"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Применить </button>
              </th>


             </tr>

           </table>
            <br>
          <table class="table table-hover">
            <tr class="info">
              <th style="text-align: center;">
                <input type="checkbox" class="form-check-input" id="selectAllCategoryCheckbox" name="selectAllCategoryCheckbox">
              </th>
              <th style="text-align: center;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Заголовок </th>
              <th style="text-align: center;"><i class="fa fa-list-alt" aria-hidden="true"></i> Описание </th>
              <th style="text-align: center;"><i class="fa fa-ioxhost" aria-hidden="true"></i> Категории </th>
              <th style="text-align: center;"><i class="fa fa-indent" aria-hidden="true"></i> Посты & Новости </th>
              <th style="text-align: center;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус </th>
              <th style="text-align: center;"><i class="fa fa-houzz" aria-hidden="true"></i> Изменить и Удалить </th>
            </tr>
            <?php
                $counter= 0;
                $sql_select_category = "SELECT * FROM categories ORDER BY id desc";
                $result_sql_select_category = mysqli_query($dbconnection, $sql_select_category);
                while ($rowcategory = mysqli_fetch_assoc($result_sql_select_category))
                {
                  $view_category_id = $rowcategory['id'];
                  $view_cat_title = $rowcategory['cat_title'];
                  $view_cat_desc = $rowcategory['cat_desc'];
                  $view_cat_slug = $rowcategory['cat_slug'];
                  $view_cat_status = $rowcategory['cat_status'];
                  $view_cat_priority = $rowcategory['cat_priority'];
                  $view_cat_date = $rowcategory['cat_date'];
                  $counter++;

             ?>
             <tbody id="myTable">
            <tr class="success">
              <td style="text-align: center;">
                <input type="checkbox" class="form-check-input" id="selectOneCheckBoxArray" name="selectOneCheckBoxArray[]" value="<?php echo $view_category_id; ?>">
              </td>
              <td style="text-align: center;"><?php echo $view_cat_title ?></td>
              <td style="text-align: center;"><?php echo $view_cat_desc ?></td>
              <td style="text-align: center;"><?php echo $view_cat_slug ?></td>
              <?php
                $posts_category_counter= 0;
                $sql_select_category_posts = "SELECT * FROM posts WHERE post_category={$view_category_id}";
                $result_sql_selectcategory_posts = mysqli_query($dbconnection, $sql_select_category_posts);
                while ($rowcategorypost = mysqli_fetch_assoc($result_sql_selectcategory_posts))
                {
                  $posts_category_counter++;
                }
             ?>
              <td style="text-align: center;"><?php echo $posts_category_counter; ?></td>
              <?php
                if ($view_cat_status==1)
                {
               ?>
              <td style="text-align: center;"><span class="label label-success"> Опубликовано </span></td>
              <?php
                }
                else
                {
              ?>
              <td style="text-align: center;"><span class="label label-warning">Не Опубликовано</span></td>
              <?php
                }
              ?>
              <td style="text-align: center;">

                <button type="button" name="edit" class="btn btn-warning" data-toggle="modal" data-target="#EditCategory" data-category_id_edit="<?= $view_category_id ?>" data-category_title_edit="<?= $view_cat_title ?>" data-cat_desc_edit="<?= $view_cat_desc ?>" data-cat_slug_edit="<?= $view_cat_slug ?>" data-cat_priority_edit="<?= $view_cat_priority ?>" data-cat_date_edit="<?= $view_cat_date ?>"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Редактировать </button>

               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteCategory" data-category_id_delete="<?= $view_category_id ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Удалить </button>
              </td>
            </tr>
            <?php
                }
             ?>
             </tbody>
          </table>
          </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"> Предыдущий </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#"> Следующий </a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
     <!-- Modal add new category -->
      <?php include "layout/modal/add_new_category.php" ?>
     <!-- // Modal add new category -->
    <!-- Modal Delete Category-->
      <?php include "layout/modal/delete_category.php" ?>
    <!-- // Modal Delete Category-->
    <!-- Modal EDIT  category -->
    <?php include "layout/modal/edit_category.php" ?>
<!-- // Modal EDIT  category -->
<!-- Modal add new post -->
    <?php include "layout/modal/add_new_post.php"; ?>
     <!-- // Modal add new Post -->
     <!-- Modal EDIT  user -->
    <?php include "layout/modal/edit_user.php" ?>
<!-- // Modal EDIT  user -->

  </div>
  <!-- /.content-wrapper -->
        <!-- // <?php include "layout/footer.php"; ?> -->

  <?php include "layout/rightsidebar.php"; ?>
<!-- ./wrapper -->
<?php include "layout/scripts.php"; ?>



</body>
</html>
