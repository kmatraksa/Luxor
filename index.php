<!DOCTYPE html>
<html>
<head>
	<title>LuxorFabric</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style-mobi.css">
  	<link rel="stylesheet" type="text/css" href="css/media.css">
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
</head>

<body>
	<?php include 'Codephp/connectdb.php';?>

	<div id="wrapper">
		<?php include "header.php"; ?>
		<div class="container-fluid contant-a" id="sec-a" style="padding: 0!important;    margin-top: -20px;">
			<div class="jumbotron" style="position:relative;">
				<video id="video-background" preload muted autoplay loop>
					<source src="video/02.mp4" type="video/mp4">
				</video>
				<div class="container">
					<div class="video-caption center-block">
						<h2 class="text-center ">เเหล่งรวมผลิตภัณฑ์จาก
							<span class="CYell">ผ้าทอไทย</span>
						</h2>
						<h4 class="text-center center-block">สามารถค้นหาสินค้าได้ที่นี่</h4>
						<div class="seach col-md-6 col-md-offset-3">
							<div class="input-group">
								<form method="POST">
									<input type="text" name="textsearchProduct" class="form-control" style="width: 75%;" aria-label="..." placeholder="ระบุชื่อสินค้าที่ต้องการค้นหา">
									<input type="submit" name="submitsearchProduct" class="form-control" style="width: 20%;" aria-label="..." value="ค้นหา">
								</form>
								<?php 
									if(!empty($_POST['submitsearchProduct'])){
										$_SESSION['textsearchProduct'] = $_POST['textsearchProduct'];
										header("Location: Listproduct.php");
									}
								?>
							</div><!-- /input-group -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid contant-b" id="sec-b">
			<div class="container">
				<h2 class="text-center CRed ">สินค้าแนะนำ</h2>
				<h4 class="text-center center-block"><img class="line-height img-responsive center-block" src="images/line.png" alt=""></h4>
				<div class="sliderbox">
					<div class="rio-promos">
						<?php 
							// $sqlqueryhotproduct = "SELECT * FROM `hotproduct` hp
							// 						INNER JOIN product p ON p.id_product = hp.id_product
							// 						INNER JOIN store s ON p.id_store = s.id_store";
							// $sqlqueryhotproduct = "SELECT * FROM `product` p
							// 						INNER JOIN store s ON s.id_store = p.id_store
							// 						INNER JOIN imgproductdetail ipd ON ipd.id_product = p.id_product AND ipd.namethumbProduct = '1'
							// 						INNER JOIN imgproduct ip ON ip.id_imgProduct = ipd.id_imgProduct
							// 						ORDER BY p.id_product desc LIMIT 3";

							$sqlqueryhotproduct = "SELECT * FROM `hotproduct` hp
													INNER JOIN product p ON p.id_product = hp.id_product
													INNER JOIN imgproductdetail ipdt ON ipdt.id_product = p.id_product
													INNER JOIN imgproduct ip ON ipdt.id_imgProduct = ip.id_imgProduct
													WHERE ipdt.namethumbProduct = '1'
													ORDER BY RAND() LIMIT 3";

							$queryproduct = mysqli_query($connect,$sqlqueryhotproduct);
							if(!empty($queryproduct))
							{
								while($row = mysqli_fetch_array($queryproduct))
								{
						?>
									<div class="item">
										<form method="POST" action="index.php">
											<figure class="snip1268">
												<div class="image">
													<img style="height:250px;" class="img-responsive center-block" src="./<?php echo $row['url_img'].$row['Name_img'];?>" alt="sq-sample4"/>
													<div class="icons">
														<a href="#"><i class="fa fa-star"></i></a>
														<!-- <a href="Detailproduct.php"> <i class="fa fa-search"></i><span class="detail">ดูเพิ่มเติม</span></a> -->
														<a href="Detailproduct.php?idproduct=<?php echo $row['id_product']; ?>"> <i class="fa fa-search"></i><span class="detail">ดูเพิ่มเติม</span></a>
														<a href="#"> <i class="fa fa-share-square-o"></i></a>
													</div>
													<figcaption>
														<div class="caption">
															<p class="title">
																<h4><?php echo $row['NameProduct']; ?></h2>
																<p class="price CRed"><?php echo number_format($row['PriceProduct']);;?> บาท</p>
															</p>
														</div>
													</figcaption>
													<input name="idproduct" type="hidden" value="<?php echo $row['id_product']; ?>">
													<input name="NameProduct" type="hidden" value="<?php echo $row['NameProduct']; ?>">
													<input name="PriceProduct" type="hidden" value="<?php echo $row['PriceProduct'];?>">
													<input name="thumb" type="hidden" value="1">
													<input name="qtyproduct" type="hidden" value="1">
													<input id="clickaddcart" name="addproducttocart"  type="submit" class="add-to-cart my-cart-btn" value="Add to Cart">
											</figure>
										</form>
									</div> <!--item-->
						<?php 
								}
								include "./Codephp/CodeFront/addcart.php";
							}
						?>
					</div><!--rio-promos-->
				</div> <!--sliderbox-->
				<div class="row">
					<a href="./Listproduct.php" class="btn btn-primary btn-all GRed col-md-offset-5 col-md-2 col-sm-offset-5 col-sm-2 col-xs-offset-4 col-xs-5  noborder">ดูสินค้าทั้งหมด</a>
				</div>
			</div>
		</div>


		<div class="container-fluid" style="background-color:white;padding:0;">
			<div class="container-fluid contant-c" id="sec-c">
				<div class="container">
					<h2 class="text-center CRed ">ร้านค้าแนะนำ</h2>
						<h4 class="text-center center-block"><img class="line-height img-responsive center-block" src="images/line.png" alt=""></h4>
						<h4 class="text-center">หากคุณมีสินค้าไอเดีย เรามีพื้นที่ให้คุณนำเสนอ <span class="CRed"><a class="CRed" href="">เริ่มต้นขายสินค้าได้ที่นี่</a></span></h4>
				</div>
				<div class="slider center">
					<?php 
						$sqlStore = "SELECT * FROM `store`";
						$queryStore = mysqli_query($connect,$sqlStore);
						
						while($Store = mysqli_fetch_array($queryStore)){
						?>
							<div><h3><a href="DetailStore.php?idstore=<?php echo $Store['id_store']; ?>"><img src="<?php echo $Store['AvatarStore']; ?>" alt=""></h3></a></div>
						<?php
						}
					?>
				</div>
				<!-- <div class="row">
					<button class="btn btn-primary btn-all GRed col-md-offset-5 col-md-2 col-sm-offset-5 col-sm-2 col-xs-offset-4 col-xs-5  noborder">ดูร้านค้าทั้งหมด</button>
				</div> -->
			</div>
		</div>

		<div class="container-fluid contant-d" id="sec-d" >
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6 col-sm-6">
							<h2 class="CWhite">เลือกลายผ้าไตล์ที่คุณชอบ</h2>
							<h5 class="CWhite">สามารถเลือกลายผ้า เเละสินค้าที่ชอบ ปรับเเต่ง <span style="width:100%;">ให้เป็นสไตล์คุณ ได้เเล้วที่นี่</span></h5>
							<!-- <a href="#" class="btn btn-primary btn-all btn-log   noborder">ปรับแต่งสินค้าของคุณ</a> -->

							<form action="Listproduct.php" method="POST">
								<input type="submit" name="sendCheckCustomize" value="ปรับแต่งสินค้าของคุณ" class="btn btn-primary btn-all btn-log   noborder"/>
							</form>
						</div>
						<div class="col-md-6 col-sm-6 pull-right"><img class="img-responsive" src="images/Pro1.png" alt=""></div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid contant-e" id="sec-e" style="background-color:white;">
			<div class="container">
				<h2 class="text-center CRed ">ขั้นตอนการสั่งซื้อ</h2>
				<h4 class="text-center center-block"><img class="line-height img-responsive center-block" src="images/line.png" alt=""></h4>
				<div class="row">
					<div class="col-md-12 process-block">
						<img class="img-responsive center-block hidden-xs visible-sm visible-md visible-lg" src="images/Desktop_Process.png" alt="">
						<img class="img-responsive center-block hidden-sm hidden-md hidden-lg"src="images/Mb_Process1.png" alt="">
						<img class="img-responsive center-block hidden-sm hidden-md hidden-lg"src="images/Mb_Process2.png" alt="">
					</div>
				</div>
				</div>
			</div>
		</div>

		<div class="container-fluid contant-f" id="sec-f">
			<div class="container">
				<h2 class="text-center CRed ">เอกลักษณ์ของผ้าไทยตามท้องถิ่น </h2>
				<h4 class="text-center" style="color:#999999;">ความพิเศษของผ้าทอไทยที่มีลักษณะเฉพาะตัว</h4>
					<h4 class="text-center center-block"><img class="line-height img-responsive center-block" src="images/line.png" alt=""></h4>
			</div>
			<div class="row nopadding">
				<div class="col-md-12 nopadding">
					<?php 
						$sqlBlog = "SELECT * FROM `blog` order by id_blog desc LIMIT 4";
						$queryBlog = mysqli_query($connect,$sqlBlog);
						while($blog = mysqli_fetch_array($queryBlog)){
						?>
							<div class="col-md-3 col-sm-3 col-xs-12 nopadding">
								<div class="thumbnail">
									<a href="detailBlog.php?idblog=<?php echo $blog['id_blog']; ?>" style="text-decoration:none;">
										<div class="img"><img class="img-responsive" src="<?php echo $blog['img_blog']; ?>" alt=""></div>
										<div class="caption">
											<p class="title" style="text-shadow: black 0.1em 0.1em 0.2em;"><?php echo mb_substr($blog['titleBlog'],0,25,'UTF-8')."...";?></p>
										</div>
									</a>
								</div>
							</div>
						<?php
						}
					?>
				</div>
			</div>
		</div>

		<?php include "footer.php"; mysqli_close($connect); ?>

	</div>
	<!-- wrapper -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type='text/javascript' src="js/jquery.mycart.min.js"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> -->
	<script type='text/javascript' src="js/app.js"></script>
	
	<script type="text/javascript">
	
	
       

	</script>
	
</body>

</html>