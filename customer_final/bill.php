<?php 
include("include/header.php");
?>
<?php
	$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
	$cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
	$voucher = (isset($_SESSION['voucher']))? $_SESSION['voucher'] : [];
?>
<style>
    .txtText{
        font-size: 20px;
	}
</style>
<?php
	if(empty($cart) != 1){
?>
            <?php 
				// Thực hiện checkout
					if(isset($_POST['checkout'])){
						if(isset($user['accountID'])){
                            if(isset($_SESSION['voucher'])){
                                // Check Out
                                $id = rand(0,10000);
                                $name = $_POST['name'];
                                $paytype = $_POST['paytype'];
                                $address = $_POST['address'];
                                $phone = $_POST['phone'];
                                $currentStatus = 'Pending';
                                $email = $_POST['email'];
                                $totalPrice = $_POST['totalPrice'];
                                $voucherID = $_POST['vcID'];
                                $voucherType = $_POST['vcType'];
                                $accountID = $_POST['accountID'];
        
                                $sql = "INSERT INTO tbl_order (orderID, currentStatus,customerName, paymentID, customerAddress, customerPhone, customerEmail, totalPrice, voucherID, accountID) 
                                        VALUES ('$id', '$currentStatus', '$name' , '$paytype', '$address', '$phone',  '$email', '$totalPrice' ,'$voucherType', '$accountID')";
                                $query = mysqli_query($conn, $sql);
                                if($query){
                                    foreach($cart as $value){
                                        mysqli_query($conn, "INSERT INTO tbl_order_detail (productID, orderID, orderedQuantity, currentPrice)
                                        VALUES ('$value[id]', '$id', '$value[quantity]', '$value[price]')");
                                    }

                                    $sqlDelete = "DELETE FROM tbl_account_voucher WHERE voucherID = '{$voucherID}'";
                                    $query = mysqli_query($conn, $sqlDelete);
                                }

                                
                            } else {
                                // Check Out
                                $id = rand(0,10000);
                                $name = $_POST['name'];
                                $paytype = $_POST['paytype'];
                                $address = $_POST['address'];
                                $phone = $_POST['phone'];
                                $currentStatus = 'Pending';
                                $email = $_POST['email'];
                                $totalPrice = $_POST['totalPrice'];
                                $accountID = $_POST['accountID'];
        
                                $sql = "INSERT INTO tbl_order (orderID, currentStatus,customerName, paymentID, customerAddress, customerPhone, customerEmail, totalPrice, accountID) 
                                        VALUES ('$id', '$currentStatus', '$name' , '$paytype', '$address', '$phone', '$email', '$totalPrice', '$accountID')";
                                $query = mysqli_query($conn, $sql);
                                if($query){
                                    foreach($cart as $value){
                                        mysqli_query($conn, "INSERT INTO tbl_order_detail (productID, orderID, orderedQuantity, currentPrice)
                                        VALUES ('$value[id]', '$id', '$value[quantity]', '$value[price]')");
                                    }
                                }
                            }
							
							$userID = $_POST['userID'];
							$walletBalance = $_POST['walletBalance'];
																
							$sql1 = "UPDATE `tbl_account_wallet` SET `walletBalance` = ? WHERE `accountID` = ?;";
							$stmt = mysqli_prepare($conn, $sql1);
							mysqli_stmt_bind_param($stmt, "ds" , $walletBalance, $userID);
							if( mysqli_stmt_execute($stmt)){
							}else{
								echo " ". mysqli_error($conn);
							}

							$walletID = $_POST['walletID'];
							$historyName = $_POST['historyName'];
							$amount = $_POST['amount'];

							$sql2 = "INSERT INTO tbl_wallet_history (historyName, historyAmount, walletID)
							VALUES ('$historyName', '$amount', '$walletID')";
							$query = mysqli_query($conn, $sql2);

                            $paytype_query = mysqli_query($conn, "SELECT * FROM tbl_payment WHERE paymentID = '{$paytype}'");
                            $pay = mysqli_fetch_assoc($paytype_query);
                            $paymentName = $pay['paymentName'];

							// Show lại thông tin
                            $hienthi = '
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
                                    <div class="checkout-left">
                                        <div class="table-responsive">
                                            <div class="timetable_sub">
                                            <h2>You Order Success, your order iD is: '.$id.' </h2>
                                                <table style="width:50%">
                                                    <tr>
                                                        <th colspan = "2">Your information</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Your name</td>
                                                        <td>'.$name.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Your phone number</td>
                                                        <td>'.$phone.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Your address</td>
                                                        <td>'.$address.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Your email</td>
                                                        <td>'.$email.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Your paytype</td>
                                                        <td>'.$paymentName.'</td>
                                                    </tr>
                                                </table>
                                            <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            ';
                            // Show lại thông tin
                            echo $hienthi;
                            unset($_SESSION['cart']);
                            unset($_SESSION['voucher']);
						} else {
							$id = rand(0,10000);
							$name = $_POST['name'];
							$paytype = $_POST['paytype'];
							$address = $_POST['address'];
							$phone = $_POST['phone'];
                            $currentStatus = 'Pending';
                            $email = $_POST['email'];
							$totalPrice = $_POST['totalPrice'];
	
							$sql = "INSERT INTO tbl_order (orderID, currentStatus, customerName, paymentID, customerAddress, customerEmail ,customerPhone, totalPrice) 
									VALUES ('$id', '$currentStatus', '$name' , '$paytype', '$address', '$email' ,'$phone', '$totalPrice')";
							$query = mysqli_query($conn, $sql);
							if($query){
								foreach($cart as $value){
									mysqli_query($conn, "INSERT INTO tbl_order_detail (productID, orderID, orderedQuantity, currentPrice)
									VALUES ('$value[id]', '$id', '$value[quantity]', '$value[price]')");

                                    $sqlProduct = "SELECT * FROM tbl_product WHERE productID = '$value[id]'";
                                    $queryProduct = mysqli_query($conn, $sqlProduct);
                                    if($product = mysqli_fetch_assoc($queryProduct)){
                                        if($product['inventoryQuantity'] >= $value['quantity']){
                                            $quantity = $product['inventoryQuantity'] - $value['quantity'];
                                            if($quantity==0) {
                                                $sql = "UPDATE tbl_product SET productStatus = 'Empty', inventoryQuantity = '$quantity' WHERE productID = '{$value['id']}'";
                                            }
                                            else {
                                                $sql = "UPDATE tbl_product SET inventoryQuantity = '$quantity' WHERE productID = '{$value['id']}'";
                                            }
                                            $query = mysqli_query($conn, $sql);
                                        }
                                    }
								}

                                $paytype_query = mysqli_query($conn, "SELECT * FROM tbl_payment WHERE paymentID = '{$paytype}'");
                                $pay = mysqli_fetch_assoc($paytype_query);
                                $paymentName = $pay['paymentName'];

                                $hienthi = '
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
                                        <div class="checkout-left">
                                            <div class="table-responsive">
                                                <div class="timetable_sub">
                                                <h2>You Order Success, your order iD is: '.$id.' </h2>
                                                    <table style="width:50%">
                                                        <tr>
                                                            <th colspan = "2">Your information</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Your name</td>
                                                            <td>'.$name.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Your phone number</td>
                                                            <td>'.$phone.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Your address</td>
                                                            <td>'.$address.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Your email</td>
                                                            <td>'.$email.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Your paytype</td>
                                                            <td>'.$paymentName.'</td>
                                                        </tr>
                                                    </table>
                                                <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                ';
								// Show lại thông tin
								echo $hienthi;
                                unset($_SESSION['cart']);
                                unset($_SESSION['voucher']);
							} else {
								echo "Add fail";
							}
						}
					}
				?>
        <div>
		<div class="container">
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
                            <tr>
							<td colspan = "5">Voucher Apply: </td>
                                <?php
                                    $sql = "SELECT * FROM tbl_order, tbl_voucher_type 
                                    WHERE tbl_order.voucherID = tbl_voucher_type.typeID 
                                    AND tbl_order.orderID = '{$id}'";
                                    $query = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($query) > 0){
                                        while($order = mysqli_fetch_array($query)){
                                            echo '<td colspan = "2">'.$order['typeDesc'].'</td>
                                            ';
                                        }
                                    } else {
                                        echo '
                                            <td colspan = "2">Not using voucher</td>
                                        ';
                                    }    
                                ?>

                            </tr>
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
        </div>
    </div>
<?php 
    } else {
?>
<h3 style="text-align: center; margin-top:100px">You have not added an product to your cart </h3>
<?php
    }
?>
<?php 
    include("include/footer.php");
?>