<?php include("adminsession.php");?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<script src="js/jquery.min.js" ></script>
<link rel="stylesheet" href="css/bootstrap1.min.css">
<script src="js/jquery1.min.js"></script>
<script src="js/bootstrap1.min.js"></script>
<script src="js/bootstrap-multiselect.min.js" ></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" />
<link rel="stylesheet" href="js/leafletjs/leaflet.css" />
<script src="js/leafletjs/leaflet.js" ></script>
<script type="text/javascript" src="js/wicket.js" ></script>
<script type="text/javascript" src="js/wicket-leaflet.js" ></script>


	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
<title>Tumakuru | View Map</title>
</head>
<style>
.dropdown-submenu {
	position: relative;
}
.dropdown-submenu .dropdown-menu {
	top: 0;
	left: 100%;
	margin-top: -1px;
}
</style>
<style>
@media only screen and (max-width: 600px) {
 .multiselect-container {
 z-index:9999;
}
 .table {
 width: 100%!important;
 max-width: 100%!important;
 margin-bottom: 20px!important;
}
 .modalwidth {
 width:100%!important;
}
}
.pagination {
	display: inline-block;
}
.pagination a {
	color: black;
	float: left;
	padding: 8px 16px;
	text-decoration: none;
 transition: background-color .3s;
	border: 1px solid #ddd;
}
.pagination a.active {
	background-color: #4CAF50;
	color: white;
	border: 1px solid #4CAF50;
}
 .pagination a:hover:not(.active) {
background-color: #ddd;
}
</style>
<style>
.container-fluid {
	box-shadow:0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.button {
	background-color: #4CAF50; /* Green */
	border: none;
	color: black;
	padding: 2px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
	margin: 4px 2px;
	cursor: pointer;
}
.button4 {
	border-radius: 12px;
}
</style>
<body style="background-color:#E7E7E7;">
<div class="modal fade" id="myModal" role="dialog" aria-hidden="true" style="display:none;" >
  <div class="modal-dialog modal-xl" style="width: 62%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>Building Details </h4>
      </div>
      <div class="modal-body">
        <div id="showroadmap"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModalalert" role="dialog" aria-hidden="true" style="display:none;" >
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="height:420px;!important">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>Login Details </h4>
      </div>
      <div>
     
			<center><div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-30" >
				<form class="login100-form validate-form" action="" method="post">
					<span style="color:#F00">
						Use Official Credentials to View the Result
					</span>
                    <br>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="admin_name" placeholder="User Name">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="admin_pwd" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" name="login" onClick="return checkinputmaster('admin_name,admin_pwd')">
							Sign in
						</button>
					</div>

					

					<div class="text-center">
						<span class="txt1">
							
						</span>

						<a href="#" class="txt2 hov1">
						
						</a>
					</div>
				</form>
			</div></center>
		
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModaltax" role="dialog" aria-hidden="true" style="display:none;width:900px;left:35%" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>Building Tax Details </h4>
      </div>
      <div class="modal-body">
        <div id="showtax"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="myModalbore" role="dialog" aria-hidden="true" style="display:none;" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>Borewell Details </h4>
      </div>
      <div class="modal-body">
        <div id="showbore"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#">Tumakuru</a> </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a></li>
        <li class="dropdown active"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mapping <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="viewmap.php">View Map</a></li>
            <li><a href="analysis.php">Analysis</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Plan Approval <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="plan_approval.php">Plan Approval</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Infrastructure Projects <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="amrut_process.php">Amrut </a></li>
            <li><a href="other_infra.php">Others</a></li>
            <!--<li <li class="dropdown-submenu"><a class="test" tabindex="-1" href="#">Others <span class="caret"></span></a>
                  <ul class="dropdown-menu">
           <li><a tabindex="-1" href="#">Completed</a></li>
           <li><a tabindex="-1" href="#">Ongoing</a></li>
          <li><a tabindex="-1" href="#">Approved</a></li>
          
           
             <li><a tabindex="-1" href="#">New Proposal</a></li>
          
        </ul>
                  
                  </li>-->
          </ul>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Plan Upload</a></li>
            <li><a href="#">Upload Data</a></li>
            <li><a href="#">Delete Data</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">User Details</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<div class="container-fluid">
  <div class="row" style="padding-top:10px; padding-bottom:10px; background-color:#FFF;">
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
      <select id="ward" multiple="multiple"  style="max-width:70%;"  >
        <!--  <option value="all">All</option>-->
        <?php 
                    $sql = mysqli_query($connection,"select * from ward order by ward+0");
                    while($row=mysqli_fetch_assoc($sql)) {                                                    
                    ?>
        <option value="<?php echo $row['ward'];?>">&nbsp;<?php echo strtoupper($row['ward']);?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
      <select id="Street_Name" multiple="multiple">
      </select>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
      <select id="Utility_Name" multiple="multiple"  >
        <!--  <option value="all">All</option>-->
        <?php 
                        $sql = mysqli_query($connection,"select distinct Utility_Name from utility order by Utility_Name");
                        while($row=mysqli_fetch_assoc($sql)) { 
						  if($row['Utility_Name']!=""){
                        ?>
        <option value="<?php echo $row['Utility_Name'];?>">&nbsp;<?php echo strtoupper($row['Utility_Name']);?></option>
        <?php  }} ?>
      </select>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
      <select id="Usage1" multiple="multiple" >
      </select>
    </div>
  </div>
  <div class="row" style="padding-top:10px; padding-bottom:10px; background-color:#FFF;">
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
      <select id="Construction" multiple="multiple" style="max-width:70%;"  >
        <!--  <option value="all">All</option>-->
        <?php 
                        $sql = mysqli_query($connection,"select distinct Construction from builduing order by Construction");
                        while($row=mysqli_fetch_assoc($sql)) { 
                		  if($row['Construction']!=""){
                        ?>
        <option value="<?php echo $row['Construction'];?>">&nbsp;<?php echo $row['Construction'];?></option>
        <?php  }} ?>
      </select>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
   <!-- getViolationmap();-->
      <select id="Area_Violation" name="Area_Violation" multiple="multiple"  onChange="getAlert();"  class="form-control" >
        <option value="">-Select Violation-</option>
        <option value="1">&nbsp;Constructed more than MIS</option>
        <option value="2">&nbsp;Floor Violation</option>
        <option value="3">&nbsp;Plan Violation</option>
        <?php 
                           $sql = mysqli_query($connection,"select distinct Area_Violation from builduing order by Area_Violation");
                            while($row=mysqli_fetch_assoc($sql)) { 
    						  if($row['Area_Violation']!=""){
                        ?>
        <option value="<?php echo $row['Area_Violation'];?>">&nbsp;<?php echo $row['Area_Violation'];?></option>
        <?php  }} ?>
      </select>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
      <select id="PID" multiple="multiple">
        <!--<option value="all">All</option>-->
      </select>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
   <!-- getServices();-->
      <select id="services" name="services"  onChange="getAlert();" class="form-control" >
        <option value="">-Select Services-</option>
        <?php 
											$sql1 = "select distinct Water_Con_Avbl from builduing where Water_Con_Avbl!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['Water_Con_Avbl']; ?>"><?php echo $row1['Water_Con_Avbl']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct UGD_Con_Avbl from builduing where UGD_Con_Avbl!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['UGD_Con_Avbl']; ?>"><?php echo $row1['UGD_Con_Avbl']; ?></option>
        <?php
											}
                                            $sql1 = "select distinct Water_Con_With_UGD from builduing where Water_Con_With_UGD!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
												?>
        <option value="<?php echo $row1['Water_Con_With_UGD']; ?>"><?php echo $row1['Water_Con_With_UGD']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct Water_con_Bal_category from builduing where Water_con_Bal_category!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
												?>
        <option value="<?php echo $row1['Water_con_Bal_category']; ?>"><?php echo $row1['Water_con_Bal_category']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct UGD_con_Bal_category from builduing where UGD_con_Bal_category!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
												?>
        <option value="<?php echo $row1['UGD_con_Bal_category']; ?>"><?php echo $row1['UGD_con_Bal_category']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct Water_Akrama_sakrama_Con from builduing where Water_Akrama_sakrama_Con!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
												?>
        <option value="<?php echo $row1['Water_Akrama_sakrama_Con']; ?>"><?php echo $row1['Water_Akrama_sakrama_Con']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct UGD_Akrama_sakrama_Con from builduing where UGD_Akrama_sakrama_Con!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['UGD_Akrama_sakrama_Con']; ?>"><?php echo $row1['UGD_Akrama_sakrama_Con']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct Akrama_sakrama_Tap_With_Akrama_sakrama_UGD from builduing Akrama_sakrama_Tap_With_Akrama_sakrama_UGD!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['Akrama_sakrama_Tap_With_Akrama_sakrama_UGD']; ?>"><?php echo $row1['Akrama_sakrama_Tap_With_Akrama_sakrama_UGD']; ?></option>
        <?php
                                            }
							  				$sql1 = "select distinct Water_Con_Avbl_Akrama_sakrama_UGD from builduing Water_Con_Avbl_Akrama_sakrama_UGD!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['Water_Con_Avbl_Akrama_sakrama_UGD']; ?>"><?php echo $row1['Water_Con_Avbl_Akrama_sakrama_UGD']; ?></option>
        <?php
                                            }
							  				$sql1 = "select distinct UGD_Con_Avbl_Akrama_sakrama_Tap from builduing UGD_Con_Avbl_Akrama_sakrama_Tap!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['UGD_Con_Avbl_Akrama_sakrama_Tap']; ?>"><?php echo $row1['UGD_Con_Avbl_Akrama_sakrama_Tap']; ?></option>
        <?php
                                            }
											$sql1 = "select distinct Trade_license from builduing where Trade_license!=''";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
        <option value="<?php echo $row1['Trade_license']; ?>"><?php echo $row1['Trade_license']; ?></option>
        <?php
                                            
											
                                            }
											?>
        <option value="one">Property Tax No Due </option>
        <option value="two" >Property Tax Due Less Than-20K </option>
        <option value="three" >Property Tax Due 20-50K </option>
        <option value="four" >Property Tax Due 50-100K </option>
        <option value="five" >Property Tax Due Above 100K
        <option>
      </select>
    </div>
  </div>
  <!--<div class="row" style="padding-top:10px; padding-bottom:10px; background-color:#FFF;">
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                <select id="taxstatus" name="taxstatus" onChange="getTaxMap();" class="form-control"  style="max-width:70%;"  >
                <option value="">Select Tax Status</option>
                  <option value="0">Paid</option>
                    <option value="1">Not Paid</option>
                      <option value="NA">NA</option>
               
                </select>
            </div>
            
            
            
        </div>-->
  <div class="container-fluid"> <span style="font-size:18px;color:red" ><strong>VIEW MAP</strong></span> <span style="padding-left:500px;font-size:18px;color:blue" ><strong>MIS Data as on Date : 25-01-2020</strong></span> <a href="#" onClick="clearAll();" style="float:right">
    <button class="btn btn-primary">Clear</button>
    </a>
    <div id="showdronimage" style="float:right"></div>
    <a href="#" onClick="window.open('uploaded/1m_road.pdf', '_blank', 'fullscreen=no'); return false;" style="float:right">
    <button class="btn btn-success">Contour </button>
    </a> </div>
  <div class="container-fluid">
    <div class="row" style="background-color:#FFF;">
      <div id="emptydata" style="font-size:18px"></div>
      <div id="mapid" style="height: 450px; width: 100%;"></div>
    </div>
  </div>
</div>
<br>
<div class="widgetcontent bordered" id="showdatarecord"></div>
<div class="widgetcontent bordered" id="showdatarecordmiddle"></div>
<div style="top: 1220px; right: 1%; position: absolute; z-index: 1000; outline: none;">
  <input type="button" id="serbtn" class="btn btn-info" onClick="searchdatabuilding();" value="Search"  style="display:none;">
  <input type="button" id="serbtnservice" class="btn btn-info" onClick="searchdataservice();" value="Search"  style="display:none;">
  <input type="text" name="search" placeholder='Search..' id="myInput" onKeyUp="searchrecorrd();" style="display:none;"  />
</div>
<br />
<div class="widgetcontent bordered" id="showdatarecord1"></div>
<br>
<footer style="background:#3b6998; height: 40px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12" align="right">
        <p style="color:white;padding-top: 10px;padding-right: 25px;"><em>Brought to you by <strong>Infomaps</strong></em></p>
      </div>
    </div>
  </div>
</footer>
<script>
    var ward='';
    var add_ward = '';
    var rem_ward = '';
    var ward_list_old=[];
    var road_list_old=[];
    var query_list_old=[];
    var constr_list_old=[];
    var violat_list_old=[];
    var pid_list_old=[];
    var mymap = L.map('mapid').setView([13.350, 77.10], 13);
	var wardGroup = L.featureGroup().addTo(mymap);
	var buildingGroup = L.featureGroup().addTo(mymap);
	var buildingGroup1 = L.featureGroup().addTo(mymap);
	var streetGroup = L.featureGroup().addTo(mymap);
	var manholeGroup = L.layerGroup().addTo(mymap);
	var borewellGroup = L.layerGroup().addTo(mymap);
	var manholelineGroup = L.layerGroup();
	var utilityGroup = L.layerGroup().addTo(mymap);
	var citynameGroup = L.layerGroup().addTo(mymap);
	var cityroadGroup = L.layerGroup().addTo(mymap);
	var violationGroup = L.layerGroup().addTo(mymap);
		var citywardGroup = L.layerGroup().addTo(mymap);
		var conturGroup = L.featureGroup();
		var abdGroup = L.featureGroup().addTo(mymap);
	var droneGroup = L.layerGroup().addTo(mymap);
	var serviceGroup = L.layerGroup().addTo(mymap);
	var taxdetailGroup = L.layerGroup().addTo(mymap);
	var certificateGroup = L.layerGroup().addTo(mymap);
	var citymarkerGroup = L.layerGroup().addTo(mymap);
	var marker;
	var building;
	var building1;
	var bpoly={};
	var wardpoly_list={};
	var buildingpoly_list={};
	var roadpoly_list={};
	var manholedatapoly_list={};
	var manholelinepoly_list={};
	var borewellpoly_list={};
	
	
	var base = L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
		subdomains: ['a','b','c'],
		 maxZoom: 20,
    }).addTo(mymap);
	var basemap = {"Base": base};
	var overlays = { "City Boundary": citynameGroup,"City Roads": cityroadGroup,"ABD Wards": wardGroup, "ABD Buildings":buildingGroup, "ABD Streets": streetGroup, "ABD Manholes": manholeGroup, "SS Drain" : manholelineGroup,  "ABD Boundary" : abdGroup , "Contour" : conturGroup, "City Borewells" : borewellGroup, "City Park" : citymarkerGroup};
	mymap.zoomControl.setPosition("topright");
	L.control.layers(basemap, overlays).addTo(mymap);
	
	
	
	
	function clearAll(){
		location="viewmap.php";
		wardGroup.clearLayers();
        buildingGroup.clearLayers();
        streetGroup.clearLayers();
        manholeGroup.clearLayers();
		borewellGroup.clearLayers();
        manholelineGroup.clearLayers();
        utilityGroup.clearLayers();	
		 citynameGroup.clearLayers();
		  cityroadGroup.clearLayers();
		  borewellGroup.clearLayers();
		   droneGroup.clearLayers();
			  citywardGroup.clearLayers();
			   abdGroup.clearLayers();
			    conturGroup.clearLayers();
				  certificateGroup.clearLayers();
				   citymarkerGroup.clearLayers();
        jQuery("#myTable").empty();
	}
	
	
	function removeWard(){
		wardGroup.removeLayer();
        buildingGroup.removeLayer();
        streetGroup.removeLayer();
        manholeGroup.removeLayer();
		borewellGroup.removeLayer();
        manholelineGroup.removeLayer();
        utilityGroup.removeLayer();	
		 citynameGroup.removeLayer();
		  cityroadGroup.removeLayer();
		  borewellGroup.removeLayer();
		   droneGroup.removeLayer();
		    certificateGroup.clearLayers();
			 citymarkerGroup.clearLayers();
        jQuery("#myTable").empty();
	}

    $(function(){
    	$('#ward').multiselect({
    		includeSelectAllOption: true,
    		nonSelectedText:'Ward'
    	});
    });

    $(function(){
    	$('#Street_Name').multiselect({
    		//includeSelectAllOption: false,
    		maxHeight:400,
    		 enableFiltering: true,
    		nonSelectedText:'Street Name',
    		enableClickableOptGroups: true,
    		enableCollapsibleOptGroups: true,
    		collapseOptGroupsByDefault: true,
    	});
    });
    
    $(function(){
    	$('#Utility_Name').multiselect({
    		includeSelectAllOption: true,
    		 enableFiltering: true,
    		nonSelectedText:'Utility Name',
    		maxHeight:400,
    	});
    });
    
    $(function(){
    	$('#PID').multiselect({
    		includeSelectAllOption: false,
    		 enableFiltering: true,
    		nonSelectedText:'PID',
    		maxHeight:400,
			enableClickableOptGroups: true,
    		enableCollapsibleOptGroups: true,
    		collapseOptGroupsByDefault: true,
    	});
    });
    
    $(function(){
    	$('#Usage1').multiselect({
    		includeSelectAllOption: true,
    		nonSelectedText:'Property Type',
    		maxHeight:400,
    	});
    });
    
    $(function(){
    	$('#Construction').multiselect({
    		includeSelectAllOption: true,
    		nonSelectedText:'Construction Type',
    		maxHeight:400,
    	});
    });
    
    $(function(){
    	$('#Area_Violation').multiselect({
    		includeSelectAllOption: true,
    		nonSelectedText:'Violation Type',
    		maxHeight:400,
    	});
    });
    
    $(function(){
    	$('#roadshow').multiselect({
    		includeSelectAllOption: false,
    		nonSelectedText:'Show Road',
    		maxHeight:400,
    	});
    });
    
    
    $(function(){
    	$('#ugdshow').multiselect({
    		includeSelectAllOption: false,
    		nonSelectedText:'Show UGD',
    		maxHeight:400,
    	});
    });
	$(function() {

	$('#akid').multiselect({
	
		includeSelectAllOption: false,
		nonSelectedText:'Show Akrama Sakarama',
		maxHeight:400,
	});
});
	
	$(function() {

	$('#watconid').multiselect({
	
		includeSelectAllOption: false,
		nonSelectedText:'Show Water Connection',
		maxHeight:400,
	});
});


/*$(function() {

	$('#services').multiselect({
	
		includeSelectAllOption: true,
		nonSelectedText:'Show Services',
		maxHeight:400,
	});
});
*/
$(".leaflet-control-layers-overlays").on("click", function(){
														   
		console.log("overlay-clicked");
        wardGroup.bringToBack();
    });

$(".leaflet-control-layers-overlays").on("click", function(){
														   
		console.log("overlay-clicked");
        conturGroup.bringToBack();
    });

$(".leaflet-control-layers-overlays").on("click", function(){
														   
		console.log("overlay-clicked");
        abdGroup.bringToBack();
    });

$(".leaflet-control-layers-overlays").on("click", function(){
														   
		console.log("overlay-clicked");
        manholelineGroup.bringToBack();
    });
$(".leaflet-control-layers-overlays").on("click", function(){
														   
		console.log("overlay-clicked");
        streetGroup.bringToFront();
    });

//$(".leaflet-control-layers-overlays").on("click", function(){
														   
	
      
   // });

function getAlert()
{
	//alert('Offical Login');	
	jQuery("#myModalalert").modal('show');
}

function Deldata(rem){
	$('#showdatarecord1').html(rem);

	
}

function getmiddle(){
	
	$("#myTable").empty();
	//$("#myTable1").empty();
			
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	jQuery.ajax({
				type: 'POST',
				url: 'getmiddlepanel.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name,
				dataType: 'html',
				success: function(data){	
										
			$('#showdatarecordmiddle').html(data);
				}
				});//ajax close
	
}

function getdataTable(){

	$("#myTable").empty();	
		$("#pagiservice").empty();
	//$("#myTable1").empty();
		
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	jQuery.ajax({
				type: 'POST',
				url: 'getbuildingtable.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name,
				dataType: 'html',
				success: function(data){	
						
				Deldata(data);
				jQuery('#serbtn').show();
					jQuery('#serbtnservice').hide();
						jQuery('#myInput').hide(); 
				}
				});//ajax close
	
}

function getbuildingtablelimitation(pageno){
	
	
	$("#myTable").empty();
	$("#pagiservice").empty();
			
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	//var pageno = $("#pageno").val();
	jQuery.ajax({
				type: 'POST',
				url: 'getbuildingtablelimitation.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name+"&pageno="+pageno,
				dataType: 'html',
				success: function(data){	
						
				Deldata(data);
				jQuery('#serbtn').show();
					jQuery('#serbtnservice').hide();
						jQuery('#myInput').hide(); 
				}
				});//ajax close
	
}

function getservicetablelimitation(pageno){


	$("#myTable").empty();	
	$("#pagi").empty();
	$("#pagiservice").empty();
	
			
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	var services = $("#services").val();
	
	
	jQuery.ajax({
				type: 'POST',
				url: 'getservicetablelimitation.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name+"&services="+services+"&pageno="+pageno,			
				dataType: 'html',
				success: function(data){	
					
			jQuery('#showdatarecord').html(data);	
				jQuery('#serbtn').hide();
					jQuery('#serbtnservice').show();
						jQuery('#myInput').hide(); 
			
				}
				});//ajax close
	
}

function getServices(){
	serviceGroup.clearLayers();
	buildingGroup.clearLayers();
	 certificateGroup.clearLayers();
	  violationGroup.clearLayers();
	  taxdetailGroup.clearLayers();
	$("#myTable").empty();
	//$("#myTable1").empty();
	$("#emptydata").empty();
	$("#pagi").empty();
	$("#pagiservice").empty();
	
	
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	var services = $("#services").val();
	//alert(services);
	jQuery.ajax({
				type: 'POST',
				url: 'getservicemap.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name+"&services="+services,
				dataType: 'html',
				success: function(data){				  
			//console.log(data);
				jQuery('#showdatarecord').html(data);	
				jQuery('#serbtn').hide();
					jQuery('#serbtnservice').show();
						jQuery('#myInput').hide(); 
				
				}
				});//ajax close
}

/*function getTaxMap(){
	//$("#myTable").empty();
	//$("#myTable1").empty();
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	var services = $("#services").val();
		var taxstatus = $("#taxstatus").val();
	if(taxstatus!=""){
		alert('hi');
		$("#myTable").empty();
		$("#myTable1").empty();
		
	serviceGroup.clearLayers();
	buildingGroup.clearLayers();
	 certificateGroup.clearLayers();
	  taxdetailGroup.clearLayers();
	jQuery.ajax({
				type: 'POST',
				url: 'gettaxdetailsmap.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name+"&services="+services+"&taxstatus="+taxstatus,
				dataType: 'html',
				success: function(data){				  
			//console.log(data);
				jQuery('#showdatarecord').html(data);		
				
				}
				});//ajax close
}}*/

function getStreet(){	
				var ward = jQuery("#ward").val();
				var tempselectedstreet=jQuery("#Street_Name").val();
				jQuery.ajax({
				type: 'POST',
				url: 'show_street.php',
				data: "ward="+ward,
				dataType: 'html',
				success: function(data){
				//	alert(data);
				$("#Street_Name").empty();
				//$("#Street_Name").append("<option value='stall'>All</option>");
				$("#Street_Name").append(data);					 
				$("#Street_Name").multiselect("rebuild");
				$("#Street_Name").multiselect('select', tempselectedstreet);
			}
		  });//ajax close
 
}

function getutil(){      
//alert('hi');
				var ward = jQuery("#ward").val();
				var Street_Name = jQuery("#Street_Name").val();
				var tempselectedutility=jQuery("#Utility_Name").val();
				
				jQuery.ajax({
				type: 'POST',
				url: 'utility.php',
				data: "Street_Name="+Street_Name+"&ward="+ward,
				dataType: 'html',
				success: function(data){	
				//alert(data);
				$("#Utility_Name").empty();
				//$("#Utility_Name").append("<option value='utiall'>All</option>");
				$("#Utility_Name").append(data);					 
				$("#Utility_Name").multiselect("rebuild");
				$("#Utility_Name").multiselect('select', tempselectedutility);
				/*				
				$.each(tempselectedutility, function(k,v){
					$("#Utility_Name").val(v).prop('checked', true);

					//console.log($("#Utility_Name").val(v).parent().parent());
					//$("input[value='"+v+"']").parent().parent().parent().addClass("active");
					});*/
									
				
				
				}
				});//ajax close
}

function getPid(){    
			var ward = jQuery("#ward").val();
			var Street_Name = jQuery("#Street_Name").val();
  var Usage1 = jQuery("#Usage1").val();
   var Construction = jQuery("#Construction").val();
   var Area_Violation=jQuery("#Area_Violation").val();
    var tempselectedarea_violation=jQuery("#Area_Violation").val();
	
			//alert(Topo_id);   
			jQuery.ajax({
			type: 'POST',
			url: 'PID.php',
			data: "Street_Name="+Street_Name+"&ward="+ward+"&Usage1="+Usage1+"&Construction="+Construction+"&Area_Violation="+Area_Violation,
			dataType: 'html',
			success: function(data){
				//alert(data);
			$("#PID").empty();
				$("#PID").append(data);					 
				$("#PID").multiselect("rebuild");
			
			
			}
			});//ajax close
}

	function getusage(){
var ward = jQuery("#ward").val();
 var Street_Name = jQuery("#Street_Name").val();
 var tempselecteproperty=jQuery("#Usage1").val();
//alert(Topo_id);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'property.php',
		  data: "Street_Name="+Street_Name+"&ward="+ward,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		$("#Usage1").empty();
			//$("#taxstatus").empty();
				//$("#Usage1").append("<option value='utiall'>All</option>");
				$("#Usage1").append(data);					 
				$("#Usage1").multiselect("rebuild");
					$("#Usage1").multiselect('select', tempselecteproperty);
				
				
			}
		  });//ajax close
}

	function getviolation(){
var ward = jQuery("#ward").val();
 var Street_Name = jQuery("#Street_Name").val();
  var Usage1 = jQuery("#Usage1").val();
   var Construction = jQuery("#Construction").val();
   var Area_Violation=jQuery("#Area_Violation").val();
    var tempselectedarea_violation=jQuery("#Area_Violation").val();
//alert(Topo_id);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'violation.php',
		  data: "Street_Name="+Street_Name+"&ward="+ward+"&Construction="+Construction+"&Usage1="+Usage1,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		$("#Area_Violation").empty();
				//$("#Area_Violation").append("<option value='utiall'>All</option>");
				$("#Area_Violation").append(data);					 
				$("#Area_Violation").multiselect("rebuild");
			$("#Area_Violation").multiselect('select', tempselectedarea_violation);
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}


/*function showtaxdata(){
	$("#myTable").empty();
var ward = jQuery("#ward").val();
 var Street_Name = jQuery("#Street_Name").val();
  var Usage1 = jQuery("#Usage1").val();
   var Construction = jQuery("#Construction").val();
   var Area_Violation=jQuery("#Area_Violation").val();
    var tempselectedarea_violation=jQuery("#Area_Violation").val();
//alert(Topo_id);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'showtaxdata.php',
		  data: "Street_Name="+Street_Name+"&ward="+ward+"&Construction="+Construction+"&Usage1="+Usage1+"&Area_Violation="+Area_Violation,
		  dataType: 'html',
		  success: function(data){				  
		alert(data);
		$("#taxstatus").empty();
				//$("#Area_Violation").append("<option value='utiall'>All</option>");
				$("#taxstatus").append(data);					 
				 getTaxMap();
			}
		  });//ajax close
}*/

function showServices(){
var ward = jQuery("#ward").val();
 var Street_Name = jQuery("#Street_Name").val();
  var Usage1 = jQuery("#Usage1").val();
   var Construction = jQuery("#Construction").val();
   var tempselectedservices=jQuery("#services").val();
//alert(Topo_id);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'show_services.php',
		  data: "Street_Name="+Street_Name+"&ward="+ward+"&Construction="+Construction+"&Usage1="+Usage1,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		$("#services").empty();
				//$("#Area_Violation").append("<option value='utiall'>All</option>");
				$("#services").append(data);					 
			//	$("#services").multiselect("rebuild");
		//	$("#services").multiselect('select', tempselectedservices);
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
function getplot(){  
var tempselecteconstruction=jQuery("#Construction").val();
				var Street_Name = jQuery("#Street_Name").val();
				var ward = jQuery("#ward").val();
				var Usage1 = jQuery("#Usage1").val();
				
				jQuery.ajax({
				type: 'POST',
				url: 'Construction.php',
				data: "Street_Name="+Street_Name+"&ward="+ward+"&Usage1="+Usage1,
				dataType: 'html',
				success: function(data){				  
				//alert(data);
				$("#Construction").empty();
				//$("#Construction").append("<option value='utiall'>All</option>");
				$("#Construction").append(data);					 
				$("#Construction").multiselect("rebuild");
					$("#Construction").multiselect('select', tempselecteconstruction);
				}
				});//ajax close
}
    //building
	function getward(x){
		
		console.log(ward)
		jQuery.ajax({
    		type: 'POST',
    		url: 'getwardmap.php',
    		data: "ward="+x,
    		dataType: 'html',
    		success: function(data){	
    		jQuery('#showdatarecord').html(data);	
		//	getcons();
			showDrone();
			
    		}
		});//ajax close
			
	}
	function showDrone(){      
//alert('hello');
 var ward = jQuery("#ward").val();
//alert(Topo_id);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'show_drone.php',
		  data: "ward="+ward,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#showdronimage').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
		
    //building
	function testrun(){
		console.log('testrun callback');
		console.log(buildingpoly_list);				
		console.log($("#Usage1").val().length);
		if($("#Usage1").val().length != 0){
			$("#Usage1").trigger("change");
		}
		else{
		}
		if($("#Construction").val().length != 0){
			$("#Construction").trigger("change");
		}
		else{
		}
		if($("#Area_Violation").val().length != 0){
			$("#Area_Violation").trigger("change");
		}
		else{
		}
		/*console.log('trigger utility start');
		if($("#Utility_Name").val().length != 0){
			console.log('run');
			$("#Utility_Name").trigger("change");
		}
		else{
			console.log('utility fail');
			console.log($("#Utility_Name").val());
		}*/
		if($("#PID").val().length != 0){
			$("#PID").trigger("change");
		}
		else{
		}
			$("#Street_Name").multiselect("rebuild");
			$("#PID").multiselect("rebuild");
	}
	
    function getbuilding(){
	
			var PID = jQuery("#PID").val();
			//alert(PID)
		jQuery.ajax({
			type: 'POST',			
			url: 'getbuildingmap.php',
			data: "ward="+ward+"&PID="+PID,
			dataType: 'html',
			success: function(data){				  
		//	alert(data);
				jQuery('#showdatarecord').html(data);	
				
				testrun();
				
			}
		});//ajax close
	}
		
	function showmap(id){
		
		window.scrollTo(0,220);
		console.log(bpoly[id]);
		
		bpoly[id].openPopup();
		
		//buildingpoly_list[ward][id][0].openPopup();
		
		//mymap.fitBounds(polygon.getBounds());		
	}
        	
        
    function roadrun(){
		console.log("roadrun");
		console.log(roadpoly_list);
		if($("#Street_Name").val().length != 0){uilding
			$("#Street_Name").trigger("change");
		}
		else{
		}		
	}
	
	function getroad(){	 
	//alert('hi');
		console.log('road');
		jQuery.ajax({
			type: 'POST',
			url: 'getroadmap.php',
			data: 'ward='+ward,
			dataType: 'html',
			success: function(data){
				//console.log('get road');
				//console.log(data);
				jQuery('#showdatarecord').html(data);	
				roadrun();
				
			}
		});//ajax close	
	}
	
	function getmanhole(){
		console.log('manholedata');
		var ugdshow = jQuery("#ugdshow").val();
		jQuery.ajax({
        	type: 'POST',
        	url: 'getmanholemap.php',
        	data: 'ward='+ward+"&ugdshow="+ugdshow,
        	dataType: 'html',
        	success: function(data){  
        	    jQuery('#showdatarecord').html(data);	
        	//jQuery("#myModal").modal('show');
        	}
		});//ajax close	
			
	}
	
	function getborewell(){
		jQuery.ajax({
        	type: 'POST',
        	url: 'getborewellutilitymap.php',
        	data: 'ward='+ward,
        	dataType: 'html',
        	success: function(data){  
		//	alert(data);
        	    jQuery('#showdatarecord').html(data);	
        	//jQuery("#myModal").modal('show');
        	}
		});//ajax close	
			
	}
	
	
	function getutility(){
	
		var localvarward=$("#ward").val();
		var Utility_Name = jQuery("#Utility_Name").val();
		var Street_Name = jQuery("#Street_Name").val();
		console.log('get utility function');
		console.log(localvarward);
		console.log(Utility_Name.length);
		jQuery.ajax({
    		type: 'POST',
    		url: 'getutilitymap.php',
    		data: 'ward='+localvarward+"&Utility_Name="+Utility_Name+"&Street_Name="+Street_Name,
    		dataType: 'html',
    		success: function(data){  
        	
        		jQuery('#showdatarecord').html(data);	
				//getdataTable();
        		//	jQuery("#myModal").modal('show');
    		}
		});//ajax close
	}
	
	
	
	function getmanholeline(){
		console.log('manholeline');
		var ugdshow = jQuery("#ugdshow").val();
		jQuery.ajax({
    		type: 'POST',
    		url: 'getmanholelinemap.php',
    		data: 'ward='+ward+"&ugdshow="+ugdshow,
    		dataType: 'html',
    		success: function(data){  
    		    jQuery('#showdatarecord').html(data);	
    	    	//	jQuery("#myModal").modal('show');
    		}
		});//ajax close	
	}
	
	function showbuilding(id,ward){	

		jQuery.ajax({
    		type: 'POST',
    		url: 'building_details.php',
    		data: 'id='+id+'&ward='+ward,
    		dataType: 'html',
    		success: function(data){  
        		//alert(data);
        		jQuery('#showroadmap').html(data);  
        		jQuery("#myModal").modal('show');
    		}
		});//ajax close
	}
	
	function showbuildingtax(pid,ward){	

		jQuery.ajax({
    		type: 'POST',
    		url: 'building_taxdetails.php',
    		data: 'pid='+pid+'&ward='+ward,
    		dataType: 'html',
    		success: function(data){  
        		//alert(data);
        		jQuery('#showtax').html(data);  
        		jQuery("#myModaltax").modal('show');
				//jQuery("#myModal").modal('hide');
    		}
		});//ajax close
	}
	
	function showbuildingcertificate(pid,ward){	
	
		jQuery.ajax({
    		type: 'POST',
    		url: 'building_detailscertificate.php',
    		data: 'pid='+pid+'&ward='+ward,
    		dataType: 'html',
    		success: function(data){  
        		//alert(data);
        		jQuery('#showroadmap').html(data);  
        		jQuery("#myModal").modal('show');
    		}
		});//ajax close
	}
	function showborwellmodel(id){	
	
		jQuery.ajax({
    		type: 'POST',
    		url: 'borewell_details.php',
    		data: 'id='+id,
    		dataType: 'html',
    		success: function(data){  
        		//alert(data);
        		jQuery('#showbore').html(data);  
        		jQuery("#myModalbore").modal('show');
    		}
		});//ajax close
	}
	
  /* function getutil(){      
		var ward = jQuery("#ward").val();
		var Street_Name = jQuery("#Street_Name").val();
		jQuery.ajax({
    		type: 'POST',
    		url: 'utility.php',
    		data: "Street_Name="+Street_Name+"&ward="+ward,
    		dataType: 'html',
    		success: function(data){	
			//alert(data);
        		$("#Utility_Name").empty();
        		$("#Utility_Name").append("<option value='utiall'>All</option>");
        		$("#Utility_Name").append(data);					 
        		$("#Utility_Name").multiselect("rebuild");
		    }
		});//ajax close
    }    */

    

    function getcons(){
        var tstart = performance.now();
		 citynameGroup.clearLayers();
		  citymarkerGroup.clearLayers();
		  cityroadGroup.clearLayers();
		   borewellGroup.clearLayers();
		   // wardGroup.clearLayers();
			  citywardGroup.clearLayers();
			   abdGroup.clearLayers();
			   conturGroup.clearLayers();
   
        getmanholeline();
    	getmanhole();
		getborewell();
		getmiddle();
		getdataTable();
		getbuilding();
		 getroad();
				//getutil();
				getStreet();
				getutil();
				getPid();
				getusage();
				getplot();
				getviolation();
				showServices();
			
				
					$("#Utility_Name").trigger("change");
				
    	var tend = performance.now();
    	jQuery("#loadtime").text((tend-tstart)+"ms");
	}
	
	jQuery("#Utility_Name").on("change", function(){
        utilityGroup.clearLayers();
        getutility();
	});
	
	
	
	$("#ward").on("change", function(){	
	//serviceGroup.clearLayers();
/*if($(this).val()==3){									 
 var imageUrl = 'drone/3.jpeg',
imageBounds = [[13.3523685, 77.10007232], [13.34452624, 77.10291028]];
//L.marker([13.34452624, 77.1029102]).addTo(droneGroup);
L.imageOverlay(imageUrl, imageBounds).addTo(droneGroup);
}*/
		var ward_list = $(this).val();
		//alert(ward_list);
		
		console.log('main');
		console.log(ward_list);
		/*if(ward_list.length == 1 && ward_list[0] == "all"){
			var tempwardlist = [3,4,5,12,13,16,17,18,19,22];
			$.each(tempwardlist, function(wk,wv){
				ward = wv;
				getward();
			});
		}*/
		if(ward_list.length == 10){
			var tempwardlist = [3,4,5,12,13,16,17,18,19,22];
			$.each(tempwardlist, function(wk,wv){
				ward = wv;
				getward(wv);
				getcons();
			});
		}
		if(ward_list.length == 0){
			clearAll();
		}
		
		else if(ward_list_old.length==0)
		{
			console.log('check1');
			ward = ward_list[ward_list.length-1];
			add_ward = ward;
			console.log(ward_list,ward);
			getward(add_ward);
			getcons();
		}
		else if(ward_list_old.length > ward_list.length && ward_list.length == 0)
		{
			ward = ward_list_old[ward_list_old.length-1];
			rem_ward = ward;
			wardGroup.removeLayer(wardpoly_list[ward][0]);
			$.each(buildingpoly_list[ward],function(k,v){
				buildingGroup.removeLayer(buildingpoly_list[ward][k][0]);				
			});
			//road
			$.each(roadpoly_list[ward],function(k,v){
				streetGroup.removeLayer(roadpoly_list[ward][k][0]);
			});
			//manhole line
			$.each(manholelinepoly_list[ward],function(k,v){
				manholelineGroup.removeLayer(manholelinepoly_list[ward][k][0]);
			});
			//manholedata
			$.each(manholedatapoly_list[ward],function(k,v){
				manholeGroup.removeLayer(manholedatapoly_list[ward][k][0]);
			});
			
			//Borewell
			$.each(borewellpoly_list[ward],function(k,v){
				borewellGroup.removeLayer(borewellpoly_list[ward][k][0]);
			});
			$("#Utility_Name").trigger("change");
			
		}
		else if(ward_list_old.length > ward_list.length && ward_list.length > 0)
		{
			$.each(ward_list_old, function(k,v){
				if ($.inArray(v, ward_list) == -1){
					ward = v;	
					wardGroup.removeLayer(wardpoly_list[ward][0]);
					getusage();
					getplot();
					getviolation();
					showServices();
					//showtaxdata();
					getutil();
					$.each(buildingpoly_list[ward],function(k,v){
						buildingGroup.removeLayer(buildingpoly_list[ward][k][0]);
						
					});
					//road
					$.each(roadpoly_list[ward],function(k,v){
						streetGroup.removeLayer(roadpoly_list[ward][k][0]);
					});
					//manhole line
						$.each(manholelinepoly_list[ward],function(k,v){
						manholelineGroup.removeLayer(manholelinepoly_list[ward][k][0]);
					});
						//manholedata
						$.each(manholedatapoly_list[ward],function(k,v){
						manholeGroup.removeLayer(manholedatapoly_list[ward][k][0]);
					});
						
						//Borewell
						$.each(borewellpoly_list[ward],function(k,v){
						borewellGroup.removeLayer(borewellpoly_list[ward][k][0]);
					});
					console.log('check2 remove');	
					$("#Utility_Name").trigger("change");
				}
				else{
				}
			});
		}
		else
		{
			$.each(ward_list, function(k,v){
				if ($.inArray(v, ward_list_old) == -1){
					console.log('check3');
					ward = v;
					add_ward = ward;
					console.log(ward_list,ward);
					getward(add_ward);
					getcons();
					$("#Utility_Name").trigger("change");
				}
				else{
				}
			});
		}
		ward_list_old=ward_list;
		if($("#Usage1").val() != 0){
			$("#Usage1").trigger("change");
			
		}
		else if ($("#Construction").val() != 0){
			$("#Construction").trigger("change");
		}
		else if ($("#Area_Violation").val() != 0){
			$("#Area_Violation").trigger("change");
		}
		else{}

	});
	
	//property
	function paramcheck(p_one, p_two, pt_one, pt_two, wv, bk, query_type, p_type, query_list){
	    var param_one = p_one;
	    var param_two = p_two;
	    var param_one_type = pt_one;
	    var param_two_type = pt_two;
	    if(param_one.length != 0 && param_two.length != 0){
		    //console.log("Both params available");
			$.each(param_one, function(pok,pov){
				if(buildingpoly_list[wv][bk][param_one_type] == pov){
					$.each(param_two, function(ptk,ptv){
						if(buildingpoly_list[wv][bk][param_two_type] == ptv){
							if(buildingpoly_list[wv][bk][query_type] == p_type){					
								var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
							}
						}
					});
				}
			});
		}
		else if(param_one.length != 0){
			//console.log("param_one available");
			$.each(param_one, function(pok,pov){
				if(buildingpoly_list[wv][bk][param_one_type] == pov){
					if(buildingpoly_list[wv][bk][query_type] == p_type){					
						var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
					}
				}
			});
		}
		else if(param_two.length !=  0){
		    //console.log("param_two available");
			$.each(param_two, function(ptk,ptv){
				if(buildingpoly_list[wv][bk][param_two_type] == ptv){
					if(buildingpoly_list[wv][bk][query_type] == p_type){					
						var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
					}
				}
			});
		}
		else if(param_one.length == 0 && param_two.length == 0 && buildingpoly_list[wv][bk][query_type] == p_type){
			//console.log("paramone/two not available; query available");
			//console.log(wv,bk);
			var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
			//polygon.setStyle({color: 'red',weight:1,fillOpacity: 0.08});
		}
		else if(param_one.length == 0 && param_two.length == 0 && buildingpoly_list[wv][bk][query_type] != p_type && query_list == 0){
			//console.log("paramone/two not available; query not available");
			var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
		}
		else{								
		}
	}
	
	function addbuildingelements(q_list,p,q_type,s_ward){
		//console.log("addbuildingelements");
	//	console.log(q_list,p,q_type);
		var query_list = q_list;
		var tempward = $("#ward").val();
		var tempstreet = $("#Street_Name").val();
		var tempconst = $("#Construction").val();
		var tempviol = $("#Area_Violation").val();
		var tempserv = $("#services").val();
		var p_type = p;
		var query_type = q_type;
		var spec_ward = s_ward;
		var param_one
		var param_two
		if(query_type == "prop_type"){
			param_one = $("#Construction").val();
			param_two = $("#Area_Violation").val();
			param_one_type = 'const_type';
			param_two_type = 'viol_type';
		}
		else if(query_type == "const_type"){
			param_one = $("#Usage1").val();
			param_two = $("#Area_Violation").val();
			param_one_type = 'prop_type';
			param_two_type = 'viol_type';
		}
		else if(query_type == "viol_type"){
			param_one = $("#Usage1").val();
			param_two = $("#Construction").val();
			param_one_type = 'prop_type';
			param_two_type = 'const_type';
		}
		else if(query_type == "Water_Con_Avbl"){
			param_one = $("#Usage1").val();
			param_two = $("#Construction").val();
			param_one_type = 'prop_type';
			param_two_type = 'const_type';
			//console.log('JHGJHGG');
		}
		
		else{
			query_type = "noteql";
			p_type = "eql";
			param_one = "";
			param_two = "";
		}
		var count=0;
		function buildingworks(wv){
			console.log(query_type, p_type, query_list.length, query_list);
		    $.each(buildingpoly_list[wv], function(bk, bv){
				if(tempstreet.length != 0){
					//console.log("street yes");
					$.each(tempstreet, function(rk,rv){
						if(buildingpoly_list[wv][bk]['street_id'] == rv){
						    paramcheck(param_one, param_two, param_one_type, param_two_type, wv, bk, query_type, p_type, query_list);
						}
					});
				}								   
				else if(buildingpoly_list[wv][bk][query_type] == p_type && query_list.length != 0){
					//console.log(query_type, p_type, tempstreet.length, query_list.length, query_list);
					//console.log("query_type/p_type match and query_list not empty");
					//buildingGroup.clearLayers();
				//	console.log("asdasddfsdfsdfasdasd");
					if(buildingpoly_list[wv][bk][query_type] == p_type){					
					//	var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
						paramcheck(param_one, param_two, param_one_type, param_two_type, wv, bk, query_type, p_type, query_list);

					}
					//paramcheck(param_one, param_two, param_one_type, param_two_type);
					count++;
				}
				else if(buildingpoly_list[wv][bk][query_type] != p_type && query_list.length == 0){
					//console.log(query_type, p_type, tempstreet.length);
					//console.log("no match, street 0");
					//console.log("zxczxczxczxczxczxczxczx");
					var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
				}
				else{
				//	console.log("allfail");
					//var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
				}
			});
		}
		if(spec_ward != "" && spec_ward != undefined){
		    var wv = spec_ward;
		    console.log("Spec'd!");
		    console.log(spec_ward);
			//alert(wv);
		    buildingworks(wv);
		}
		else{
    		$.each(tempward, function(wk,wv){
				//console.log('addbuildingelements each ward'+wv);					  
    			buildingworks(wv);
    		});
		}
	}

	function buildingquery(q_type,q_val){
		var query_list = [];
		var tempward = $("#ward").val();
		var tempstreet = $("#Street_Name").val();
		//var tempconst = $("#Construction").val();
		//var tempviol = $("#Area_Violation").val();
		var query_type;
		if(q_type == 'prop_type'){
			query_type=q_type;
			query_list = $("#Usage1").val();
			
		}
		else if(q_type == 'const_type'){
			query_type=q_type;
			query_list = $("#Construction").val();
		}
		else if(q_type == 'viol_type'){
			query_type=q_type;
			query_list = $("#Area_Violation").val();
		}
		else if(q_type == 'Water_Con_Avbl'){
			query_type=q_type;
			query_list = q_val;
						
		}
		else {
			//alert('Unknown Query');
		}
		if(query_list_old.length==0 && query_list.length == 0){
			if(q_type == 'prop_type'){
				query_list  =	['COMMERCIAL', 'EDUCATIONAL', 'GOVT.BUILDING','GOVT.PROPERTY','MIXED USE','OTHERS','RELIGIOUS','RESIDENTIAL','VACANT LAND', 'VACANT LAND WITH CON'];
			}
			else if(q_type == 'const_type'){
				query_list = ['OTHERS','RCC','RCCTILED','TILED'];
			}
			else if(q_type == 'viol_type'){
				query_list = ['Residential(MIS) To Commercial(GIS)','Residential(MIS) To Mix(GIS)','PID Not Mapped','Constructed more than MIS','Constructed more than Plan'];
			}
			else{}
			$.each(query_list, function(k,v ){
				var p_type = v;
				addbuildingelements(query_list, p_type, query_type);
			});
			
		}
		if(query_list_old.length==0)
		{
			/*console.log('check1');
			buildingGroup.clearLayers();
	    	console.log(buildingpoly_list);
			var p_type = query_list;
			console.log(query_list, p_type, query_type);
			addbuildingelements(query_list, p_type, query_type);*/
			console.log('check1');
			buildingGroup.clearLayers();
	    	console.log(buildingpoly_list);
			$.each(query_list, function(k,v ){
				var p_type = v;
				addbuildingelements(query_list, p_type, query_type);
			});
			
			/*if($("#Construction").val().length != 0){
				$("#Construction").trigger("change");
			}
			if($("#Area_Violation").val().length != 0){
				$("#Area_Violation").trigger("change");
			}*/
		}
		/*else if(query_list_old.length==1 && query_list.length == 1){
			console.log('same prop new ward');
			console.log(query_list_old, query_list);

			var p_type = query_list;
			if(tempstreet.length == 0){
    			$.each(buildingpoly_list[add_ward], function(bk, bv){
    				console.log('same prop new ward aa');										 
    				buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);												 
    			});
    			$.each(buildingpoly_list, function(bk, bv){
    				console.log('same prop new ward bb');
    				//console.log(buildingpoly_list[add_ward]);
    				if(buildingpoly_list[add_ward][bk][query_type] == p_type){
    					//console.log(query_list, buildingpoly_list[add_ward][bk]['prop_type'], query_type);
    					addbuildingelements(query_list, p_type, query_type, add_ward);				
    					//var polygon = buildingpoly_list[add_ward][bk][0].addTo(buildingGroup);
    				}
    			});
			}
			else{
			    console.log("street check in ward/building query");
                buildingGroup.clearLayers();
	            $.each(tempward, function(wk,wv){
	               // $.each(tempstreet, function(sk, sv){
//    					$.each(buildingpoly_list[wv], function(bk, bv){
//    						if(buildingpoly_list[wv][bk]['street_id'] == sv){
//    						    console.log(wv,sv, buildingpoly_list[wv][bk][0]);
//    						    $.each(buildingpoly_list[wv], function(bbk, bbv){
//								    buildingGroup.removeLayer(buildingpoly_list[wv][bbk][0]);
//    						    });
//    						}
//    					});
//	                });
	                addbuildingelements(query_list, p_type, query_type, wv);
				});
			}
		}*/
		else if(query_list_old.length > query_list.length && query_list.length == 0)
		{
			/*var p_type = query_list_old[query_list_old.length-1];
			$.each(tempward, function(wk,wv){
				$.each(buildingpoly_list[wv], function(bk, bv){
					if(buildingpoly_list[wv][bk]['prop_type'] == p_type){
						buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
					}
				});
			});*/
			console.log("final unchecked");
			buildingGroup.clearLayers();
			console.log("final unchecked 2 ");
			addbuildingelements(query_list);
			if(q_type == 'prop_type'){
				if($("#Construction").val() != 0){
					$("#Construction").trigger("change");
				}
				else if ($("#Area_Violation").val() != 0){
					$("#Area_Violation").trigger("change");
				}
				else{}
			}
			else if(q_type == 'const_type'){
				if($("#Usage1").val() != 0){
					$("#Usage1").trigger("change");
				}
				else if ($("#Area_Violation").val() != 0){
					$("#Area_Violation").trigger("change");
				}
				else{}
			}
			else if(q_type == 'viol_type'){
				if($("#Usage1").val() != 0){
					$("#Usage1").trigger("change");
				}
				else if ($("#Construction").val() != 0){
					$("#Construction").trigger("change");
				}
				else{}
			}
			else{}
		}
		else if(query_list_old.length > query_list.length && query_list.length > 0)
		{
			$.each(query_list_old, function(k,v){
				if ($.inArray(v, query_list) == -1){
					var p_type = v;	
					$.each(tempward, function(wk,wv){
						$.each(buildingpoly_list[wv], function(bk, bv){
							if(buildingpoly_list[wv][bk][query_type] == p_type){
								buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
							}
						});
					});
					console.log('check2 remove');
				}
				else{
				}
			});
		}
		else
		{
			console.log('Check 4 Prop Type');
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				if ($.inArray(bv[query_type], query_list) == -1){										 
					buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);
				}
			});
			$.each(query_list, function(k,v){
				if ($.inArray(v, query_list_old) == -1){					
					addbuildingelements(query_list, v, query_type);
				}
				else{
				}
			});
		}
		query_list_old=query_list;
		
	}

	$("#Usage1").on("change", function(){
									  
					$("#myTable").empty();	
					$("#pagi").empty();
	$("#pagiservice").empty();
					//	 showtaxdata();		   
									    certificateGroup.clearLayers();
										violationGroup.clearLayers();
		serviceGroup.clearLayers();
		 taxdetailGroup.clearLayers();
		buildingquery("prop_type");
		
		getdataTable();
		getPid();
		getplot();
		 getviolation();
		 showServices();
		 
		// getTaxMap();
		  buildingGroup1.bringToBack();
	});
	
	//Construction 
	$("#Construction").on("change", function(){
											 
											
											 $("#myTable").empty();
											 $("#pagi").empty();
											$("#pagiservice").empty();
											  certificateGroup.clearLayers();
		serviceGroup.clearLayers();	
		violationGroup.clearLayers();	
		 taxdetailGroup.clearLayers();
		console.log("checked construction");
	    buildingquery("const_type");
		getdataTable();
		 getviolation();
		 getPid();
		// showtaxdata();
		  showServices();
		 //  getTaxMap();
		   buildingGroup1.bringToBack();
		/*var constr_list = $(this).val();
		var tempward = $("#ward").val();
		var tempstreet = $("#Street_Name").val();
		var tempprop = $("#Usage1").val();
		var tempviol = $("#Area_Violation").val();
		if(constr_list_old.length==0){
			console.log('check1');
			buildingGroup.clearLayers();	
			var p_type = constr_list;
			addbuildingelements(p_type,"const_type");
		}
		else if(constr_list_old.length==1 && constr_list.length == 1){
			console.log('same Const new ward');
			var p_type = constr_list;
			console.log(buildingpoly_list);
			console.log(buildingpoly_list[add_ward]);
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				console.log('same Const new ward aa');										 
				buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);												 
			});
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				console.log('same Const new ward bb');										 
				if(buildingpoly_list[add_ward][bk]['const_type'] == p_type){	
					addbuildingelements(buildingpoly_list[add_ward][bk]['const_type'],"const_type");
				}
			});				
		}
		else if(constr_list_old.length > constr_list.length && constr_list.length == 0){
			var p_type = constr_list_old[constr_list_old.length-1];
			$.each(tempward, function(wk,wv){
				$.each(buildingpoly_list[wv], function(bk, bv){
					if(buildingpoly_list[wv][bk]['const_type'] == p_type){
						buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
					}
				});
			});
		}
		else if(constr_list_old.length > constr_list.length && constr_list.length > 0){
			$.each(constr_list_old, function(k,v){
				if ($.inArray(v, constr_list) == -1){
					var p_type = v;	
					$.each(tempward, function(wk,wv){
						$.each(buildingpoly_list[wv], function(bk, bv){
							if(buildingpoly_list[wv][bk]['const_type'] == p_type){
								buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
							}
						});
					});
					console.log('check2 remove');
				}
				else{
				}
			});
		}
		else
		{
			console.log('Check 4 Prop Type');
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				if ($.inArray(bv['const_type'], constr_list) == -1){										 
					buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);
				}
			});
			$.each(constr_list, function(k,v){
				if ($.inArray(v, constr_list_old) == -1){	
					addbuildingelements(v,"const_type");
				}
				else{
				}
			});
		}
		constr_list_old=constr_list;*/
	});
	
	//Area_Violation 
	$("#Area_Violation").on("change", function(){
											 										  
											   $("#myTable").empty();
											   $("#pagi").empty();
	$("#pagiservice").empty();
											    certificateGroup.clearLayers();
		serviceGroup.clearLayers();
		 taxdetailGroup.clearLayers();
	    buildingquery("viol_type");
		getdataTable();
		getPid();
		// showtaxdata();
		// getTaxMap();
		 buildingGroup1.bringToBack();
		/*var violat_list = $(this).val();
		var tempward = $("#ward").val();
		var tempstreet = $("#Street_Name").val();
		var tempprop = $("#Usage1").val();
		var tempconst = $("#Construction").val();
		if(violat_list_old.length==0)
		{
			console.log('check1');
			buildingGroup.clearLayers();
			var p_type = violat_list;
			addbuildingelements(p_type,"viol_type");
		}
		else if(violat_list_old.length==1 && violat_list.length == 1){
			console.log('same Area Vail new ward');
			var p_type = violat_list;
			console.log(buildingpoly_list);
			console.log(buildingpoly_list[add_ward]);
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				console.log('same Area Vail new ward aa');										 
				buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);												 
			});
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				console.log('same Area Vail new ward bb');										 
				if(buildingpoly_list[add_ward][bk]['viol_type'] == p_type){	

					addbuildingelements(buildingpoly_list[add_ward][bk]['viol_type'],"viol_type");			
					//var polygon = buildingpoly_list[add_ward][bk][0].addTo(buildingGroup);
				}
			});				
		}
		else if(violat_list_old.length > violat_list.length && violat_list.length == 0)
		{
			var p_type = violat_list_old[violat_list_old.length-1];
			$.each(tempward, function(wk,wv){
				$.each(buildingpoly_list[wv], function(bk, bv){
					if(buildingpoly_list[wv][bk]['viol_type'] == p_type){
						buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
					}
				});
			});
		}
		else if(violat_list_old.length > violat_list.length && violat_list.length > 0)
		{
			$.each(violat_list_old, function(k,v){
				if ($.inArray(v, violat_list) == -1){
					var p_type = v;	
					$.each(tempward, function(wk,wv){
						$.each(buildingpoly_list[wv], function(bk, bv){
							if(buildingpoly_list[wv][bk]['viol_type'] == p_type){
								buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
							}
						});
					});
					console.log('check2 remove');
				}
				else{
				}
			});
		}
		else
		{
			console.log('Check 4 Prop Type');
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				if ($.inArray(bv['viol_type'], violat_list) == -1){										 
					buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);
				}
			});
			$.each(violat_list, function(k,v){
				if ($.inArray(v, violat_list_old) == -1){	
						addbuildingelements(v,"viol_type");
				}
				else{
				}
			});
		}
		violat_list_old=violat_list;*/
	});
	
	
	//PID Data
	$("#PID").on("change", function(){
									
									$("#myTable").empty();
									 certificateGroup.clearLayers();
		getdataTable();
		// showtaxdata();
		// getTaxMap();
		
		  buildingGroup1.bringToBack();
		var pid_list = $(this).val();
		var tempward = $("#ward").val();
		if(pid_list_old.length==0)
		{
			console.log('check1');
			buildingGroup.clearLayers();	
			var p_type = pid_list;
			$.each(tempward, function(wk,wv){
				$.each(buildingpoly_list[wv], function(bk, bv){
					if(buildingpoly_list[wv][bk]['pid_no'] == p_type){					
						var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
					}
				});
			});
		}
		else if(pid_list_old.length==1 && pid_list.length == 1){
			console.log('same prop new ward');
			var p_type = pid_list;
			console.log(buildingpoly_list);
			console.log(buildingpoly_list[add_ward]);
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				console.log('same prop new ward aa');										 
				buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);												 
			});
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				console.log('same prop new ward bb');										 
				if(buildingpoly_list[add_ward][bk]['pid_no'] == p_type){					
					var polygon = buildingpoly_list[add_ward][bk][0].addTo(buildingGroup);
				}
			});				
		}
		else if(pid_list_old.length > pid_list.length && pid_list.length == 0)
		{
			var p_type = pid_list_old[pid_list_old.length-1];
			$.each(tempward, function(wk,wv){
				$.each(buildingpoly_list[wv], function(bk, bv){
					if(buildingpoly_list[wv][bk]['pid_no'] == p_type){
						buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
					}
				});
			});
		}
		else if(pid_list_old.length > pid_list.length && pid_list.length > 0)
		{
			$.each(pid_list_old, function(k,v){
				if ($.inArray(v, pid_list) == -1){
					var p_type = v;	
					$.each(tempward, function(wk,wv){
						$.each(buildingpoly_list[wv], function(bk, bv){
							if(buildingpoly_list[wv][bk]['pid_no'] == p_type){
								buildingGroup.removeLayer(buildingpoly_list[wv][bk][0]);
							}
						});
					});
					console.log('check2 remove');
				}
				else{
				}
			});
		}
		else
		{
			console.log('Check 4 Prop Type');
			$.each(buildingpoly_list[add_ward], function(bk, bv){
				if ($.inArray(bv['pid_no'], pid_list) == -1){										 
					buildingGroup.removeLayer(buildingpoly_list[add_ward][bk][0]);
				}
			});
			$.each(pid_list, function(k,v){
				if ($.inArray(v, pid_list_old) == -1){					
					var p_type = v;
					$.each(tempward, function(wk,wv){
						$.each(buildingpoly_list[wv], function(bk, bv){
							if(buildingpoly_list[wv][bk]['pid_no'] == p_type){	
								var polygon = buildingpoly_list[wv][bk][0].addTo(buildingGroup);
							}
						});
					});
				}
				else{
				}
			});
		}
		pid_list_old=pid_list;
	});

	//street
	var completed_check = [];
	jQuery("#Street_Name").on("change", function(){	
												 $("#myTable").empty();
		    getutil();
			getPid();
			getusage();
			getplot();
			getviolation();
		//	showtaxdata();
			 showServices();
			//  getTaxMap();
			  buildingGroup1.bringToBack();
			console.log('roadpolylist');
			console.log(roadpoly_list);
		var road_list = $(this).val();
		var tempward = $("#ward").val();
		if(road_list_old.length==0)
		{
			$.each(tempward,function(wk,wv){
				if($.inArray(wv, completed_check) == -1){
					$.each(roadpoly_list[wv], function(rk, rv){
						streetGroup.removeLayer(rv[0]);
					});
					completed_check.push(wv);
				}
			});
			console.log('check1 road');
			console.log(road_list_old);
			//ward = $(this).parent().first().find("input").val();
			var road = $(this).val();
			console.log(ward, road);	
			$.each(tempward,function(wk,wv){
				$.each(road_list,function(rk,rv){										  
					if (rv in roadpoly_list[wv]){
						var polygon = roadpoly_list[wv][rv][0].addTo(streetGroup);
					//	polygon.setStyle({color: '#b5afab',weight:5});
					}
					else{
					}
				});
			});
		}
		else if(road_list_old.length > road_list.length && road_list.length == 0)
		{
			//road
			var road = road_list_old[0];
			console.log('check1 remove road');	
			$.each(tempward,function(wk,wv){
				$.each(road_list_old,function(rk,rv){					 
					if (rv in roadpoly_list[wv]){
						streetGroup.removeLayer(roadpoly_list[wv][rv][0]);
					}
					else{
					}
				});	
			});
		}
		else if(road_list_old.length > road_list.length && road_list.length > 0)
		{
			$.each(road_list_old, function(k,v){
				if ($.inArray(v, road_list) == -1){
					//road
					$.each(tempward,function(wk,wv){
						if (v in roadpoly_list[wv]){
							console.log(roadpoly_list[wv][v]);
							streetGroup.removeLayer(roadpoly_list[wv][v][0]);
						}
						else{
						}
					});
					console.log('check2 remove road');	
				}
				else{
				}
			});
		}
		else
		{
			$.each(road_list, function(k,v){
				if ($.inArray(v, road_list_old) == -1){
					console.log('check3 road');
					road = v;	
					console.log(road_list,road);
					console.log(roadpoly_list);
					$.each(tempward, function(wk,wv){
						if(wv == add_ward){
							if($.inArray(add_ward, completed_check) == -1){
								console.log("completed_check = "+completed_check);
								console.log('add_ward = '+add_ward);
								$.each(roadpoly_list[wv], function(rk, rv){
									console.log("initialremove");							   
									streetGroup.removeLayer(rv[0]);
								});
								completed_check.push(add_ward);
							}
						}
						console.log(wv, v);
						if(v in roadpoly_list[wv]){
							console.log("inside");
							console.log(roadpoly_list[wv][v]);
							console.log(wv, v);
							var polygon = roadpoly_list[wv][v][0].addTo(streetGroup);
							//polygon.setStyle({color: '#b5afab',weight:5});		
						}
						else{
							//console.log(roadpoly_list[wv][v][0]);
						}
					});
				}
				else{
				}
			});
			
		}
		road_list_old=road_list;
		   streetGroup.bringToFront();
		$("#Usage1").trigger("change");
		/*if($("#Usage1").val().length != 0){
			$("#Usage1").trigger("change");
		}*/
		/*if($("#Construction").val().length != 0){
			$("#Construction").trigger("change");
		}
		if($("#Area_Violation").val().length != 0){
			$("#Area_Violation").trigger("change");
		}*/
	});
	
	
	function getViolationmap(){
		//alert('hi');
		document.getElementById("pagi").style.display = "none";
		// document.getElementById("pagi").style.visibility = "none";
	//	$("#pagi").hide();
		buildingGroup.clearLayers();
		violationGroup.clearLayers();
		serviceGroup.clearLayers();
	

	 certificateGroup.clearLayers();
	  taxdetailGroup.clearLayers();
	  
	$("#myTable").empty();
	//$("#myTable1").empty();
	$("#emptydata").empty();
	$("#pagi").empty();
	$("#pagiservice").empty();
	
	
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	var services = $("#services").val();
	
	jQuery.ajax({
				type: 'POST',
				url: 'getviolationmap.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name+"&services="+services,
				dataType: 'html',
				success: function(data){				  
			//alert(data);
				jQuery('#showdatarecord').html(data);	
				jQuery('#serbtn').hide();
					jQuery('#serbtnservice').show();
						jQuery('#myInput').hide(); 
				
				}
				});//ajax close
}

	
</script>
<script>	

 
     
		var wardwkt = new Wkt.Wkt();
	

            <?php


$sql  = mysqli_query($connection,"select latlong from cityboundary");	
while($row=mysqli_fetch_array($sql)){
		$d1=rtrim($row['latlong'],",");
	$wardwkt ='POLYGON(('.$d1.'))';
?>
wardwkt.read("<?php echo $wardwkt;?>");		
		
		var  ward = wardwkt.toObject();				
	    var polygon = ward.addTo(citynameGroup);
	
	    
		polygon.setStyle({color: 'red',fillOpacity: 0.007});
   
		
        <?php }?>
		
		 
		var streetwkt = new Wkt.Wkt();	    
		//For Street			
					<?php
					$sql2  = mysqli_query($connection,"select * from cityroad");	
					while($row=mysqli_fetch_array($sql2)){
					$d2=rtrim($row['latlong'],",");
					$streetwkt ='linestring(('.$d2.'))';
							
						
					?>
					
					streetwkt.read("<?php echo $streetwkt;?>");		
					//wkt.read("polyline ((80 20,90 10,60 10))");
					//wkt.read("polyline ((80 20,90 10,60 10)), polyline ((30 20,90 10,85 90))");
					var  street = streetwkt.toObject();				
					var polygon = street.addTo(cityroadGroup);
					polygon.setStyle({color: '#b5afab',weight:3});
				//	street.addTo(cityroadGroup).bindPopup("");
					<?php }  ?>
					
					
					var cityward = new Wkt.Wkt();	    
		//For Street			
					<?php
					$sql3  = mysqli_query($connection,"select * from cityward");	
					while($row3=mysqli_fetch_array($sql3)){
					$d2=rtrim($row3['latlong'],",");
					$cityward ='POLYGON(('.$d2.'))';
							
						
					?>
					
					cityward.read("<?php echo $cityward;?>");		
					//wkt.read("polyline ((80 20,90 10,60 10))");
					//wkt.read("polyline ((80 20,90 10,60 10)), polyline ((30 20,90 10,85 90))");
					var  street = cityward.toObject();				
					var polygon = street.addTo(citywardGroup);
					polygon.setStyle({color: 'red',weight:1,fillOpacity: 0.05});
					polygon.bindTooltip("<?php echo $row3['ward'];?>", {permanent: true, direction:"center"})
					
					
					//street.addTo(citywardGroup).bindPopup("");
					<?php }  ?>
		  
		 
   
        </script>
<script>
	<?php	
	
	$borewell_list=array();
	
$sqlm = mysqli_query($connection,"select boreid,X,Y,Borewell_No,Ward_Id,serialno,Borewell_Digged_Year,Motor_HP from borewell_details");

?>

<?php
while($rowm=mysqli_fetch_assoc($sqlm)) {
array_push($borewell_list,[$rowm['Y'],$rowm['X'],$rowm['Borewell_No'],$rowm['Ward_Id'],$rowm['serialno'],$rowm['boreid'],$rowm['Borewell_Digged_Year']]);
}

?>

var borewell_list=<?php echo json_encode($borewell_list);?>;
var habIcon = L.icon({iconUrl: 'marker/water.png', iconSize: [20, 20],});
for (var i = 0; i < borewell_list.length; i++) {
	marker = new L.marker([borewell_list[i][0],borewell_list[i][1]],{icon: habIcon})
		.addTo(borewellGroup).bindPopup("<p> Borewell No. -  "+borewell_list[i][2]+"<br> Ward - "+borewell_list[i][3]+"<br> Serial No. - "+borewell_list[i][4]+"<br>Digged Year - "+borewell_list[i][6]+"</p><br><button onClick=showborwellmodel("+borewell_list[i][5]+");>Show Details</button>");
}


<?php //} ?>
</script>
<script>
<?php
//if($Usage1=="" && $Construction=="" && $Area_Violation=="" && $Street_Name==""){
	
	$citymarker=array();
	$sql = mysqli_query($connection,"select * from parkdata");
	while($row=mysqli_fetch_assoc($sql)) {	
	if($row['X']!='' && $row['Y']!='')
												{
	array_push($citymarker, [$row['Y'],$row['X'],$row['ward']]);
	} }
	?>	
	var citymarker=<?php echo json_encode($citymarker);?>;	
	var Icon = L.icon({iconUrl: 'marker/default.png', iconSize: [20, 20],});
		
	for (var i = 0; i < citymarker.length; i++) {	
			
	var circle = L.circle([citymarker[i][0], citymarker[i][1]], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.2,
     weight: 0.2,
    radius: 0
}).addTo(citymarkerGroup);
	marker = new L.marker([citymarker[i][0],citymarker[i][1]],{icon: Icon})
	.addTo(citymarkerGroup).bindPopup("<p>PARK <br> Ward -  "+citymarker[i][2]+"</p>");
	
	}
	<?php //}  ?>
</script>
<script>
function searchdatabuilding() {
	$("#myTable").empty();
	//$("#myTable1").empty();
			
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	//var pageno = $("#pageno").val();
	jQuery.ajax({
				type: 'POST',
				url: 'searchdatagetbuildingtable.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name,
				dataType: 'html',
				success: function(data){	
					//alert(data);	
				Deldata(data);
				jQuery('#myInput').show();  
				jQuery('#serbtn').hide(); }
				});//ajax close
}

function searchdataservice() {
	$("#myTable").empty();	
	$("#pagi").empty();
			
	var ward =$("#ward").val();
	var Usage1 = $("#Usage1").val();
	var PID = $("#PID").val();
	var Construction = $("#Construction").val();
	var Area_Violation = $("#Area_Violation").val();
	var Street_Name = $("#Street_Name").val();
	var Utility_Name = $("#Utility_Name").val();
	var services = $("#services").val();
	
	
	jQuery.ajax({
				type: 'POST',
				url: 'searchservicetablelimitation.php',
				data: "ward="+ward+"&Usage1="+Usage1+"&PID="+PID+"&Construction="+Construction+"&Area_Violation="+Area_Violation+"&Street_Name="+Street_Name+"&Utility_Name="+Utility_Name+"&services="+services,			
				dataType: 'html',
				success: function(data){	
					
			jQuery('#showdatarecord').html(data);
			jQuery('#myInput').show();  
				jQuery('#serbtnservice').hide();
				}
				});//ajax close

}

function searchrecorrd() {
	
var value = jQuery('#myInput').val().toLowerCase();
	//alert(value);
	
	 jQuery("#myTable tr").filter(function() {
      jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
    });

}

$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
</body>
</html>