<?php
	include('config/db_connect.php');
$title=$email=$ingredients='';
	$errors = array('email'=>'','title'=>'','ingredients'=>'') ;
	if(isset($_POST['submit'])){
	//email,title,ingredients checker
		if(empty($_POST['email'])){
			$errors['email'] = "An email is required <br/>";
		}else{
			$email =$_POST['email'];
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				 $errors['email'] = 'Email must be a valid email address';	
				}	
		}
		if(empty($_POST['title'])){
			$errors['title']= "An title is required <br/>";
		}else{

			$title=$_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
				$errors['title']= "TItle must be letters and spaces Only";
			}	
		}
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] = "At least one ingredient is required <br/>";
		}else{
			$ingredients=$_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
				$errors['ingredients'] = "Ingredients must be comma separated List";
			}	
		}
		 if (array_filter($errors)) {
				// echo 'errors in the form';
		 }else {
		 	$email=mysqli_real_escape_string($conn,$_POST['email']);
		 	$title=mysqli_real_escape_string($conn,$_POST['title']);
		 	$ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);
		 	//create sql
		 	$sql = "INSERT INTO Pizzas(title,email,ingredients)
		 		VALUES('$title','$email','$ingredients') ";
		 	// echo 'form is valid';
		 	if (mysqli_query($conn,$sql)) {
		 			//succes
		 		header('location:index.php');
		 		}else{
		 			echo 'query error:' . mysqli_error($conn);
		 		}
		 	
		 }

	}//End of Post
?>
<!DOCTYPE html>
<html>
	<?php include('template/header.php'); ?>
	<section class="container gray-text">
		<form class="white" action="add.php" method="POST">
			<labe+l>Your Email:</label>
			<input type="text" name="email" value="<?php echo  htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']?></div>
			<label>Pizza Title:</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
			<div class="red-text"><?php echo $errors['title']?></div>
			<label>Ingredients (comma separated):</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
			<div class="red-text"><?php echo $errors['ingredients']?></div>
			<div>
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
		<h4 class="center">Add a Pizza</h4>
	</section>
	<?php include('template/footer.php'); ?>	
 </body>
</html>