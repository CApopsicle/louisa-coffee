<?php

mysql_connect("localhost","root","TIME9379");
mysql_select_db("louisa");
mysql_query("set names utf8");
$coffee = mysql_query("select * from menu where Type = 'COFFEE' order by Price");
$taylors = mysql_query("select * from menu where Type = 'TAYLORS' order by Price");
$fruit = mysql_query("select * from menu where Type = 'FRUIT' order by Price");
$frappe = mysql_query("select * from menu where Type = 'FRAPPE' order by Price");
$tea = mysql_query("select * from menu where Type = 'TEA' order by Price");
$others = mysql_query("select * from menu where Type = 'OTHERS' order by Price");


$user = mysql_query("select Username from manager");
$data1 = mysql_query("select * from manager");

	if (isset($_POST['username'])){
		$name = $_POST['username'];
		$pass = $_POST['password'];
		$check = false;
		for($i = 0; $i < mysql_num_rows($user); $i++){
			$Account = mysql_fetch_row($user);
			if ($name == $Account[0])
				$check = true;
		}
		if ($check == true){
			$login = false;
			for($i = 0; $i < mysql_num_rows($data1); $i++){
				$temp = mysql_fetch_row($data1);
				if ($name == $temp[0] && $pass == $temp[1])
					$login = true;
			}
			if ($login == false)
				header("location: error.php");

		}else
			header("location: error.php");	
	}else
		header("location: login.php");



?>
<!DOCTYPE html>
<html ng-app="myApp">
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title>Menu - Louisa Coffee</title>
		<!-- Description, Keywords and Author -->
		<meta name="description" content="Your description">
		<meta name="keywords" content="Your,Keywords">
		<meta name="author" content="ResponsiveWebInc">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Styles -->
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- Portfolio CSS -->
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<!-- Font awesome CSS -->
		<link href="css/font-awesome.min.css" rel="stylesheet">	
		<!-- Custom Less -->
		<link href="css/less-style.css" rel="stylesheet">	
		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">
		<!--[if IE]><link rel="stylesheet" href="css/ie-style.css"><![endif]-->
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="#">
		<script src="angular.min.js"></script>
		<script src="menu.js"></script>

		<script type="text/javascript" language="javascript">


			function HideContent(d) {
			document.getElementById(d).style.display = "none";
			}
			function ShowContent(d) {
			document.getElementById(d).style.display = "block";
			}
			function ReverseDisplay(d) {
			if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
			else { document.getElementById(d).style.display = "none"; }
			}
			function Print(d){
				for (var i = 0; i < 6; i++){
					if (i==d){
						document.getElementById(i).style.display = "block";
					}
				else {
					document.getElementById(i).style.display = "none";
				}
			}
			
		}


		</script>

	</head>
	
	<body ng-init="" ng-controller="MainCtrl">
		
			
		<!-- Shopping cart Modal -->
		<div class="modal fade" id="shoppingcart1" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Shopping Cart</h4>
					</div>
					<div class="modal-body">
						<!-- Items table -->
						<table  class="table table-striped">
  	  							<tr>
      							<td>商品編號</td>
     							<td>冰度/甜度</td>
     							<td>購買數量</td>
     							<td>金額
     					 		<td>小計</td>
    							</tr>
   								<tr ng-repeat="item in carts">
    							<!--<td><button ng-click="del($index)">刪除</button></td>-->
    								<td>{{item.Pnum}}</td>
  							   		<td>{{item.Ice}}/{{item.Sugar}}</td>
    								<td>{{item.Amount}}</td>
    								<td>{{item.Money}}</td>
   									<td>{{subtotal(item.Amount,item.Money)}}</td>
 								</tr>
   								<tr>
   									<td></td>
   									<td></td>
    								<td></td>
     								<td>總計</td>
     							 	<td>{{sum()}}</td>
  								</tr>
  						</table>
  						<!-- <table class="table table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Quantity</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="#">Exception Reins Evocative</a></td>
									<td>2</td>
									<td>$200</td>
								</tr>
								<tr>
									<td><a href="#">Taut Mayoress Alias Appendicitis</a></td>
									<td>1</td>
									<td>$190</td>
								</tr>
								<tr>
									<td><a href="#">Sinter et Molests Perfectionist</a></td>
									<td>4</td>
									<td>$99</td>
								</tr>
								<tr>
									<th></th>
									<th>Total</th>
									<th>$489</th>
								</tr>
							</tbody>
						</table>  -->
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>
						<button type="button" class="btn btn-info">Checkout</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- Model End -->
		
		<!-- Page Wrapper -->
		<div class="wrapper">
		
			<!-- Header Start -->
			
			<div class="header">
				<div class="container">
					<!-- Header top area content -->
					<div class="header-top">
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<!-- Header top left content contact -->
								<div class="header-contact">
									<!-- Contact number -->
									<span><i class="fa fa-phone red"></i> 02-2766-6672</span>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<!-- Header top right content search box -->
								<div class=" header-search">
									<form class="form" role="form">
										<div class="input-group">
										  <input type="text" class="form-control" placeholder="Search...">
										  <span class="input-group-btn">
											<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
										  </span>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<div class="pull-right">
								<a href="login.php" class="btn btn-danger btn-sm" >會員登入</a>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
								<!-- Button Kart -->
								<div class="btn-cart-md">
									<a class="cart-link" href="#">
										<!-- Image -->
										<img class="img-responsive" src="img/cart.png" alt="" />
										<!-- Heading -->
										<h4>Shopping Cart</h4>
										<!-- <span>3 items $489/-</span> -->
										<div class="clearfix"></div>
									</a>

									<div class="cart-dropdown" role="menu">
									<table  class="table table-striped">
  	  								<tr>
  	  									<td> </td>
      									<td>商品編號</td>
     									<td>冰度/甜度</td>
     									<td>購買數量</td>
     									<td>金額
     					 				<td>小計</td>
    								</tr>
   									<tr ng-repeat="item in carts">
    									<td><button ng-click="del($index)">刪除</button></td>
    									<td>{{item.Pnum}}</td>
  								   		<td>{{item.Ice}}/{{item.Sugar}}</td>
    									<td>{{item.Amount}}</td>
    									<td>{{item.Money}}</td>
   										<td>{{subtotal(item.Amount,item.Money)}}</td>
 									</tr>
   									<tr>
   										<td></td>
   										<td></td>
    									<td></td>
    									<td></td>
     									<td>總計</td>
     								 	<td>{{sum()}}</td>
  									</tr>
  									</table> 

  									</div>

									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-5">
							<!-- Link -->
							<a href="index.html">
								<!-- Logo area -->
								<div class="logo">
									<img class="img-responsive" src="img/logo.jpg" alt="" />
									<!-- Heading -->
									<h1>Louisa Coffee </h1>
									<!-- Paragraph -->
									<h3>永春概念店</h3>
								</div>
							</a>
						</div>
						<div class="col-md-8 col-sm-7">
							<!-- Navigation -->
							<nav class="navbar navbar-default navbar-right" role="navigation">
								<div class="container-fluid">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>

									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
										<ul class="nav navbar-nav">
											<li><a href="index.html"><img src="img/nav-menu/slider4.jpg" class="img-responsive" alt="" /> Home</a></li>
											<li class="dropdown hidden-xs">
												<a href="menu1.php"><img src="img/nav-menu/slider5.jpg" class="img-responsive" alt="" /> Menu </a>
												
											</li>
											
											
											<li><a href="aboutus.html"><img src="img/nav-menu/slider7.jpg" class="img-responsive" alt="" /> About</a></li>
										</ul>
									</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
						</div>
					</div>
				</div> <!-- / .container -->
			</div>
			
			<!-- Header End -->
			
			<!-- Banner Start -->
			
			<div class="banner padd">
				<div class="container">
					<!-- Image -->
					<img class="img-responsive" src="img/crown-white.png" alt="" />
					<!-- Heading -->
					<h2 class="white">Menu</h2>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">Menu</li>
					</ol>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<!-- Banner End -->
			


			
			<!-- Inner Content -->
			<div class="inner-page padd">
			
				<!-- Inner page menu start -->
				<div class="inner-menu">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<!-- Inner page menu list -->
								<div class="menu-list">
									<!-- Menu item heading -->
									<h3>Drinks</h3>
									<!-- Image for menu list -->
									<img class="img-responsive" src="img/menu/beans-in-a-cup.jpg" alt="" />
									<!-- Menu list items -->
									<div class="menu-list-item" onclick="Print(0)">
										<!-- Heading / Dish name -->
										<a href="#" class="btn btn-danger btn-sm" >COFFEE</a>
										<!-- Dish price -->
										<span class="price pull-right"></span>
										<div class="clearfix"></div>
									</div>
									<!-- Menu list items -->
									<div class="menu-list-item" onclick="Print(1)">
										<!-- Heading / Dish name -->
										<a href="#" class="btn btn-danger btn-sm" >TAYLORS TEA</a>
										<!-- Dish price -->
										<span class="price pull-right"></span>
										<div class="clearfix"></div>
									</div>
									<!-- Menu list items -->
									<div class="menu-list-item" onclick="Print(2)">
										<!-- Heading / Dish name -->
										<a href="#" class="btn btn-danger btn-sm" >FRUIT TEA</a>
										<!-- Dish price -->
										<span class="price pull-right"></span>
										<div class="clearfix"></div>
									</div>
									<!-- Menu list items -->
									<div class="menu-list-item" onclick="Print(3)">
										<!-- Heading / Dish name -->
										<a href="#" class="btn btn-danger btn-sm" >FRAPPE</a>
										<!-- Dish price -->
										<span class="price pull-right"></span>
										<div class="clearfix"></div>
									</div>
									<!-- Menu list items -->
									<div class="menu-list-item " onclick="Print(4)" >
										<!-- Heading / Dish name -->
										<a href="#" class="btn btn-danger btn-sm" >TEA</a>
										<!-- Dish price -->
										<span class="price pull-right"></span>
										<div class="clearfix"></div>
									</div>
									<!-- Menu list items -->
									<div class="menu-list-item border-zero" onclick="Print(5)" >
										<!-- Heading / Dish name -->
										<a href="#" class="btn btn-danger btn-sm" >OTHERS</a>
										<!-- Dish price -->
										<span class="price pull-right"></span>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<!-- Inner page menu list -->
								<div class="menu-list" id = "0" style="display:block">
									<!-- Menu item heading -->
									<h3>COFFEE</h3>
									<!-- Image for menu list 
									<img class="img-responsive" src="img/menu/menu2.jpg" alt="" />-->
									<!-- Menu list items -->
									<?php 
  										for($i = 0; $i < mysql_num_rows($coffee); $i++){
  										$info = mysql_fetch_row($coffee);
  										$drinkNum = $i+1 ;
  									?>
									<div class="menu-list-item">
										<!-- Heading / Dish name -->
										<h4 class="pull-left"><?php echo $drinkNum. "." .$info[1]; ?></h4>
										<!-- Dish price -->
										<span class="price pull-right">$<?php echo $info[2]; ?></span>
										<div class="clearfix"></div>
									</div>
									<?php } ?> 
								</div>


								<div class="menu-list" id = "1" style="display:none">
									<!-- Menu item heading -->
									<h3>TAYLORS TEA</h3>
									<?php 
  										for($i = 0; $i < mysql_num_rows($taylors); $i++){
  										$info = mysql_fetch_row($taylors) ;
  										$drinkNum = $i+17 ;
  									?>
									<div class="menu-list-item">
										<!-- Heading / Dish name -->
										<h4 class="pull-left"><?php echo $drinkNum. "." .$info[1]; ?></h4>
										<!-- Dish price -->
										<span class="price pull-right">$<?php echo $info[2]; ?></span>
										<div class="clearfix"></div>
									</div>
									<?php } ?> 
									
									
								</div>

								<div class="menu-list" id = "2" style="display:none">
									<!-- Menu item heading -->
									<h3>FRUIT TEA</h3>
									<?php 
  										for($i = 0; $i < mysql_num_rows($fruit); $i++){
  										$info = mysql_fetch_row($fruit);
  										$drinkNum = $i+ 24;
  									?>
									<div class="menu-list-item">
										<!-- Heading / Dish name -->
										<h4 class="pull-left"><?php echo $drinkNum. "." .$info[1]; ?></h4>
										<!-- Dish price -->
										<span class="price pull-right">$<?php echo $info[2]; ?></span>
										<div class="clearfix"></div>
									</div>
									<?php } ?> 
									
									
								</div>

								<div class="menu-list" id = "3" style="display:none">
									<!-- Menu item heading -->
									<h3>FRAPPE</h3>
									<?php 
  										for($i = 0; $i < mysql_num_rows($frappe); $i++){
  										$info = mysql_fetch_row($frappe);
  										$drinkNum = $i+ 31;
  									?>
									<div class="menu-list-item">
										<!-- Heading / Dish name -->
										<h4 class="pull-left"><?php echo $drinkNum. "." .$info[1]; ?></h4>
										<!-- Dish price -->
										<span class="price pull-right">$<?php echo $info[2]; ?></span>
										<div class="clearfix"></div>
									</div>
									<?php } ?> 
									
									
								</div>


								<div class="menu-list" id = "4" style="display:none">
									<!-- Menu item heading -->
									<h3>TEA</h3>
									<?php 
  										for($i = 0; $i < mysql_num_rows($tea); $i++){
  										$info = mysql_fetch_row($tea);
  										$drinkNum = $i+ 35;
  									?>
									<div class="menu-list-item">
										<!-- Heading / Dish name -->
										<h4 class="pull-left"><?php echo $drinkNum. "." .$info[1]; ?></h4>
										<!-- Dish price -->
										<span class="price pull-right">$<?php echo $info[2]; ?></span>
										<div class="clearfix"></div>
									</div>
									<?php } ?> 
									
								</div>


								<div class="menu-list" id = "5" style="display:none">
									<!-- Menu item heading -->
									<h3>OTHERS</h3>
									<?php 
  										for($i = 0; $i < mysql_num_rows($others); $i++){
  										$info = mysql_fetch_row($others);
  										$drinkNum = $i+ 43;
  									?>
									<div class="menu-list-item">
										<!-- Heading / Dish name -->
										<h4 class="pull-left"><?php echo $drinkNum. "." .$info[1]; ?></h4>
										<!-- Dish price -->
										<span class="price pull-right">$<?php echo $info[2]; ?></span>
										<div class="clearfix"></div>
									</div>
									<?php } ?> 
									
								</div>
							</div>
				
			
					
							<div class="col-md-4 col-sm-6">
								<div class="menu-list" ng-app>
									<h3>訂購單</h3>
									<form role="form">
									
 									<div class="form-group">
									    <label for="exampleInputEmail1">訂購飲料品項編號</label>
									    <input type="number" class="form-control" id="exampleInputDrinks" placeholder="請輸入飲料品項編號" ng-model="Pnum">
 									</div>
  									<div class="form-group">
   										<label for="exampleInputPassword1">糖度</label>
    									<input type="text" class="form-control" id="exampleInputSuger" placeholder="正常，少糖，半糖，微糖" ng-model="Sugar">
  									</div>
  									<div class="form-group">
   				 						<label for="exampleInputFile">冰度</label>
    									<input type="text" class="form-control" id="exampleInputIce" placeholder="正常，少冰，去冰" ng-model="Ice">
 			 						</div>
 			 						<div class="form-group">
   				 						<label for="exampleInputFile">訂購數量</label>
    									<input type="number" class="form-control" id="exampleInputNumber" placeholder="請輸入數量" ng-model="Amount">
 			 						</div>
  									<button type="submit" class="btn btn-danger btn-sm" ng-click="add()">送出</button>
								</form>
								
								</div>
							</div>


						</div>
					</div>
				</div>
				
								
						
				<!-- Inner page menu end -->
			
				
				
			</div><!-- / Inner Page Content End -->	
			
			<!-- Footer Start -->
			
			<div class="footer padd">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<!-- Footer widget -->
							<div class="footer-widget">
								<!-- Logo area -->
								<div class="logo">
									<img class="img-responsive" src="img/logo.jpg" alt="" />
									<!-- Heading -->
									<h1>Louisa Coffee</h1>
								</div>
								<!-- Paragraph -->
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.</p>
								
								<!-- Heading -->
							</div> <!--/ Footer widget end -->
						</div>
						
						<div class="clearfix visible-sm"></div>
						
						<div class="col-md-3 col-sm-6">
							<!-- Footer widget -->
							<div class="footer-widget">
								<!-- Heading -->
								<h4>Contact Us</h4>
								<div class="contact-details">
									<!-- Address / Icon -->
									<i class="fa fa-map-marker br-red"></i> <span>板南線永春捷運站1號出口左轉永吉路326巷<br /><永吉公園旁></span>
									<div class="clearfix"></div>
									<!-- Contact Number / Icon -->
									<i class="fa fa-phone br-green"></i> <span>02-2766-6672</span>
									<div class="clearfix"></div>
									<!-- Email / Icon -->
									<i class="fa fa-envelope-o br-lblue"></i> <span><a href="#">週一 - 週六: 7:00 - 21:00<br/>週日: 8:00 - 21:00</a></span>
									<div class="clearfix"></div>
								</div>
								<!-- Social media icon -->
								<div class="social">
									<a href="https://www.facebook.com/pages/%E8%B7%AF%E6%98%93%E8%8E%8E%E5%92%96%E5%95%A1-%E6%B0%B8%E6%98%A5%E6%A6%82%E5%BF%B5%E5%BA%97/828496723861055?sk=timeline" class="facebook"><i class="fa fa-facebook"></i></a>
									
								</div>
							</div> <!--/ Footer widget end -->
						</div>
					</div>
					<!-- Copyright -->
					<div class="footer-copyright">
						<!-- Paragraph -->
						<p>&copy; Copyright 2014 <a href="#">Louisa coffee 永春概念店</a></p>
					</div>
				</div>
			</div>
			
			<!-- Footer End -->
			
		</div><!-- / Wrapper End -->
		
		
		<!-- Scroll to top -->
		<span class="totop"><a href="#"><i class="fa fa-angle-up"></i></a></span> 
		
		
		
		<!-- Javascript files -->
		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Pretty Photo JS -->
		<script src="js/jquery.prettyPhoto.js"></script>
		<!-- Respond JS for IE8 -->
		<script src="js/respond.min.js"></script>
		<!-- HTML5 Support for IE -->
		<script src="js/html5shiv.js"></script>
		<!-- Custom JS -->
		<script src="js/custom.js"></script>
		<!-- JS code for this page -->
		<script>		
		</script>
	</body>	
</html>