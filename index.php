<?php
	include('config/db_connect.php');
	
	//queries
	$sql='SELECT title,ingredients,id FROM pizzas order by created_at';
	//make quary & get results
	$result = mysqli_query($conn,$sql);
	//fetch results in array format(more)

	$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
	//free results from memory
	mysqli_free_result($result);
	//close connection
	mysqli_close($conn);
//print_r(explode(',',$pizzas[0]['ingredients']))
?>
<!DOCTYPE html>
<html>
	<?php include('template/header.php'); ?>
	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			<?php foreach($pizzas as $pizza): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<img src="pizza.svg" class="pizza">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']) ?></h6>
							<!-- <div><?php echo htmlspecialchars($pizza['ingredients']) ?></div> -->
							<ul>
								<?php foreach(explode(',',$pizza['ingredients']) as
								& $ing):?>
									<li>
										<?php echo htmlspecialchars($ing)?>
									</li>
								<?php endforeach;?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">more info</a>
						</div>						
					</div>
				</div>
			<?php endforeach;?>		
		</div>
	</div>
	<?php include('template/footer.php'); ?>	
 </body>
</html>