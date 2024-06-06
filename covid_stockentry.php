<?php
include("adminsession.php");
//echo $usertype;die;
$pagename = "covid_stockentry.php";
$module = "Add Stock Entry Details";
$submodule = "Add Stock Entry Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "covidstockentry";
$tblpkey = "stockid";
$imgpath = "uploaded/document/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'stockid' ] ) )
	$keyvalue = $_GET[ 'stockid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
		
	if ( isset( $_POST[ 'submit' ] ) ) {
$districtid =  $_POST['districtid'];
$ngoid =  $_POST['ngoid'];
$ulbid =  $_POST['ulbid'];			
$entrydate=$_POST['entrydate'];
$noofmasks=$_POST['noofmasks'];
$noofglove=$_POST['noofglove'];
$noofppe=$_POST['noofppe'];
$nooffaceshield=$_POST['nooffaceshield'];
$sanitizer=$_POST['sanitizer'];
$handwash=$_POST['handwash'];
$disinfectants_quantity=$_POST['disinfectants_quantity'];



	if ( $keyvalue == 0 ) {
	mysqli_query($connection,"insert into covidstockentry set districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',entrydate='$entrydate',noofmasks='$noofmasks',noofglove='$noofglove',noofppe='$noofppe',nooffaceshield='$nooffaceshield',sanitizer='$sanitizer',
handwash='$handwash',disinfectants_quantity='$disinfectants_quantity',createdate='$curredate',userid='$loginid'");
	$keyvalue = mysqli_insert_id($connection);	
				$action=1;
	}
	else
	{
		
		
		mysqli_query($connection,"update covidstockentry set districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',entrydate='$entrydate',noofmasks='$noofmasks',noofglove='$noofglove',noofppe='$noofppe',nooffaceshield='$nooffaceshield',sanitizer='$sanitizer',
handwash='$handwash',disinfectants_quantity='$disinfectants_quantity',createdate='$curredate',userid='$loginid' where stockid = '$keyvalue'");

					$action=2;

	}
			echo "<script>location='$pagename?action=$action'</script>";
}

if (isset($_GET[$tblpkey])){
//$btn_name = "Update";
$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
$districtid =  $rowedit['districtid'];
$ngoid =  $rowedit['ngoid'];
$ulbid =  $rowedit['ulbid'];			
$entrydate=$rowedit['entrydate'];
$noofmasks=$rowedit['noofmasks'];
$noofglove=$rowedit['noofglove'];
$noofppe=$rowedit['noofppe'];
$nooffaceshield=$rowedit['nooffaceshield'];
$sanitizer=$rowedit['sanitizer'];
$handwash=$rowedit['handwash'];
$disinfectants_quantity=$rowedit['disinfectants_quantity'];
} else {
$districtid = '';
$ngoid = '';
$ulbid = '';		
$entrydate='';
$noofmasks='';
$noofglove='';
$noofppe='';
$nooffaceshield='';
$sanitizer='';
$handwash='';
$disinfectants_quantity='';
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
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

	<?php include("inc/header.php");?>

	<div class="wrapper">
      <?php if($action==1){?> <div class="col-md-12"><h1><span style="color:#F00;">Record Inserted Successfully</span></h1></div>  <?php } ?>
		<form  method="post" action="" enctype="multipart/form-data"><div><input type="hidden" name="org.apache.struts.taglib.html.TOKEN" value="23dbbcf7349cfcf95cbba4067c3c7704"></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
           <h4 class="card-title">Covid Stock Entry</h4>
          <a href="covidstock_list.php" class="btn btn-info" style="float:right;">Show List</a>
					
		</div>
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
                <tr>
						<th style="width: 20%;">District Name</th>
						
                       <td>
						<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">
                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
							 <select required name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>
                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");
							while($data=mysqli_fetch_array($dist)){
							
								?>
							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>
						<?php } ?>
                     </select>
                         <script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>
							
							<?php }?>
                       
						</td>
						</td>
							<th style="width: 20%;">ULB Name </th>
						<td style="width: 25%;">
                        	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						 <select required name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>
                        <?php $dist=mysqli_query($connection,"select * from ulb_master $condata order by ulbname asc");
							while($data=mysqli_fetch_array($dist)){?>
							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
						<?php } ?>
                     </select>
                       <script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>
							
							<?php }?>
                            
                        
						
						<div id="nor">
						
							</div>
						</td>
						
						
					</tr>
                    <tr>
                    <th style="width: 20%;">Shelter Name</th>
					   	
						<td style="width: 25%;">
                        	<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">
                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">
                        
                        <?php } else { ?>
							
						        <select name="ngoid" id="ngoid"  class="form-control" onChange="getdetails(this.value);">
                       <option value="">-Select Shelter Name-</option>
                                            <?php 
											$sql1 = "select distinct ngoname,ngoid from m_ngo $condata order by ngoname asc";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
													
											?>
                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>
                                            <?php
												}
												
												?>
                                      </select>  
                                         <script>document.getElementById('ngoid').value='<?php echo $ngoid; ?>'; </script>
							
							<?php }?>
                            
                
                        
                     </td>
                	<th>Entry Date  </th>
						<td> 
                        <input type="date" name="entrydate" value="<?php echo $entrydate;?>" placeholder=" Enter Medical Checkup"  id="entrydate" class="form-control required" autocomplete="off">
                      
                     </td>
					
						
					
					</tr>
                    <tr>
						
						<th style="width: 25%;">Number of Masks Available
</th>
<td style="width: 25%;"><input type="number" name="noofmasks" value="<?php echo $noofmasks;?>" placeholder=" Enter Number of Masks Available"  id="noofmasks" class="form-control required" autocomplete="off"></td>
                        	<th style="width: 25%;">Number of Glove Pairs available
</th>
						<td style="width: 25%;">
                      <input type="number" name="noofglove" value="<?php echo $noofglove;?>" id="noofglove" placeholder="Enter Number of Glove Pairs available" class="form-control" autocomplete="off">
                       </td>
					</tr>
                    
                            <tr>
						
						<th style="width: 25%;">Number of PPE Available
</th>
<td style="width: 25%;"><input type="number" name="noofppe" value="<?php echo $noofppe;?>" placeholder=" Enter Number of PPE Available"  id="noofppe" class="form-control required" autocomplete="off"></td>
                        	<th style="width: 25%;">Number of face Shield Available
</th>
						<td style="width: 25%;">
                      <input type="number" name="nooffaceshield" value="<?php echo $nooffaceshield;?>" id="nooffaceshield" placeholder="Enter Number of face Shield Available" class="form-control" autocomplete="off">
                       </td>
					</tr>
                    
                            <tr>
						
						<th style="width: 25%;">Sanitizer (In Litres)
</th>
<td style="width: 25%;"><input type="number" name="sanitizer" value="<?php echo $sanitizer;?>" placeholder=" Enter Sanitizer (In Litres)"  id="sanitizer" class="form-control required" autocomplete="off"></td>
                        	<th style="width: 25%;">Hand Wash (In Litres)
</th>
						<td style="width: 25%;">
                      <input type="number" name="handwash" value="<?php echo $handwash;?>" id="handwash" placeholder="Enter Hand Wash (In Litres)" class="form-control" autocomplete="off">
                       </td>
					</tr>
                      <tr>
						
						<th style="width: 25%;">Disinfectants Quantity
</th>
<td style="width: 25%;"><input type="number" name="disinfectants_quantity" value="<?php echo $disinfectants_quantity;?>" placeholder=" Enter Disinfectants Quantity"  id="disinfectants_quantity" class="form-control required" autocomplete="off"></td>
                        	
					</tr>
                    
                    
                    
                    
                     
						
                    
                   
					 <tr>
						<td align="center" colspan="4">
                         <input type="hidden" name="<?php echo $tblpkey; ?>" id="<?php echo $tblpkey; ?>" value="<?php echo $keyvalue; ?>">
						     <input type="submit" name="submit" value="Submit"  style="width:200px; float:none;" class="site-btn">
						</td>
					
					 </tr>

				</table>
		
		</div>
		</div>
		</div>
			</div>
			
	</form>
		
        
        
        </div>
		<!-- end container -->
	</div>



	<?php include("inc/footer.php"); ?>
<script>
	function funDel(id)
	{  //alert(id);   
		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		imgpath = '<?php echo $imgpath; ?>';
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_image_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath,
			  dataType: 'html',
			  success: function(data){
				//alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
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

function GetStatePay(data)
{
	if(data=='Others'){
			   
			   jQuery("#paystate").show();
			   }
			else
				{
					 jQuery("#paystate").hide();
				}
}

function GetShelterPay(data)
{
	if(data=='Others'){
			   
			   jQuery("#payshelter").show();
			   }
			else
				{
					 jQuery("#payshelter").hide();
				}
}
function getUpload(data,sn){
	var socialdocname = jQuery("#socialdocname"+sn).val();	
	 jQuery("#soid"+sn).val(socialdocname);
	if(data=='Yes'){
			   
			   jQuery("#imgname"+sn).show();
			    jQuery("#remark"+sn).hide();
			   }
			else
				{
					 jQuery("#remark"+sn).show();
					   jQuery("#imgname"+sn).hide();
				}
}

  </script>
</body>

</html>