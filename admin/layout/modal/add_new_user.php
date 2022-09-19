<?php
      $current_date = date('d/m/Y');
      if (isset($_POST['save_user']))
      {
        $add_user_name=$_POST['user_name'];
        $add_user_username=$_POST['user_username'];
        $add_user_email=$_POST['user_email'];
        $add_user_password1=$_POST['user_password'];
        $add_user_password=md5($add_user_password1);
        $add_user_gender=$_POST['user_gender'];
        //$add_user_image=$_POST['user_image'];

        $image_extension = pathinfo($_FILES["user_image"]["name"], PATHINFO_EXTENSION);
        if ($image_extension=='jpg' || $image_extension=='jpeg' || $image_extension=='png' || $image_extension=='gif') 
        {
          $add_user_image = $_FILES["user_image"]["name"];
          $add_user_image_temp = $_FILES["user_image"]["tmp_name"];
        }
        
        if (empty($add_user_image))
        {
         $add_user_image="nophoto-default.jpg";
        }
         move_uploaded_file($add_user_image_temp,"images/users/$add_user_image");

        $add_user_code=$_POST['user_code'];
        $add_user_status=$_POST['user_status'];
        $add_user_type=$_POST['user_type'];

        $sql_add_user = "INSERT INTO users(name,username,email,password,gender,image,code,status,type) VALUES('$add_user_name', '$add_user_username', '$add_user_email', '$add_user_password', '$add_user_gender', '$add_user_image', '$add_user_code', '$add_user_status', '$add_user_type')";
        $result_sql_add_user= mysqli_query($dbconnection, $sql_add_user);
        if (!$result_sql_add_user)
                {
                  die("Error description:" . mysqli_error());
                }
                else
                {
                  echo "Data added successfully";
                  header("Location: users_admin.php");
                }
      }
     ?>
      <!--
        <div class="modal fade" id="InsertCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      --> 
        <div class="modal fade" id="InsertUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header modal-header-add">
                <h4 class="modal-title" id="exampleModalLongTitle" align="center"><i class="fa fa-users"></i> Добавить новую Администраторы & Пользователей  <button type="button" class="close btn btn-danger" data-dismiss="modal"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button></h4>
              </div>
              <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
 
                <div class="form-group col-md-4">
                  <label for="cat_title" class="col-form-label"><i class="fa fa-address-card" aria-hidden="true"></i> Имя пользователя: </label>
                  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Введите имя пользователя здесь" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="cat_title" class="col-form-label"><i class="fa fa-user-secret" aria-hidden="true"></i> Логин пользователя:</label>
                  <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Введите Логин пользователя здесь" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="cat_title" class="col-form-label"><i class="fa fa-envelope" aria-hidden="true"></i> Введите E-Mail:</label>
                  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Введите E-Mail здесь" data-error="Bruh, that email address is invalid" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="user_type" class="col-form-label"><i class="fa fa-asterisk" aria-hidden="true"></i> Тип пользователя:</label>
                      <select class="form-control" id="user_type" name="user_type" required>
                    <option value="" disabled selected > Выбор категории...</option>
                    <option value="0"> Пользователь </option>
                    <option value="1"> Администратор </option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="user_password" class="col-form-label"><i class="fa fa-key" aria-hidden="true"></i> Пароль:</label>
                  <input type="password" data-minlength="6" class="form-control" name="user_password" id="user_password" placeholder="Введите Пароль здесь" required="">
                </div>
                <div class="form-group col-md-4">
                  <label for="user_password_reapet" class="col-form-label"><i class="fa fa-lock" aria-hidden="true"></i> Подтвердить Пароль:</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Введите Подтвердить Пароль здесь" required>
                </div>
                <div class="form-group col-md-4">
                      <label for="user_imagel" class="col-form-label"><i class="fa fa-picture-o" aria-hidden="true"></i> Картина:</label>
                      <input type="file" name="user_image" id="user_image">
                </div>
                <div class="form-group col-md-4">
                  <label for="cat_title" class="col-form-label"><i class="fa fa-users" aria-hidden="true"></i> Выберите пол:</label><br>
                  <label><input type="radio" name="user_gender" id="user_gender" value="1" checked> <i class="fa fa-female" aria-hidden="true"></i></label>
                  <label><input type="radio" name="user_gender" id="user_gender" value="2"> <i class="fa fa-male" aria-hidden="true"></i></label>
                </div>
                <div class="form-group col-md-4">
                    <label for="user_status" class="col-form-label"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус:</label><br>
                    <input type="radio" name="user_status" id="user_status" value="1" checked=""> Активный
                    <br><input type="radio" name="user_status" id="user_status" value="0"> В ожидании
                </div>
                
              </div>
              <br>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Закрывать </button>
                <button type="submit" class="btn btn-success" name="save_user"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Сохранить </button>
              </div>
              </form>
            </div>
          </div>
        </div>
