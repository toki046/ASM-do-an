<?php 
include("include/header.php");
?>
<?php
	$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
	$cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
	$voucher = (isset($_SESSION['voucher']))? $_SESSION['voucher'] : [];
?>
<style>
	.btn-checkout button{
		width: 100%;
		height: 45px;
		box-shadow: 10px;
		transition: .5s all;
		font-size: 15px;
		margin-top: 10px;
		margin-bottom: 10px;
	}
</style>

	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Home</a>
						<i>|</i>
					</li>
					<li>Check Out</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- payment page-->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Check Out
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
				
			<?php 
				if(empty($cart) != 1){
			?>
			<div class="checkout-right">
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>ID</th>
								<th>Product</th>
								<th>Quality</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Total Price in Product</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$totalPrice = 0;
								$tt = 0;
								$totalCoin = 0;
							?>
							<?php 
								foreach($cart as $key => $value):
									$tt = $value['price'] * $value['quantity'];
									$totalPrice += $tt;
									$totalCoin = $totalPrice / 100;
									
							?>
								<tr class="rem">
								<td class="invert"><?php echo $key ++ ?></td>
								<td class="invert-image">
									<a href="single.php?id=<?php echo $value['id'] ?>">
										<img src="../shared_assets/img/product/<?php echo $value['id'] ?>/<?php echo $value['image'] ?>" alt="" class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<div class="quantity">
										<?php echo $value['quantity'] ?>
									</div>
								</td>
								<td class="invert"><?php echo $value['name'] ?></td>
								<td class="invert"><?php echo number_format($value['price']) ?> VND</td>
								<td class="invert"><?php echo number_format($tt) ?> VND</td>
							</tr>
							<?php endforeach ?>
							<tr>
								<td colspan = "5">Total Price: </td>
								<td colspan = "2"><?php echo number_format($totalPrice)?> VND</td>
							</tr>
							<?php							

							?>
							<tr>
								<td colspan = "5">Total coin can get: </td>
								<td colspan = "2">
								<?php 
									if($totalCoin <= 0){
										echo '0';
									} else {
										echo number_format($totalCoin);
									}
								?> 
								Coin</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<a href="cart.php">
				<div class="applyCoupon">
					<button class="btnAddCoupon" style="transition: .5s all; margin-top: 10px;" type="button">Back to Cart</button>				
				</div>
			</a>
			<div class="checkout-left">
				<div class="checkOutInput">
					<h4>Add a new details</h4>
					<form action="bill.php" method='POST'>
					<?php
						if(isset($user['accountID'])){
					?>
						<?php
							// Get all infor about wallet of user
							$sql = "SELECT * FROM tbl_account_wallet WHERE accountID = '{$user['accountID']}'";
							$query = mysqli_query($conn, $sql);
							while($wallet = mysqli_fetch_assoc($query)){
						?>
							<input type="hidden" name="walletBalance" value="<?php echo $wallet['walletBalance'] + $totalCoin ?>">
							<input type="hidden" name="userID" value="<?php echo $wallet['accountID'] ?>">
							<input type="hidden" name="historyName" value="Buy Product">
							<input type="hidden" name="amount" value="<?php echo $totalCoin ?>">
							<input type="hidden" name="walletID" value="<?php echo $wallet['walletID'] ?>">
						<?php } ?>
					<?php
						}
					?>
					<?php 
						if(isset($user['accountID'])){
					?>
					    <?php
							$sql = "SELECT * FROM tbl_account WHERE accountID = '{$user['accountID']}'";
							$query = mysqli_query($conn, $sql);
							$showUser = mysqli_fetch_assoc($query);
						?>
						<div class="inputInfo">
							<div class="txtText">
								Full Name
							</div>
							<input type="text" placeholder="Input your name" id="name" name="name" class="inputBox" value="<?php echo $showUser['accountFullname']?>" required>
							<div class="txtText">
								Your phone number
							</div>
							<input type="tel" id="phone" name="phone" placeholder="Input your phone number" class="inputBox" value="<?php echo $showUser['accountPhone']?>" required>
							<div class="txtText">
								Your email
							</div>
							<input type="text" id="email" name="email" placeholder="Input your email" class="inputBox" value="<?php echo $showUser['accountEmail']?>" required>
						</div>
						<div class="address">
							<div class="txtText">
								Address
							</div>
							<input type="text" id="address" placeholder="Address" name="address" class="inputBox" required>
						</div>
						<div class="paymentType">
							<div class="txtText">
								Paytype
							</div>
							<?php
								$paytype = mysqli_query($conn, "SELECT * FROM tbl_payment");
							?>
							<select id="paytype" class="form-control inputBox" name="paytype" >
								<?php foreach ($paytype as $key => $value) {?>
									<option value="<?php echo $value['paymentID']?>"><?php echo $value['paymentName']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="clearfix"></div>
						<div class="extraNotes">
								<div class="txtText">
									Extra Notes (Optional)
								</div>
							<textarea name="text" id="extraNotes" class="inputNotes" placeholder="Input your notes"></textarea>
						</div>
						<?php } else { ?>
							<div class="inputInfo">
							<div class="txtText">
								Full Name
							</div>
							<input type="text" placeholder="Input your name" id="name" name="name" class="inputBox" value="" required>
							<div class="txtText">
								Your phone number
							</div>
							<input type="tel" id="phone" name="phone" placeholder="Input your phone number" class="inputBox" required>
							<div class="txtText">
								Your email
							</div>
							<input type="text" id="email" name="email" placeholder="Input your email" class="inputBox" required>
						</div>
						<div class="address">
							<div class="txtText">
								Address
							</div>
							<input type="text" id="address" placeholder="Address" name="address" class="inputBox" required>
						</div>
						<div class="paymentType">
							<div class="txtText">
								Paytype
							</div>
							<?php
								$paytype = mysqli_query($conn, "SELECT * FROM tbl_payment");
							?>
							<select id="paytype" class="form-control inputBox" name="paytype" >
							<?php foreach ($paytype as $key => $value) {?>
								<option value="<?php echo $value['paymentID']?>"><?php echo $value['paymentName']?></option>
							<?php } ?>
							</select>
						</div>
						<div class="clearfix"></div>
						<div class="extraNotes">
								<div class="txtText">
									Extra Notes (Optional)
								</div>
							<textarea name="text" id="extraNotes" class="inputNotes" placeholder="Input your notes"></textarea>
						</div>
						<?php } ?>
				<div class="row-voucher-checkout  p-2 bg-white border-voucher rounded mt-2">
				<?php 
					// final Price là giá sau khi áp dụng voucher
					$finalPrice = 0;
					// giamPrice là giá sẽ giảm
					$giamPrice = 0;
					// id của voucher
					$id = null;
				if (is_array($voucher) || is_object($voucher)){
					foreach($voucher as $key => $value):
						$giamPrice = ($totalPrice * $value['value']) / 100;
						$finalPrice = $totalPrice - $giamPrice;
						$id = $value['id'];
				?>
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="../shared_assets/img/voucher.jpg"></div>
                <div class="col-md-6 mt-1">
                <h5 class="voucher__Name"><?php echo $value['desc']?></h5>
                    <div class="d-flex flex-row-voucher ">
                    <div class="ratings mr-2">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    </div><span></span>
                    <!-- <p class="text-justify text-truncate para mb-0">Có Hiệu Lực Từ: 18.10.2021 00:00<br><br></p>-->
                    </div>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row-voucher  align-items-center">
                       <!--  <h4 class="mr-1">$13.99</h4><span class="strike-text">$20.99</span> -->
                    </div>
                    <h6 class="text-success"></h6>
					<a href="voucherxuly.php?action=delete">
						<div class="d-flex flex-column mt-4">
							<button class="btn-voucher btn-outline-primary btn-sm mt-2" type="button">Cancel</button>
						</div>
					</a>
                </div>				
				<?php endforeach ?>
				<?php } ?>
				<input type="hidden" name="vcID" value="<?php
					if(isset($_SESSION['voucher'])){
						echo $value['id'];
					} else {
						echo "";
					}
			?>">
			<input type="hidden" name="vcType" value="<?php
					if(isset($_SESSION['voucher'])){
						echo $value['type'];
					} else {
						echo "";
					}
			?>">
            </div>

			<!-- Final Price -->
			<div class="totalPrices">
					Total: <?php if($finalPrice == 0){
						echo $totalPrice;
					} else {
						echo $finalPrice;
					}?>
					VND
			</div>
			<div class="clearfix"></div>
			<?php
				if($totalPrice >= 200000 && isset($_SESSION['user']) ){
			?>
			<a href="voucherCheckOut.php">
				<div class="applyCoupon">
					<button class="btnAddCoupon" style="transition: .5s all" type="button">Apply Voucher</button>				
				</div>
			</a>
			<?php
				}
			?>
			<input type="hidden" name="totalPrice" value="<?php if($finalPrice == 0){
					echo $totalPrice;
				} else {
					echo $finalPrice;
				}
			?>">
			<input type="hidden" name="accountID" value="<?php 
			if($user){
				echo $user['accountID'];
				} else {
				echo "";}
			?>">
			<div class="clearfix"></div>
			<div class="btn-checkout">
				<button class="btn btn-primary btn-sm" type="submit" name="checkout">Check Out</button>
			</div>		
			<?php
				} else {
			?>
				<h3 style="text-align: center;">You have not added an product to your cart</h3>
			<?php
				}
			?>
		</form>	
		<div class="clearfix"> </div>
	</div>
	<!-- //payment page -->
<?php 
include("include/footer.php");
?>