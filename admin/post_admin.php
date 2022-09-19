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
      <h1> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Все Посты &amp; Новости </h1>
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
               foreach ($_POST['selectOneCheckBoxArray'] as $checked_Box_Post_Id)
               {
                $group_options = $_POST['group_options'];
                switch ($group_options) {
                  case '1':
                    $sql_group_publish = "UPDATE posts SET post_status= '{$group_options}' WHERE id={$checked_Box_Post_Id}";
                     $result_sql_group_publish= mysqli_query($dbconnection, $sql_group_publish);
                    break;
                  case '0':
                    $sql_group_unpublish = "UPDATE posts SET post_status= '{$group_options}' WHERE id={$checked_Box_Post_Id}";
                     $result_sql_group_unpublish= mysqli_query($dbconnection, $sql_group_unpublish);
                    break;
                  case 'delete':
                  $sql_group_delete = "DELETE FROM posts WHERE id ={$checked_Box_Post_Id}";
                  $result_sql_group_delete = mysqli_query($dbconnection, $sql_group_delete);
                  header("Location: post_admin.php");
                    # code...
                    break;
                  
                  default:
                    # code...
                    break;
                }
               }
               header("Location: post_admin.php");
             }

              ?>

          
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InsertPost"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" onclick="mouseOver(this)"></span> Добавить новый пост </button>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <form action="" method="post" onsubmit="return confirm('Are you sure you want to do that?');">
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
              <th style="text-align: center;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Заголовок</th>
              <th style="text-align: center;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Автор </th>
              <th style="text-align: center;"><i class="fa fa-ioxhost" aria-hidden="true"></i> Категории</th>
              <th style="text-align: center;"><i class="fa fa-picture-o" aria-hidden="true"></i> Картинка </th>
              <th style="text-align: center;"><i class="fa far fa-eye" aria-hidden="true"></i> Прасмотры </th>
              <th style="text-align: center;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус </th>
              <th style="text-align: center;"><i class="fa fa-comments" aria-hidden="true"></i> Комментарии </th>
              
              <th style="text-align: center;"><i class="fa fa-houzz" aria-hidden="true"></i> Изменить и Удалить </th>
            </tr>
            <?php 
                $counter= 0;
                $sql_select_post = "SELECT * FROM posts ORDER BY id desc";
                $result_sql_select_post = mysqli_query($dbconnection, $sql_select_post);
                while ($rowpost = mysqli_fetch_assoc($result_sql_select_post))
                {
                  $view_post_id = $rowpost['id'];
                  $view_post_category = $rowpost['post_category'];
                  $view_post_title = $rowpost['post_title'];
                  $view_post_autor = $rowpost['post_autor'];
                  $view_post_date = $rowpost['post_date'];
                  $view_post_edit_date = $rowpost['post_edit_date'];
                  $view_post_image = $rowpost['post_image'];
                  $view_post_text = $rowpost['post_text'];
                  $view_post_tag = $rowpost['post_tag'];
                  $view_post_visit_counter = $rowpost['post_visit_counter'];
                  $view_post_status = $rowpost['post_status'];
                  $view_post_priority = $rowpost['post_priority'];
                 
                  $counter++;
                  
             ?>
             <tbody id="myTable">
            <tr class="success">
              <td style="text-align: center;">
                <input type="checkbox" class="form-check-input" id="selectOneCheckBoxArray" name="selectOneCheckBoxArray[]" value="<?php echo $view_post_id; ?>">
              </td>
              <td style="text-align: left;"><a href="../post.php?postid=<?= $view_post_id; ?>" target="_blank" style="color:black"><?php echo $view_post_title ?></a></td>
              <?php 
                $sql_select_users = "SELECT * FROM users WHERE id={$view_post_autor}";
                $result_sql_select_users = mysqli_query($dbconnection, $sql_select_users);
                while ($rowusers = mysqli_fetch_assoc($result_sql_select_users))
                {
                  $view_users_id = $rowusers['id'];
                  $view_users_name = $rowusers['name'];
                  $view_users_username = $rowusers['username'];
                  $view_users_email = $rowusers['email'];
                  $view_users_password = $rowusers['password'];
                  $view_users_gender = $rowusers['gender'];
                  $view_users_image = $rowusers['image'];
                  $view_users_code = $rowusers['code'];
                  $view_users_status = $rowusers['status'];
                  $view_users_type = $rowusers['type'];
                }
             ?>



              <td style="text-align: center;"><?php echo $view_users_name ?></td>
              <?php 
                    $sql_select_category_by_id = "SELECT * FROM categories WHERE id ={$view_post_category}";
                    $result_sql_select_category_by_id = mysqli_query($dbconnection, $sql_select_category_by_id);
                     while ($rowcategory_by_id = mysqli_fetch_assoc($result_sql_select_category_by_id))
                      {
                        $view_category_id_by_id = $rowcategory_by_id['id'];
                        $view_cat_title_by_id = $rowcategory_by_id['cat_title'];
                        //$view_cat_desc_by_id = $rowcategory_by_id['cat_desc'];
                      } 
              ?>
              <td style="text-align: center;"><?php echo $view_cat_title_by_id ?></td>
              <td style="text-align: center;"><img  class="zoom" src="images/blog/<?php  echo $view_post_image; ?>" width="50"></td>
              <td style="text-align: center;"><span class="label label-success"><?php echo $view_post_visit_counter ?></span></td>
              <?php 
                if ($view_post_status==1)
                {
               ?>
              <td style="text-align: center;"><span class="label label-success"> Опубликовано </span></td>
              <?php 
                }
                else
                {
              ?>
              <td style="text-align: center;"><span class="label label-warning"> Не Опубликовано </span></td>
              <?php
                }
              ?>
              <td style="text-align: center;">
                <span class="label label-success">
                  <?php 
                $sql_select_comment = "SELECT * FROM comments WHERE postid={$view_post_id}";
                $result_sql_select_comment = mysqli_query($dbconnection, $sql_select_comment);
                $count_cooments_for_post=0;
                while ($rowcomment = mysqli_fetch_assoc($result_sql_select_comment))
                {
                  $count_cooments_for_post++;
                }
                echo $count_cooments_for_post++;
             ?>
                  
                </span></td>
              <td style="text-align: center;">

                <button type="button" name="edit" class="btn btn-warning" data-toggle="modal" data-target="#EditPost" data-post_id_edit="<?= $view_post_id ?>" data-post_category_edit="<?= $view_post_category ?>" data-post_title_edit="<?= $view_post_title ?>" data-post_autor_edit="<?= $view_post_autor ?>" data-post_date_edit="<?= $view_post_date ?>" data-post_edit_date_edit="<?= $view_post_edit_date ?>" data-post_image_edit="<?= $view_post_image ?>" data-post_text_edit="<?= $view_post_text ?>" data-post_tag_edit="<?= $view_post_tag ?>" data-post_visit_counter_edit="<?= $view_post_visit_counter ?>" data-post_status_edit="<?= $view_post_status ?>" data-post_priority_edit="<?= $view_post_priority ?>"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Редактировать </button>

               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeletePost" data-post_id_delete="<?= $view_post_id ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Удалить </button>
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
     <!-- Modal add new post -->
    <?php include "layout/modal/add_new_post.php"; ?>
     <!-- // Modal add new Post -->
    <!-- Modal Delete Post-->
    <?php include "layout/modal/delete_post.php"; ?>
    <!-- // Modal Delete Post-->
    <!-- Modal EDIT  Post -->
    <?php include "layout/modal/edit_post.php"; ?>
    <!-- // Modal EDIT  Post -->
    <!-- Modal EDIT  user -->
    <?php include "layout/modal/edit_user.php" ?>
<!-- // Modal EDIT  user -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "layout/footer.php"; ?>

  <?php include "layout/rightsidebar.php"; ?>
<!-- ./wrapper -->
<?php include "layout/scripts.php"; ?>



</body>
</html>
