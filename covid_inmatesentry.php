<?php
include("adminsession.php");
//echo $usertype;die;
$pagename = "covid_inmatesentry.php";
$module = "Add Resident Details";
$submodule = "Add Resident Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "covid_inmatesentry";
$tblpkey = "covidentid";
$imgpath = "uploaded/document/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'covidentid' ] ) )
	$keyvalue = $_GET[ 'covidentid' ];
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
$noofinmate=$_POST['noofinmate'];
$maleabove18=$_POST['maleabove18'];
$entrydate=$_POST['entrydate'];
$femaleabove18=$_POST['femaleabove18'];
$childbelow18=$_POST['childbelow18'];
$provided_vaccine=$_POST['provided_vaccine'];
$sample_taken=$_POST['sample_taken'];
$referral_status=$_POST['referral_status'];
$got_positive=$_POST['got_positive'];
$release_resident=$_POST['release_resident'];
$newadmission=$_POST['newadmission'];
$noofsympotamatic=$_POST['noofsympotamatic'];

$fromdate=$_POST['fromdate'];
$thirdgender=$_POST['thirdgender'];
			

	if ( $keyvalue == 0 ) { 


	mysqli_query($connection,"insert into covid_inmatesentry set districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',entrydate='$entrydate',fromdate='$fromdate',thirdgender='$thirdgender',noofinmate='$noofinmate',maleabove18='$maleabove18',
femaleabove18='$femaleabove18',childbelow18='$childbelow18',provided_vaccine='$provided_vaccine',sample_taken='$sample_taken',referral_status='$referral_status',got_positive='$got_positive',release_resident='$release_resident',newadmission='$newadmission',noofsympotamatic='$noofsympotamatic',createdate='$curredate',userid='$loginid'");
	$keyvalue = mysqli_insert_id($connection);	
				$action=1;
	}
	else
	{
		
		
		mysqli_query($connection,"update covid_inmatesentry set districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',entrydate='$entrydate',fromdate='$fromdate',thirdgender='$thirdgender',noofinmate='$noofinmate',maleabove18='$maleabove18',entrydate='$entrydate',noofinmate='$noofinmate',maleabove18='$maleabove18',
femaleabove18='$femaleabove18',childbelow18='$childbelow18',provided_vaccine='$provided_vaccine',sample_taken='$sample_taken',referral_status='$referral_status',got_positive='$got_positive',release_resident='$release_resident',newadmission='$newadmission',noofsympotamatic='$noofsympotamatic',createdate='$curredate',userid='$loginid' where covidentid = '$keyvalue'");

					$action=2;

	}
			echo "<script>location='$pagename?action=$action'</script>";
}

if (isset($_GET[$tblpkey])){
//$btn_name = "Update";
//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
$entrydate=$rowedit['entrydate'];
$districtid =  $rowedit['districtid'];
			$ngoid =  $rowedit['ngoid'];
			$ulbid =  $rowedit['ulbid'];
$entrydate=$rowedit['entrydate'];
$noofinmate=$rowedit['noofinmate'];
$maleabove18=$rowedit['maleabove18'];
$femaleabove18=$rowedit['femaleabove18'];
$childbelow18=$rowedit['childbelow18'];
$provided_vaccine=$rowedit['provided_vaccine'];
$sample_taken=$rowedit['sample_taken'];
$referral_status=$rowedit['referral_status'];
$got_positive=$rowedit['got_positive'];
$release_resident=$rowedit['release_resident'];
$newadmission=$rowedit['newadmission'];
$noofsympotamatic=$rowedit['noofsympotamatic'];
$todate=$rowedit['todate'];
$fromdate=$rowedit['fromdate'];
$thirdgender=$rowedit['thirdgender'];

} else {
$entrydate='';
$entrydate='';

$maleabove18='';
$femaleabove18='';
$childbelow18='';
$provided_vaccine='';
$sample_taken='';
$referral_status='';
$got_positive='';
$release_resident='';
$newadmission='';
$noofsympotamatic='';
$todate='';
$fromdate='';
$thirdgender='';
$totnew = $cmn->getvalfield($connection,"covid_inmatesentry","sum(newadmission)","ngoid=$ngoid");
$totrelease = $cmn->getvalfield($connection,"covid_inmatesentry","sum(release_resident)","ngoid=$ngoid");
$noofinmate=$totrelease-$totnew;

 $lastid = $cmn->getvalfield($connection,"covid_inmatesentry","max(covidentid)","ngoid=$ngoid");
$lastupdated = $cmn->getvalfield($connection,"covid_inmatesentry","entrydate","covidentid=$lastid");

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
           <h4 class="card-title">Covid Resident Entry</h4>
          <a href="covidinmate_list.php" class="btn btn-info" style="float:right;">Show List</a>
					
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
                     	<th style="width: 25%;">Referral Status
</th>
<td style="width: 25%;"><input type="text" name="referral_status" value="<?php echo $referral_status;?>" placeholder=" Referral Status"  id="referral_status" class="form-control required" autocomplete="off"></td>
</tr>
 <tr>
                	<th>From Date  </th>
						<td> 
                     <span style="color:#F00;"><strong>Last Updated Date : <?php echo dateformatindia($lastupdated);?></strong></span><br>
                        <input type="date" name="fromdate" value="<?php echo $fromdate;?>" placeholder=" From Date"  id="fromdate" class="form-control required" autocomplete="off">
                      
                     </td>
						<th>Entry Date  </th>
						<td> 
                        <input type="date" name="entrydate" value="<?php echo $curredate;?>" placeholder="Entry Date"  id="entrydate" class="form-control required" autocomplete="off" readonly>
                      
                     </td>
						
					
					</tr>
                     <tr>
						
						<th style="width: 25%;">Release 
</th>
<td style="width: 25%;"><input type="number" name="release_resident" value="<?php echo $release_resident;?>" placeholder="Release"  id="release_resident" class="form-control required" autocomplete="off"></td>
                        	<th style="width: 25%;">New Admission
</th>
						<td style="width: 25%;">
                      <input type="number" name="newadmission" value="<?php echo $newadmission;?>" id="newadmission" placeholder="Enter New Admission" class="form-control" autocomplete="off">
                       </td>
					</tr>
                    
                    <tr>
						
						<th style="width: 25%;">Total Number of Residents Present in shelter
</th>
<td style="width: 25%;"><input type="text" name="noofinmate" value="<?php echo $noofinmate;?>" placeholder=" Total Number of Inmates Present in shelter"  id="medical_checkup" class="form-control required" autocomplete="off" readonly></td>
                        	<th style="width: 25%;">Male above 18 years (Count)
</th>
						<td style="width: 25%;">
                      <input type="number" name="maleabove18" value="<?php echo $maleabove18;?>" id="maleabove18" placeholder="Male above 18 years" class="form-control" autocomplete="off">
                       </td>
					</tr>
                    
                            <tr>
						
						<th style="width: 25%;">Female Above 18 Years (Count)
</th>
<td style="width: 25%;"><input type="number" name="femaleabove18" value="<?php echo $femaleabove18;?>" placeholder="Female above 18 years"  id="femaleabove18" class="form-control required" autocomplete="off"></td>
                        	<th style="width: 25%;">Children below 18 years (Count)
</th>
						<td style="width: 25%;">
                      <input type="number" name="childbelow18" value="<?php echo $childbelow18;?>" id="childbelow18" placeholder="Children Below 18 years" class="form-control" autocomplete="off">
                       </td>
					</tr>
                    
                            <tr>
                            
						<th style="width: 25%;">Third Gender (Count)
</th>
						<td style="width: 25%;">
                      <input type="number" name="thirdgender" value="<?php echo $thirdgender;?>" id="thirdgender" placeholder="Third Gender" class="form-control" autocomplete="off">
                       </td>
						<th style="width: 25%;">Number of Residents Provided COVID-19 Vaccine 
</th>
<td style="width: 25%;"><input type="number" name="provided_vaccine" value="<?php echo $provided_vaccine;?>" placeholder="Number of Residents Provided COVID-19 Vaccine"  id="provided_vaccine" class="form-control required" autocomplete="off"></td>

	
                        
					</tr>
                    
                      <tr>
                      <th style="width: 25%;">No of Sympotamatic 
</th>
<td style="width: 25%;"><input type="number" name="noofsympotamatic" value="<?php echo $noofsympotamatic;?>" placeholder="No of Sympotamatic"  id="noofsympotamatic" class="form-control required" autocomplete="off"></td>

                      
							<th style="width: 25%;">Number of Covid-19 Samples Taken 
</th>
						<td style="width: 25%;">
                      <input type="number" name="sample_taken" value="<?php echo $sample_taken;?>" id="sample_taken" placeholder="Number of Covid-19 Samples taken" class="form-control" autocomplete="off">
                       </td>
                       
					
                        	
					</tr>
                    
                     <tr>
						
					 <tr>
                     <th style="width: 25%;">Number of Covid-19 Cases got Possitive 
</th>
						<td style="width: 25%;">
                      <input type="number" name="got_positive" value="<?php echo $got_positive;?>" id="got_positive" placeholder="Number of Covid-19 Cases got Possitive" class="form-control" autocomplete="off">
                       </td>
                      
						
                       </tr>
                    
                    
                     <tr>
                        	
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