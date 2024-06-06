
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


	<title>SAVIOUR</title>
	<meta content="Admin Dashboard" name="description">
	<meta content="Themesbrand" name="author">
	<link rel="shortcut icon" href="image/suhlogo.png">
	<link rel="stylesheet" href="../plugins/morris/morris.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
    div#login-modal:before {
    content: "";
    position: fixed;
    background: #00000052;
    width: 100%;
    height: 100%;
}
.dropdown-item {
    display: block;
    width: 100%;
    padding: 10px;
    clear: both;
    font-weight: 400;
    color: #fff;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    border-radius: 0px;
}
  .modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 998;
  }
  .dropdown:hover > .dropdown-menu {
    display: block;
    visibility: visible;
    opacity: 1;
    margin-top:3px;

}
.header1{
  color:  #8A2909;
}
  </style>
</head>

<body>
	
       
	<header id="topnav">
	<div class="topbar-main">
		<div class="container">
			<!-- Logo container-->
			<div class="logo"><a href="index.php" class="logo">
<img src="assets/images/logo-sm.png" alt="" class="logo-small"> <img src="assets/images/logo.png" alt="" class="logo-large" width="100%"></a></div>
	<div class="contacts" style="float:right">
			    <h3>For Support </h3>
			    <p>
			        Support: teaminfo@infomaps.in <br>
			        Email: admin@infomaps.in
			    </p>
			</div>
			</div>
		
			<!-- End Logo container-->


		</div>
		<!-- end container -->
	</div>
	<!-- end topbar-main -->
	<div class="container-fluid">
		 <div class="login " style="float: right">
                   <a id='modal-launcher' class="btn btn-success pull-right" data-toggle="modal" data-target="#login-modal" style="border-radius:0px; line-height:20px; border:none;margin-top:15px; background:#9e2361; color:#fff;">
					Login
					</a>
						 
	</div>	
<nav class="navbar navbar-expand-lg navbar-dark nav-section">
<div class="container"> 
  
  		
	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
						    	<div class="modal-content">
						      		<div class="modal-header modal-header-primary">
						            	<h2 class="modal-title" id="myModalLabel">Department Login</h2>
						        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

						      		</div>
						      		<form action="checklogin.php" method="post"  >
						      		<div class="modal-body login-modal">
						      			<div class="clearfix"></div>
						      			<div id='social-icons-conatainer'>
							        		<div class=''>
							        		<div id="check" style="padding-bottom: 10px;text-align: center;">&nbsp;</div>
							        		 <input type="hidden" name="key" id="key">
							        		 
							        		 <div class="input-group mb-3">
											  <div class="input-group-prepend">
											    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
											  </div>
											 <input type="text" id="admin_name" placeholder="User Name" name="admin_name" maxlength="30"  class="form-control required login-field" >
											</div>
							        		 
							        		  <div class="input-group mb-3">
											  <div class="input-group-prepend">
											    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
											  </div>
											<input type="password" id="admin_pwd" placeholder="Password" name="admin_pwd"  maxlength="20" class="form-control required login-field">
											</div>
							        		</div>
							        	</div>
						        		<div class="clearfix"></div>
						      		</div>
						      		<div class="clearfix"></div>
						      		<div class="modal-footer login_modal_footer ">
						      		
						      		<center>  <input type="submit" class="btn btn-success" name="login" id="login"  value="Login"></center>
						      		</div>
						      	 </form>	
						    	</div>
						  	</div>
						</div>
					</div>
  </div>
</nav>
			<!-- end navigation -->
		</div>
	<!-- end navbar-custom -->
</header>


	<!-- End Navigation Bar-->
	<div class="wrapper" style="padding-top: 185px; !important">
		<div class="container-fluid">
			<div class="row">
      	<div class="container">
					
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
                            	<li data-target="#myCarousel" data-slide-to="3"></li>
                                <li data-target="#myCarousel" data-slide-to="4"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<div class="item active">
								<img src="slider1.jpg" alt="" style="width:100%; height:500px;">
							</div>

							<div class="item">
								<img src="slider2.jpg" alt="" style="width:100%;height:500px;">
							</div>

							<div class="item">
								<img src="slider3.jpg" alt="" style="width:100%;height:500px;">
							</div>
                            
                            	<div class="item">
								<img src="slider4.jpg" alt="" style="width:100%;height:500px;">
							</div>
                            <div class="item">
								<img src="slider5.jpg" alt="" style="width:100%;height:500px;">
							</div>
						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
					
						<a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
					
					</div>
				</div>






				
			</div>
		</div>
	</div>

	<!-- end row -->
	 <!-- Footer -->
		<?php include 'inc/footer.php'; ?>
		<!-- End Footer -->
		<!-- jQuery  -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/jquery.slimscroll.js"></script>
		<script src="assets/js/waves.min.js"></script>
		<script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
		<!--Morris Chart-->
		<script src="../plugins/morris/morris.min.js"></script>
		<script src="../plugins/raphael/raphael-min.js"></script>
		<script src="assets/pages/dashboard.js"></script>
		<!-- App js -->
		<script src="assets/js/app.js"></script>
</body>

</html>