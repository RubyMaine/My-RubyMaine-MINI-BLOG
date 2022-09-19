<header class="main-header">
    <a href="index.php" class="logo" ><i class="fa fa-diamond" aria-hidden="true" style="color: red;"></i><b> RubyMaine </b> Admin</a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle btn btn-danger" data-toggle="push-menu" role="button" style="background-color:red;">
            <span class="sr-only"> Переключить навигацию </span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <?php
                    $sql_select_new_comment = "SELECT * FROM comments WHERE comm_status=0";
                    $result_sql_select_new_comment = mysqli_query($dbconnection, $sql_select_new_comment);
                    $count_new_comments = 0 ;
                    while ($rowcomment = mysqli_fetch_assoc($result_sql_select_new_comment))
                    {
                     $count_new_comments++;
                    }
                ?>

                <li>
                    <a href="comment_admin.php" class="btn btn-info">
                        <i class="fa fa-comment"></i>
                        <span class="hidden-xs"> Отправленные комментарии </span>
                        <span class="label label-success"><?php echo $count_new_comments; ?></span>
                    </a>
                </li>

                <li data-toggle="modal" data-target="#InsertPost">
                    <a href="#" class="btn btn-warning">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        <span class="hidden-xs"> Добавить Новости </span>
                    </a>
                </li>

    <!-- Modal add new post -->
                <?php //include "layout/modal/add_new_post.php"; ?>
    <!-- Modal add new Post -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown">
                        <img src="images/users/<?php echo $success_login_image_admin; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $success_login_name_admin; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="images/users/<?php echo $success_login_image_admin; ?>" style="border-radius: 50px;" alt="User Image">
                            <p>
                                <?php echo $success_login_name_admin; ?><br> Веб-разработчик
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <button type="button" name="edit" class="btn btn-success btn-flat" style="border-radius: 3px;" data-toggle="modal" data-target="#EditUser" data-user_id_edit="<?= $success_login_id ?>" data-user_name_edit="<?= $success_login_name_admin ?>" data-user_username_edit="<?= $success_login_username_admin ?>" data-user_email_edit="<?= $success_login_email_admin ?>" data-user_image_edit="<?= $success_login_image_admin ?>" data-user_type_edit="<?= $success_login_type_admin ?>" data-user_type_edit1="<?= $success_login_type_admin ?>" data-user_gender_edit="<?= $success_login_gender_admin ?>" data-user_password_edit="<?= $success_login_type_password_admin ?>" > <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Настроит профиль </button>
                            </div>
                            <div class="pull-right">
                                <a href="../layout/logout.php" class="btn btn-danger btn-flat" style="border-radius: 3px;" > Выход <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>