<?php
	require 'includes/conf.inc.php';
	include_once "includes/title.php" ;
	include_once "includes/header2.php" ;

	if (isset($_GET['roll'])&&!empty($_GET['roll'])) {
		$roll = $_GET['roll'];
	} else {
		$roll='0';
	}

	$result = $conn->query("SELECT * from marks where rollNumber = $roll") or die(mysqli_error($conn));

	if($result->num_rows > 0) {
		while($row=$result->fetch_assoc()) {
			$name=$row['name'];
			$rollNo=$row['rollNumber'];
		}
		$pointers = $conn->query("SELECT * from marks where rollNumber = $rollNo") or die(mysqli_error($conn));
		if($pointers->num_rows > 0) {
			while($row = $pointers->fetch_assoc()) {
				$scheme = $row['scheme'];
				$dept = $row['dept'];
				$sem1 = $row["sgpi1"];
				$sem2 = $row["sgpi2"];
				$sem3 = $row["sgpi3"];
				$sem4 = $row["sgpi4"];
				$sem5 = $row["sgpi5"];
				$sem6 = $row["sgpi6"];
				$sem7 = $row["sgpi7"];
				$sem8 = $row["sgpi8"];
				$sem9 = $row["sgpi9"];
				$sem10 = $row["sgpi10"];
				$cgpi = $row["cgpi"];
			}
		}
		$nr = $conn->query("SELECT rollNumber from marks order by cgpi desc");
		$collegeRank = 0;
		while($row = $nr->fetch_assoc()) {
			// print_r($row);
			$collegeRank++;
			if($rollNo == $row["rollNumber"])
				break;
		}
		$nr = $conn->query("SELECT rollNumber from marks where scheme = '$scheme' order by cgpi desc");
		$yearRank = 0;
		while($row = $nr->fetch_assoc()) {
			// print_r($row);
			$yearRank++;
			if($rollNo == $row["rollNumber"])
				break;
		}
		$nr = $conn->query("SELECT rollNumber from marks where scheme = '$scheme' && dept='$dept' order by cgpi desc");
		$classRank = 0;
		while($row = $nr->fetch_assoc()) {
			// print_r($row);
			$classRank++;
			if($rollNo == $row["rollNumber"])
				break;
		}
//  we gonna finish the rest at the end
?>

<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>

<div class="row">
	<div class="span8 offset1">
	<p><?php echo "College Rank ".$collegeRank ;?></p>
	<p><?php echo "Year Rank ".$yearRank ;?></p>
	<p><?php echo "Class Rank ".$classRank ;?></p>
	</div>
</div>

<div class="row">
	<!-- result -->
	<div class="span10 offset1">
		<table class="table table-striped span10">
			<div class="container">
				<table class="table table-striped table-hover table-bordered">

					<tr>
						<td> NAME</td>
						<td> <?php echo $name ?></td>
					</tr>

					<tr>
						<td>ROLLNO</td>
						<td id="comment_to"> <?php echo $rollNo ?></td>
					</tr>

					<?php if($sem1 != -1) {	?>
					<tr>
						<td>Sem 1 (SGPI01)</td>
						<td> <?php echo $sem1 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem2 != -1) {	?>
					<tr>
						<td>Sem 2 (SGPI02)</td>
						<td> <?php echo $sem2 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem3 != -1) {	?>
					<tr>
						<td>Sem 3 (SGPI03)</td>
						<td> <?php echo $sem3 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem4 != -1) {	?>
					<tr>
						<td>Sem 4 (SGPI04)</td>
						<td> <?php echo $sem4 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem4 != -1) {	?>
					<tr>
						<td>Sem 4 (SGPI04)</td>
						<td> <?php echo $sem4 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem5 != -1) {	?>
					<tr>
						<td>Sem 5 (SGPI05)</td>
						<td> <?php echo $sem5 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem6 != -1) {	?>
					<tr>
						<td>Sem 6 (SGPI06)</td>
						<td> <?php echo $sem6 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem7 != -1) {	?>
					<tr>
						<td>Sem 7 (SGPI07)</td>
						<td> <?php echo $sem7 ?></td>
					</tr>
					<?php } ?>

					<?php if($sem8 != -1) {	?>
					<tr>
						<td>Sem 8 (SGPI08)</td>
						<td> <?php echo $sem8 ?></td>
					</tr>
					<?php } ?>

					<?php if($cgpi != -1) {	?>
					<tr>
						<td>Commulative (CGPI)</td>
						<td> <?php echo $cgpi ?></td>
					</tr>
					<?php } ?>

				</table>
			</div>
		</table>
	</div>
</div>

<?php include_once "supply_box.php" ?>

<div class="row">
	<div class="span8 offset1">
		<a href="main.php"><h3>GO BACK</h3></a>
	</div>
	<!-- like -->
	<div class="span2">
		<?php
			include_once "like_box.php";
		?>
	</div>
</div>

<?php
		include_once "comment_box.php" ;
	} else {
//  we will finish it later
?>

<div class="row">
	<h1 class="span10 text-center text-error offset1">NO RESULT FOUND!!</h1>
</div>

<?php
	}
?>

<div class="row" style="background: #999999; margin-top:20px;">
	<h5 class="text-center">No Rights Reserved</br>@OPEN-SOURCE</h5>
</div>

<script type="text/javascript">
	document.body.onload = function() {
		showComment();
		var addComment = document.getElementById("add_comment");
		addComment.addEventListener("click", needToAddComment);
		showLikes();
    var addLikes = document.getElementById("add_like");
    addLikes.addEventListener("click", needToAddLike);
	}
</script>