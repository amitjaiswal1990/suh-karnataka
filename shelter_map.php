<?php
include("adminsession.php");
$pagename = "shelter_master.php";
$module = "Add Shelter Location";
$submodule = "Shelter Location";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "m_shelter";
$tblpkey = "shelter_id";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
	
	
if ( isset( $_GET[ 'shelter_id' ] ) )
	$keyvalue = $_GET[ 'shelter_id' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim($_GET['action']) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	
	//$stateid= $_POST['stateid'];
	
			$s_type= $_POST['s_type'];	
			$districtid =  $_POST['districtid'];	
			$design_capacity =  $_POST['design_capacity'];
			$ngoid =  $_POST['ngoid'];
			$ulbid =  $_POST['ulbid'];
			$smaname =  $_POST['smaname'];
			$contatct_person =  $_POST['contatct_person'];
			$men =  $_POST['men'];
			$women =  $_POST['women'];
			$children =  $_POST['children'];
			$total =  $_POST['total'];			
			$register_type =  $_POST['register_type'];
			$ameniti_no =  $_POST['ameniti_no'];			
			$ameniti_type =  $_POST['ameniti_type'];
			$amenitiename =  $_POST['amenitiename'];
			$itemname =  $_POST['itemname'];
			$available =  $_POST['available'];
			$amenitieid =  $_POST['amenitieid'];			
			$male_aged_people_no =  $_POST['male_aged_people_no'];
			$male_children_no =  $_POST['male_children_no'];
			$male_others_no =  $_POST['male_others_no'];
			$male_differently_abled =  $_POST['male_differently_abled'];
			$female_aged_people_no =  $_POST['female_aged_people_no'];
			$female_children_no =  $_POST['female_children_no'];
			$female_others_no =  $_POST['female_others_no'];
			$female_differently_abled =  $_POST['female_differently_abled'];
			$registername =  $_POST['registername'];
			$date_of_formation_ec =  $_POST['date_of_formation_ec'];
			$corporate_bank_account =  $_POST['corporate_bank_account'];			
			$third_aged_people_no =  $_POST['third_aged_people_no'];
			$third_children_no =  $_POST['third_children_no'];
			$third_others_no =  $_POST['third_others_no'];
			$third_differently_abled =  $_POST['third_differently_abled'];
		
	mysqli_query($connection,"insert into m_shelter set stateid='$stateid',design_capacity='$design_capacity',s_type='$s_type',ngoid='$ngoid',ulbid='$ulbid',smaname='$smaname',contatct_person='$contatct_person',men='$men',women='$women',children='$children',districtid='$districtid',total='$total',male_aged_people_no='$male_aged_people_no',male_children_no='$male_children_no',male_others_no='$male_others_no',male_differently_abled='$male_differently_abled',female_aged_people_no='$female_aged_people_no',female_children_no='$female_children_no',female_others_no='$female_others_no',female_differently_abled='$female_differently_abled',date_of_formation_ec='$date_of_formation_ec',corporate_bank_account='$corporate_bank_account',third_aged_people_no='$third_aged_people_no',third_children_no='$third_children_no',third_others_no='$third_others_no',third_differently_abled='$third_differently_abled'");
	
	$lastid = mysqli_insert_id($connection);
	
	 $totreg = count($registername);	
	for ($x = 0; $x < $totreg; $x++) {	
	
	mysqli_query($connection,"insert into save_register_type set shelter_id='$lastid',registername='$registername[$x]',register_type='$register_type[$x]'");
	}
	
$totam = count($amenitiename);	
	for ($i = 0; $i < $totam; $i++) {	
	mysqli_query($connection,"insert into save_amenities set shelter_id='$lastid',amenitiename='$amenitiename[$i]',ameniti_type='$ameniti_type[$i]',ameniti_no='$ameniti_no[$i]'");
	}
	
	$totki = count($itemname);	
	for ($k = 0; $k < $totki; $k++) {	
	
	mysqli_query($connection,"insert into  save_kichen set shelter_id='$lastid',kitemname='$itemname[$k]',available='$available[$k]',amenitieid='$amenitieid[$k]'");
	} 
	
		echo "<script>location='$pagename?action=1'</script>";

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="assets/js/leafletjs/leaflet.css" />
 <script src="assets/js/leafletjs/leaflet.js" ></script>
 <script type="text/javascript" src="assets/js/jquery.min.js"></script>
 
	<title>SAVIOUR</title>
	<meta content="Admin Dashboard" name="description">
	<meta content="Themesbrand" name="author">
	<link rel="shortcut icon" href="image/suhlogo.png">
	<link rel="stylesheet" href="../plugins/morris/morris.css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

	<?php  include("inc/header.php");?>

	<div class="wrapper">
      <?php if($action==1){?> <div class="col-md-12"><h1><span style="color:#F00;">Record Inserted Successfully</span></h1></div>  <?php } ?>
		<form name="addServiceForm" method="post" action="">
		
		<div class="container-fluid">
		<div class="text-center"></div>
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">Shelter Locations</h4>
		</div>
		<div class="table-responsive">
			
			
			
				<!--<table class="table table-bordered table-striped">
                <tr>
                <td>District Name</td>
                <td >ULB Name </td>
                	<td>Shelter Name</td>
                </tr>
					<tr>
						
						
						<td  style="width: 25%;">
                        <select required name="districtid" id="districtid" onChange="getulb();getSearch();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
						</td>
						
					
						
						<td style="width: 25%;">
						 <select required name="ulbid" id="ulbid" onChange="getshelter();getSearch();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
						
						</td>
						
					
                        <td style="width: 25%;">
                        <select name="ngoid" id="ngoid"  class="form-control" onChange="getSearch();">
                       <option value="">-Select Shelter Name-</option>
                                            <?php 
											$sql1 = "select distinct ngoname,ngoid from m_ngo order by ngoname asc";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                        
                     </td>
				
							
						</tr>

				</table>-->
				
			
		<div id="mapid" style="height: 450px; width: 100%;"></div>
        
           <div class="widgetcontent bordered" id="showdatarecord">
    </div> 
		</div>
		</div>
		</div>
		</div>
		</div>
	</form>
		
		<!-- end container -->
	</div>



	<?php include("inc/footer.php"); ?>
      
        
<script>
 var mymap = L.map('mapid').setView([15.350, 76.923703],6);
		var shelterGroup = L.layerGroup().addTo(mymap);
		var imageGroup = L.layerGroup().addTo(mymap);
		var marker;
		L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			subdomains: ['a','b','c'],
			maxNativeZoom:25,
			
        
        }).addTo(mymap);
		var imageUrl = 'images/jammu.jpg',
imageBounds = [[37.578213, 70.788506], [32.21133, 81.935685]];
L.imageOverlay(imageUrl, imageBounds).addTo(imageGroup);	
		
mymap.zoomControl.setPosition('topright');
		/* var loadingControl = L.Control.loading({
                    separate: true
                });
                mymap.addControl(loadingControl);*/
</script>

<?php
		  $shelter_list=array();
		  $sql = mysqli_query($connection,"select * from  m_ngo ");
				while($row=mysqli_fetch_assoc($sql)) {
				$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$row[districtid]'");
				$districtname = ucfirst(strtolower($districtname));
				$ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row[ulbid]'");
					$ulbname = ucfirst(strtolower($ulbname));
		  
        array_push($shelter_list,[$row['Y'],$row['X'],$districtname,$ulbname,$row['ngoname']]);

				}
			
 //echo $num_rows;
 ?>
 <script>
 
var shelter_list=<?php echo json_encode($shelter_list);?>;
var habIcon = L.icon({iconUrl: 'icon/red.png', iconSize: [30, 30],});
 for (var i = 0; i < shelter_list.length; i++) {
			            marker = new L.marker([shelter_list[i][0],shelter_list[i][1]],{icon: habIcon})
				            .bindPopup(shelter_list[i][2])
				            .addTo(shelterGroup).bindPopup("<p> District - "+shelter_list[i][2]+"<br> ULB - "+shelter_list[i][3]+"<br>Shelter Name and Address - "+shelter_list[i][4]+"</p>");
	 
 }
	
var group = new L.featureGroup([marker]);
//mymap.fitBounds(group.getBounds());
</script>
    <script>
	

	
	function getdistrict(){      
//alert('hello');
 var stateid = jQuery("#stateid").val();
//alert(stateid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getdistrict.php',
		  data: "stateid="+stateid,
		  dataType: 'html',
		  success: function(data){				  
		//alert(data);
		
		jQuery('#districtid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

	function getshelter(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
  var ulbid = jQuery("#ulbid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getngo.php',
		  data: "districtid="+districtid+'&ulbid='+ulbid,
		  dataType: 'html',
		  success: function(data){				  
	//	alert(data);
					
				
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
	
	function getulb(){      
//alert('hello');
 var districtid = jQuery("#districtid").val();
//alert(districtid);   
		  jQuery.ajax({
		  type: 'POST',
		  url: 'getulb.php',
		  data: "districtid="+districtid,
		  dataType: 'html',
		  success: function(data){	
		  jQuery('#ulbid').html(data);
		
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

function getSearch(){     
//alert('hi');
shelterGroup.clearLayers();

 var districtid = jQuery("#districtid").val(); 
 var ulbid = jQuery("#ulbid").val();
 var ngoid = jQuery("#ngoid").val();
	
		  jQuery.ajax({
		  type: 'POST',
		  url: 'show_sheltermap.php',
		  data: 'districtid='+districtid+'&ulbid='+ulbid+'&ngoid='+ngoid,
		  dataType: 'html',
		  success: function(data){	
		//  alert(data);
				jQuery('#showdatarecord').html(data);	
				//	getStreet();
			
			}
		  });//ajax close
}

		
	</script>
	
	

</body>

</html>