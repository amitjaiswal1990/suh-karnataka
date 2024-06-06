<?php
include("adminsession.php");
//error_reporting(0);
$pagename = "thirdpartysurvey.php";
$module = "Thirdparty Survey Details";
$submodule = "Shelter Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "m_shelter";
$tblpkey = "shelter_id";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
$createdate = date('Y-m-d');	
	
if ( isset( $_GET[ 'shelter_id' ] ) )
	$keyvalue = $_GET[ 'shelter_id' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim($_GET['action']) );
else
	$action = "";
	
// 	//echo $ngoid;
// 	if($usertype=='SHELTER')
// 		{
// 	 $countthirdgno=$cmn->getvalfield($connection,"thirdpartysurey","count(ngoid)","ngoid='$ngoid'");
// 		}
// 		else{
// 			$countthirdgno=0;
// 			$ngoid=0;
// 		}
	
if ( isset( $_POST[ 'submit' ] ) ) {
	
// 	if($countthirdgno==0){
	mysqli_query($connection,"insert into thirdpartysurey set districtid='$_POST[districtid]', ulbid='$_POST[ulbid]', ngoid='$_POST[ngoid]', conductdate='$_POST[conductdate]', thirdparty_ngo='$_POST[thirdparty_ngo]', thirdparty_amount='$_POST[thirdparty_amount]', men='$_POST[men]', women='$_POST[women]', children='$_POST[children]', PWP='$_POST[PWP]', total='$_POST[total]', ecformationdate='$_POST[ecformationdate]', ecmeetingconduct='$_POST[ecmeetingconduct]', smformationdate='$_POST[smformationdate]', smmeetingconduct='$_POST[smmeetingconduct]',s_type='$_POST[s_type]', nohsc='$_POST[nohsc]', userid='$loginid', entry_type='$entry_type'");
	$action=1;
// 	}
// 	else{		
		
// 		mysqli_query($connection,"update thirdpartysurey set districtid='$_POST[districtid]', ulbid='$_POST[ulbid]', ngoid='$_POST[ngoid]', conductdate='$_POST[conductdate]', thirdparty_ngo='$_POST[thirdparty_ngo]', thirdparty_amount='$_POST[thirdparty_amount]', men='$_POST[men]', women='$_POST[women]', children='$_POST[children]', PWP='$_POST[PWP]', total='$_POST[total]', ecformationdate='$_POST[ecformationdate]', ecmeetingconduct='$_POST[ecmeetingconduct]', smformationdate='$_POST[smformationdate]', smmeetingconduct='$_POST[smmeetingconduct]',s_type='$_POST[s_type]', nohsc='$_POST[nohsc]', userid='$loginid', entry_type='$entry_type' where ngoid='$ngoid'");
// 		$action=2;
// 	}
	 echo "<script>location='thirdpartysurvey.php?action=$action'</script>";
}

else{
$sqledit = "SELECT * from thirdpartysurey where ngoid = $ngoid";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
 $conductdate=$rowedit['conductdate'];
$thirdparty_ngo=$rowedit['thirdparty_ngo'];
$thirdparty_amount=$rowedit['thirdparty_amount'];
$men=0; 
$women=0;
$children=0;
$PWP=0; 
$total=0; 
$men1=0;
$women1=0;
$children1=0;
$PWP1=0;
$total1=0;
$ecformationdate=$rowedit['ecformationdate'];
$ecmeetingconduct=$rowedit['ecmeetingconduct'];
$smformationdate=$rowedit['smformationdate'];
$smmeetingconduct=$rowedit['smmeetingconduct'];
$nohsc=$rowedit['nohsc'];
$s_type=$rowedit['s_type'];
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
    	<?php  include("inc/alerts.php");?>
        
         <?php if($dup!=""){?> <div class="col-md-12"><h1><span style="color:#F00;"><?php echo $dup;?></span></h1></div>  <?php } ?>
    
		<form name="addServiceForm" method="post" action="">
		
		<div class="container-fluid">
		<div class="text-center"></div>
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">3rd Party Survey Entry</h4>
                        <a href="thirdpartya_list.php" class="btn btn-info" style="float:right;">Show List</a>
		</div>
		<div class="table-responsive">
			
			
			
				<table class="table table-bordered table-striped">
					<tr>
						<th><label>State Name<label></th>
						<td>
                        <label for="example-text-input" class="col-sm-6 col-form-label"><?php echo ucfirst(strtolower($statename));?></label>
                       
                       
                     </select>
						</td>
						<th>District Name</th>
						<td>
						<?php if($usertype=='SHELTER')
                        { ?>
                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="contatct_person" class="form-control" autocomplete="off">
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
						
						
					</tr>
					

					<tr>
						<th style="width: 25%;">ULB Name </th>
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
						
						<th>Shelter Name</th>
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
                     
					</tr>
                    
                    <tr>
						<th style="width: 25%;">Third party survey conducted date </th>
						<td style="width: 25%;">
						<input  type="date" name="conductdate"   id="conductdate" value="<?php echo $conductdate;?>" class="form-control" autocomplete="off">
						
						</td>
						  <th>NGO Name</th>
                        <td style="width: 25%;">
                        	
                           <input  type="text"  name="thirdparty_ngo"  id="thirdparty_ngo" value="<?php echo $thirdparty_ngo;?>"   required class="form-control" autocomplete="off">
                        
                
                        
                     </td>
					
					</tr>
					
					 <tr>
                    <th>Amount</th>
                        <td style="width: 25%;">
                        	
                           <input  type="number"  name="thirdparty_amount"  id="thirdparty_amount" value="<?php echo $thirdparty_amount;?>"  required class="form-control" autocomplete="off">
                        
                
                        
                     </td>
                     <th style="width: 25%;">Shelter Type </th>
						<td style="width: 25%;">
						<select  id="s_type" name="s_type" onChange="getstype(this.value);" value="<?php echo $s_type; ?>" <?php if($keyvalue!=0){ ?> disabled <?php } ?> class="form-control" ><option value="">-- Select --</option>
							
								<option value="Men">Men shelters </option>
								<option value="Women">Women shelters: For the needs of women and their dependent children. </option>
                                <option value="Men and Women">Family Shelters: For families living on the streets </option>
                                <option value="Special Shelters">Special Shelters: old persons without care, mentally ill, recovering patients and their families</option>
                                <option value="Third Gender">Transgender Shelter</option>
							</select>
                              <script>document.getElementById('s_type').value='<?php echo $s_type; ?>'; </script> 
                    </tr>
                    
                   
                      <tr><th colspan="4">Urban Homeless identified through third party survey</th></tr>
					<tr>	
						<td colspan="4">
						   <table style="width: 100%">
						     <tr>
						        <th>Male</th>
						        <th>Female</th>
                                <th>Children</th>
						        <th>PWP</th>
						        <th>Total</th>
						     </tr>
						     
						     
							      <tr>
							      <td><input  type="number" name="men" id="men"  onChange="gettotal();" value="<?php echo $men;?>"  class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="women" id="women"   onChange="gettotal();" value="<?php echo $women;?>" class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="children" id="children"   onChange="gettotal();" value="<?php echo $children;?>" class="form-control" autocomplete="off"></td>
                                    <td><input  type="number" name="PWP" id="PWP"   onChange="gettotal();" value="<?php echo $PWP;?>" class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="total" id="total" readonly value="<?php echo $total;?>" class="form-control" autocomplete="off"></td>
							     </tr>
						     
						     
							     
						     
						   </table>
						</td>
					</tr>
					    
						  <tr style="display:none"><th colspan="4">Urban Homeless identified through rapid survey</th></tr>
					<tr style="display:none">	
						<td colspan="4">
						   <table style="width: 100%" style="display:none">
						     <tr>
						        <th>Male</th>
						        <th>Female</th>
                                <th>Children</th>
						        <th>PWP</th>
						        <th>Total</th>
						     </tr>
						     
						     
							      <tr style="display:none">
							      <td><input  type="number" name="men1" id="men1"  onChange="gettotal1();" value="<?php echo $men1;?>"   class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="women1" id="women1"   onChange="gettotal1();" value="<?php echo $women1;?>"  class="form-control" autocomplete="off"></td>
							        <td><input  type="number" name="children1" id="children1"   onChange="gettotal1();" value="<?php echo $children1;?>" class="form-control" autocomplete="off"></td>
                                    <td><input  type="number" name="PWP1" id="PWP1"   onChange="gettotal1();" class="form-control" value="<?php echo $PWP1;?>" autocomplete="off"></td>
							        <td><input  type="number" name="total1" id="total1" readonly class="form-control" value="<?php echo $total1;?>" autocomplete="off"></td>
							     </tr>
						     
						     
							     
						     
						   </table>
						</td>
					</tr>
					    	
					<tr style="display:none">
						<th style="width: 25%;">Date of formation of Executive Committee </th>
						<td style="width: 25%;">
                        
                           <input  type="date"  name="ecformationdate"   id="ecformationdate" value="<?php echo $ecformationdate;?>"   class="form-control" autocomplete="off">
						</td>
						
						<th>No of Executive Committee meetings conducted</th>
                        <td style="width: 25%;">
                        	
                           <input  type="number"  name="ecmeetingconduct"  id="ecmeetingconduct" value="<?php echo $ecmeetingconduct;?>"   class="form-control" autocomplete="off">
                        
                
                        
                     </td>
					</tr>
                    
					<tr style="display:none">
						<th style="width: 25%;">Date of Formation of Shelter Management committee</th>
						<td style="width: 25%;">
                        
                           <input  type="date"  name="smformationdate"   id="smformationdate" value="<?php echo $smformationdate;?>"   class="form-control" autocomplete="off">
						</td>
						
						<th>No of Shelter Management committee meetings conducted</th>
                        <td style="width: 25%;">
                        	
                           <input  type="number"  name="smmeetingconduct"  id="smmeetingconduct" value="<?php echo $smmeetingconduct;?>"   class="form-control" autocomplete="off">
                        
                
                        
                     </td>
					</tr>
                    <tr style="display:none">
                    <th>No of Urban Homeless rescued and accommadate in the shelter (Jan to Nov 2020)</th>
                        <td style="width: 25%;">
                        	
                           <input  type="number"  name="nohsc"  id="nohsc" value="<?php echo $nohsc;?>"    class="form-control" autocomplete="off">
                        
                
                        
                     </td>
                    
                    </tr>	     
						     
					   <tr>
							<td align="center" colspan="4">
								<input type="submit" name="submit" value="Submit" style="width:200px; float:none;" class="site-btn">
							</td>
					
						</tr>

				</table>
				
			
		
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
	
	function gettotal()
	{
		var men= parseFloat(jQuery('#men').val());  
		var women= parseFloat(jQuery('#women').val());  
		var children= parseFloat(jQuery('#children').val());  
		var PWP= parseFloat(jQuery('#PWP').val());  
		
		   var tot=men+women+children+PWP;
		 jQuery('#total').val(tot);//  alert(tot);
		   
	}
	function gettotal1()
	{
		var men= parseFloat(jQuery('#men1').val());  
		var women= parseFloat(jQuery('#women1').val());  
		var children= parseFloat(jQuery('#children1').val());  
		var PWP= parseFloat(jQuery('#PWP1').val());  
		
		   var tot=men+women+children+PWP;
		 jQuery('#total1').val(tot); // alert(tot);
		   
	}
function getKichan(avail,amenitiename)
{

			if(amenitiename=='KITCHEN' && avail=='Yes'){
			   
			   jQuery("#kichendata").show();
			   }
			    else
			   {
				    jQuery("#kichendata").hide();
			   }
			
}
	
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
		//alert(data);
		jQuery('#s_type').val('');	
				jQuery('#design_capacity').val('');			
				jQuery('#men').val('');
				jQuery('#women').val('');
				jQuery('#children').val('');
				jQuery('#total').val('');				
				jQuery('#smaname').val('');
				jQuery('#contatct_person').val('');
		jQuery('#ulbid').html(data);//
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
					
				jQuery('#s_type').val('');	
				jQuery('#design_capacity').val('');			
				jQuery('#men').val('');
				jQuery('#women').val('');
				jQuery('#children').val('');
				jQuery('#total').val('');				
				jQuery('#smaname').val('');
				jQuery('#contatct_person').val('');
		
		jQuery('#ngoid').html(data);//
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}

function getdetails(ngoid)
{
	
	 jQuery.ajax({
		  type: 'POST',
		  url: 'getngodetails.php',
		  data: "ngoid="+ngoid,
		  dataType: 'html',
		  success: function(data){				  
		
		
		var jsonobj = jQuery.parseJSON(data);
						//$( "#shelter_type option:selected" ).text(jsonobj.s_type);					
				jQuery('#s_type').val(jsonobj.s_type);	
				jQuery('#design_capacity').val(jsonobj.design_capacity);			
				jQuery('#men').val(jsonobj.men);
				jQuery('#women').val(jsonobj.women);
				jQuery('#children').val(jsonobj.children);
				jQuery('#total').val(jsonobj.total);				
				jQuery('#smaname').val(jsonobj.smaname);
				jQuery('#contatct_person').val(jsonobj.contatct_person);
				jQuery('#districtid').val(jsonobj.districtid);
				jQuery('#ulbid').val(jsonobj.ulbid);
		
		
				//jQuery('#showdatarecord').html(data);					
				
			}
		  });//ajax close
}
		
	function GetBank(data)
{
	if(data=='YES'){
			   
			   jQuery("#bank").show();
			   }
			else
				{
					 jQuery("#bank").hide();
				}
}	
	</script>
	
	

</body>

</html>