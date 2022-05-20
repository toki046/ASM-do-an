<?php 
	include("include/header.php");
	$user = (isset($_SESSION['user']))? $_SESSION['user'] : [];
?>
<?php
	if(isset($_POST['update'])){
		$userID = $user['accountID'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$sql = "UPDATE tbl_account SET accountEmail = '{$email}' , accountPhone = '{$phone}' WHERE accountID = '{$userID}'";
		$query = mysqli_query($conn, $sql);
		if($query){
			echo "Update Thành Công";
			echo "<script>window.open('cusprofile.php','_self')</script>";
		} else {
			echo "Thất Bại";
		}
	}
?>
<style>
	.btn-update{
		padding: 12px 84px;
		color: #fff;
		font-size: 16px;
		background: #1accfd;
		text-decoration: none;
		letter-spacing: 1px;
		display: inline-block;
		font-weight: 800;
		border: none;
	}

	.btn-update:hover{
		background: #2587c8;
		transition: 0.5s all;
		-webkit-transition: 0.5s all;
		-moz-transition: 0.5s all;
		-o-transition: 0.5s all;
		-ms-transition: 0.5s all;
	}
</style>
<div class="container">
	<div class="row gutters">
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
			<div class="card h-100">
				<div class="card-body">
					<div class="account-settings">
						<div class="user-profile">
							<h2 style="margin-bottom: 10px">Your Information</h2>
							<h4 class="user-name">Full Name: <?php echo $user['accountFullname']?></h4>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
			<div class="card h-100">
				<div class="card-body">
					<form method="post">
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mb-2 text-primary">Personal Details</h6>
							</div>
							<?php
								$sql = "SELECT * FROM tbl_account WHERE accountID = '{$user['accountID']}'";
								$query = mysqli_query($conn, $sql);
								$showUser = mysqli_fetch_assoc($query);
							?>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="phone">Email</label>
									<input type="text" class="form-control" id="phone" name="email" value="<?php echo $showUser['accountEmail']?>" placeholder="Enter your email">
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $showUser['accountPhone']?>" placeholder="Enter phone number">
								</div>
							</div>
						</div>
						<div class="checkout-right-basket">
							<input type="submit" class="btn-update" name="update" value="Update">
							<a href="cusprofile.php">Cancel
								<span class="far fa-window-close" aria-hidden="true"></span>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
    include("./include/footer.php");
?>  