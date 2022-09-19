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

            <h1> <i class="fa fa-users"></i> Администраторы & Пользователей </h1>

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
                        foreach ($_POST['selectOneCheckBoxArray'] as $checked_Box_User_Id)
                        {
                            $group_options = $_POST['group_options'];
                            switch ($group_options) {
                                case '1':
                                    $sql_group_publish = "UPDATE users SET status= '{$group_options}' WHERE id={$checked_Box_User_Id}";
                                    $result_sql_group_publish= mysqli_query($dbconnection, $sql_group_publish);
                                    break;
                                case '0':
                                    $sql_group_unpublish = "UPDATE users SET status= '{$group_options}' WHERE id={$checked_Box_User_Id}";
                                    $result_sql_group_unpublish= mysqli_query($dbconnection, $sql_group_unpublish);
                                    break;
                                case 'delete':
                                    $sql_group_delete = "DELETE FROM users WHERE id ={$checked_Box_User_Id}";
                                    $result_sql_group_delete = mysqli_query($dbconnection, $sql_group_delete);
                                    header("Location: users_admin.php");
                                    # code...
                                    break;

                                default:
                                    # code...
                                    break;
                            }
                        }
                        header("Location: users_admin.php");
                    }

                    ?>


                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#InsertUser"><i class="fa fa-user-secret" aria-hidden="true"></i> Добавить нового Администраторы & Пользователей </button>
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
                                <th style="text-align: center;"><i class="fa fa-address-card" aria-hidden="true"></i> Полное имя пользователя </th>
                                <th style="text-align: center;"><i class="fa fa-user-secret" aria-hidden="true"></i> Логин пользователя </th>
                                <th style="text-align: center;"><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail </th>
                                <th style="text-align: center;"><i class="fa fa-picture-o" aria-hidden="true"></i> Картинка </th>
                                <th style="text-align: center;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус </th>
                                <th style="text-align: center;"><i class="fa fa-asterisk" aria-hidden="true"></i> Типы </th>
                                <th style="text-align: center;"><i class="fa fa-houzz" aria-hidden="true"></i> Изменить и Удалить </th>
                            </tr>
                            <?php
                            $sql_select_users = "SELECT * FROM users ORDER BY id desc";
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
                            ?>
                            <tbody id="myTable">
                            <tr class="success">
                                <td style="text-align: center;">
                                    <input type="checkbox" class="form-check-input" id="selectOneCheckBoxArray" name="selectOneCheckBoxArray[]" value="<?php echo $view_users_id; ?>">
                                </td>
                                <td style="text-align: center;"><?php echo $view_users_name ?></td>
                                <td style="text-align: center;"><?php echo $view_users_username ?></td>
                                <td style="text-align: center;"><?php echo $view_users_email ?></td>
                                <td style="text-align: center;"><img  class="zoom" src="images/users/<?php  echo $view_users_image; ?>" width="50"></td>
                                <?php
                                if ($view_users_status==1)
                                {
                                    ?>
                                    <td style="text-align: center;"><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Активный </span></td>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <td style="text-align: center;"><span class="label label-warning"> В ожидании </span></td>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($view_users_type==1)
                                {
                                    ?>
                                    <td style="text-align: center;"><span class="label label-primary"><i class="fa fa-user-secret" aria-hidden="true"></i> Администратор </span></td>

                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <td style="text-align: center;"><span class="label label-primary"> Пользователь </span></td>

                                    <?php
                                }
                                ?>

                                <td style="text-align: center;">
                                    <button type="button" name="edit" class="btn btn-warning" data-toggle="modal" data-target="#EditUser" data-user_id_edit="<?= $view_users_id ?>" data-user_name_edit="<?= $view_users_name ?>" data-user_username_edit="<?= $view_users_username ?>" data-user_email_edit="<?= $view_users_email ?>" data-user_image_edit="<?= $view_users_image ?>" data-user_type_edit="<?= $view_users_type ?>" data-user_type_edit1="<?= $view_users_type ?>" data-user_gender_edit="<?= $view_users_gender ?>" data-user_password_edit="<?= $view_users_password ?>" > <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Редактировать </button>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteUser" data-user_id_delete="<?= $view_users_id ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Удалить </button>
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
        <?php include "layout/modal/add_new_user.php" ?>
        <!-- // Modal add new category -->
        <!-- Modal Delete Category-->
        <?php include "layout/modal/delete_user.php" ?>
        <!-- // Modal Delete Category-->
        <!-- Modal EDIT  user -->
        <?php include "layout/modal/edit_user.php" ?>
        <!-- // Modal EDIT  user -->
        <!-- Modal add new post -->
        <?php include "layout/modal/add_new_post.php"; ?>
        <!-- // Modal add new Post -->
    </div>
    <!-- /.content-wrapper -->
    <?php include "layout/footer.php"; ?>

    <?php include "layout/rightsidebar.php"; ?>
    <!-- ./wrapper -->
    <?php include "layout/scripts.php"; ?>



</body>
</html>
