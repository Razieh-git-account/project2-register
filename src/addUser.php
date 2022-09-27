<?php 
  include('DB/Database.php');
  include_once('UserController.php');
  include_once('UserValidator.php');
  $errors = [];
  if(isset($_POST['save_user']))
  {
      $validation = new UserValidator($_POST);
      $errors = $validation->validateForm();
      $db = new Database();
   
      if (count($errors) === 0){
          $inputData = [
              'name' => mysqli_real_escape_string($db->conn,$_POST['name']),
              'email' => mysqli_real_escape_string($db->conn,$_POST['email']),
              'mobile' => mysqli_real_escape_string($db->conn,$_POST['mobile']),
              'password' => mysqli_real_escape_string($db->conn,$_POST['password']),
              
          ];
          $user = new UserController;
          $result = $user->insertInDatabase($inputData);
          
          if($result)
          {
              header("Location: index.php");
          }
          else
          {
              echo "User can not saved";
          }
      }
  }

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('templates/header.php'); ?>
<section class="container ">
		<h4 >اضافه کردن کاربر</h4>
        <form class="white  z-depth-3" id="users" action="addUser.php" method="POST"  >
            
            <input type="text" class="input" name="name" value="<?php echo htmlspecialchars($_POST['name']) ?? ''; ?>" placeholder="نام کاربری شما...">
            <div class="red-text"> <?php  echo $errors['name'] ?? '' ?> </div>

            <input type="text" class="input" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>"  placeholder="ایمیل شما...">
            <div class="red-text"> <?php echo $errors['email'] ?? '' ?> </div>

            <input type="text" class="input" name="mobile" value="<?php echo htmlspecialchars($_POST['mobile']); ?>"  placeholder="موبایل شما...">
            <div class="red-text"> <?php echo $errors['mobile'] ?? '' ?> </div>

            <input type="password" class="input" name="password" value="<?php echo htmlspecialchars($_POST['password']); ?>"   placeholder=" رمز شما...">
            <div class="red-text"> <?php echo $errors['password'] ?? '' ?> </div>

            <div class="center">
                <input type="submit" name="save_user" value="ثبت نام" class="btn brand z-depth-5">
            </div>
            
        </form>
</section>
<br><br>

<?php include_once('templates/footer.php'); ?>

</html>
