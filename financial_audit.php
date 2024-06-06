<?php
include("adminsession.php");
$pagename = "financial_audit.php";
$module = "Add Financial Details";
$submodule = "Add Financial Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "financial_audit";
$tblpkey = "finid";
$imgpath = "uploaded/financial/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'finid' ] ) )
	$keyvalue = $_GET[ 'finid' ];
else
	$keyvalue = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
	
	
	if ( isset( $_POST[ 'submit' ] ) ) {
		$findate=$_POST['findate'];;

$financial_year=$_POST['financial_year'];	
$imgname=$_FILES['imgname'];
$districtid =  $_POST['districtid'];			
			$ngoid =  $_POST['ngoid'];
			$ulbid =  $_POST['ulbid'];

	//check Duplicate
	$check = check_duplicate( $connection, $tblname, "findate = '$findate'  and financial_year = '$financial_year'  and $tblpkey <> '$keyvalue'" );
	if ( $check > 0 ) {
		$dup = " Error : Duplicate User Id";
	} else {
		if ( $keyvalue == 0 ) {
			
			//insert
			$form_data = array('findate' => $findate,'stateid' => $stateid,'districtid' => $districtid,'ulbid' => $ulbid,'ngoid' => $ngoid,'financial_year' => $financial_year,'userid' => $loginid);
			dbRowInsert( $connection, $tblname, $form_data );
			$keyvalue = mysqli_insert_id( $connection );
			$uploaded_filename = uploadImage($imgpath,$imgname);
			mysqli_query($connection,"update financial_audit set imgname='$uploaded_filename' where finid='$keyvalue'");
			$action = 1;
			$process = "insert";
		} else {
			//update
			
			$form_data = array('findate' => $findate,'stateid' => $stateid,'districtid' => $districtid,'ulbid' => $ulbid,'ngoid' => $ngoid,'financial_year' => $financial_year,'userid' => $loginid);
			dbRowUpdate( $connection, $tblname, $form_data, "WHERE $tblpkey = '$keyvalue'" );
			if($_FILES['imgname']['tmp_name']!="")
				{
					//delete old file
					$rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,'1=1'));
					$oldimg = $rowimg["imgname"];
					if($oldimg != "")
					unlink("uploaded/financial/$oldimg");
					
					//insert new file
					$uploaded_filename = uploadImage($imgpath,$imgname);
					//$cmn->convert_image($uploaded_filename,"uploaded/slider","150","150");
					mysqli_query($connection,"update $tblname set imgname='$uploaded_filename' where $tblpkey='$keyvalue'");
				}
			
			$action = 2;
			$process = "updated";
		}

		echo "<script>location='$pagename?action=$action'</script>";

	}
}

	

if (isset($_GET[$tblpkey])){
//$btn_name = "Update";
//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );

$findate=$rowedit['findate'];
$financial_year=$rowedit['financial_year'];	
$imgname=$rowedit['imgname'];
$districtid =  $rowedit['districtid'];			
			$ngoid =  $rowedit['ngoid'];
			$ulbid =  $rowedit['ulbid'];


} else {
$findate=date('Y-m-d');

$perid='';
$financial_year='';	
$imgname='';
//$districtid = '';			
//$ngoid =  '';
//$ulbid = '';
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
        <?php  include("inc/alerts.php");?>
		<form  method="post" action="" enctype="multipart/form-data"><div><input type="hidden" name="org.apache.struts.taglib.html.TOKEN" value="23dbbcf7349cfcf95cbba4067c3c7704"></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
              <h4 class="card-title">Financial Details Entry</h4><a href="financial_audit_list.php" class="btn btn-info" style="float:right;">Show List</a>
					
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
					
					
						<th style="width: 25%;">Date</th>
						<td style="width: 25%;"><input type="date" name="findate" value="<?php echo $findate;?>" placeholder="DD-MM=YYYY"  id="findate" class="form-control required"></td>
						</tr>
					<tr>
						<th style="width: 25%;">Financial Year </th>
						<td style="width: 25%;">
                            <select name="financial_year" id="financial_year" class="form-control">
                       <option value="">-Select-</option>
                                          
                                          			<option value="2010">2010-2011</option>
                                                    <option value="2011">2011-2012</option>
                                                    <option value="2012">2012-2013</option>
                                                    <option value="2013">2013-2014</option>
                                                    <option value="2014">2014-2015</option>
                                                    <option value="2015">2015-2016</option>
                                                    <option value="2016">2016-2017</option>
                                                    <option value="2017">2017-2018</option>
                                                    <option value="2018">2018-2019</option>
                                                    <option value="2019">2019-2020</option>
                                                    <option value="2020">2020-2021</option>
                                           
                                      </select>
                                        <script> document.getElementById('financial_year').value='<?php echo $financial_year; ?>';  </script>
                                        
                        </td>
					
					
						
						<th style="width: 25%;">Upload Document Photo/PDF</th>
						<td><input type="file" name="imgname" value="" id="imgname" class="form-control required">
                       <?php if($imgname!=""){ ?> <img id="blah" alt="" height='50'width='50' title='Text Image' src='<?php if($imgname!="" && file_exists("uploaded/financial/".$imgname))
					        {
								echo "uploaded/financial/".$imgname; }?>'/> <?php } ?>
						 </td>
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
  </script>
</body>

</html>