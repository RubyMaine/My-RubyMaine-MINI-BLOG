<?php include "db_connection.php" ?>

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
                <h1><i class="fa fa-buysellads" aria-hidden="true"></i>дмин панель <small> Панель управления </small></h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">

<!-- START = Container CATEGORY -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <?php
                                $count_categories= 0;
                                $sql_select_categories = "SELECT * FROM categories";
                                $result_sql_select_categories = mysqli_query($dbconnection, $sql_select_categories);
                                while ($rowcategories = mysqli_fetch_assoc($result_sql_select_categories))
                                {
                                  $count_categories++;
                                }
                             ?>
                            <div class="inner">
                                <h3><?php echo $count_categories; ?></h3>
                                <p> Все Категории </p>
                            </div>
                            <div class="icon"> <i class="fa fa-th-list" aria-hidden="true"></i> </div>
                            <a href="category_admin.php" class="small-box-footer"> Больше информации <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
<!-- END = Container CATEGORY -->

<!-- START = Container POSTS -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <?php
                                $counter_posts= 0;
                                $sql_select_posts = "SELECT * FROM posts ORDER BY id desc";
                                $result_sql_select_posts = mysqli_query($dbconnection, $sql_select_posts);
                                while ($rowposts = mysqli_fetch_assoc($result_sql_select_posts))
                                {
                                  $counter_posts++;
                                }
                             ?>
                            <div class="inner">
                              <h3><?php echo $counter_posts; ?></h3>
                              <p> Все Посты & Новости </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            </div>
                            <a href="post_admin.php" class="small-box-footer"> Больше информации <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
<!-- END = Container POSTS -->

<!-- START = Container USERS & ADMINISTRATORS -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <?php
                                $sql_select_users_all = "SELECT * FROM users ORDER BY id desc";
                                $result_sql_select_users_all = mysqli_query($dbconnection, $sql_select_users_all);
                                $count_all_users= 0;
                                while ($rowusers_all = mysqli_fetch_assoc($result_sql_select_users_all))
                                {
                                  $count_all_users++;
                                }
                             ?>
                            <div class="inner">
                              <h3><?php echo $count_all_users; ?></h3>
                              <p> Пользователи и Администраторы </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <a href="users_admin.php" class="small-box-footer"> Больше информации <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
<!-- END = Container USERS & ADMINISTRATORS -->

<!-- START = Container USERS & ADMINISTRATORS -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-teal">
                            <?php
                                $sql_select_comment_all= "SELECT * FROM comments ORDER BY comm_status asc";
                                $result_sql_select_comment_all = mysqli_query($dbconnection, $sql_select_comment_all);
                                $count_all_comments=0;
                                while ($rowcomment = mysqli_fetch_assoc($result_sql_select_comment_all))
                                {
                                  $count_all_comments++;
                                }
                            ?>
                            <div class="inner">
                              <h3><?php echo $count_all_comments ?></h3>
                              <p> Все комментарии </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-comments"></i>
                            </div>
                            <a href="comment_admin.php" class="small-box-footer"> Больше информации <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
<!-- END = Container USERS & ADMINISTRATORS -->
                </div>
            </section>
        </div>

    <?php include "layout/modal/add_new_post.php"; ?>
    <?php include "layout/modal/edit_user.php" ?>
    <?php include "layout/footer.php"; ?>
    <?php include "layout/scripts.php"; ?>
</body>
</html>
