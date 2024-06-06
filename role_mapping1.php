<?php
include("adminsession.php");
$pagename = "role_mapping.php";
$module = "Add Role Mapping";
$submodule = "Role Mapping";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "role_mapping";
$tblpkey = "mapid";
if ( isset( $_GET[ 'userid' ] ) )
	$userid = $_GET[ 'userid' ];
else
	$userid = 0;
if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim( $_GET[ 'action' ] ) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ]  ) ){
	 $userid =  $_POST[ 'userid' ];
	 $menuid =  $_POST[ 'menuid' ];
	
    $submenuname =  $_POST[ 'submenuname' ];
	$page_link =  $_POST[ 'page_link' ];
	$activity =  $_POST[ 'activity' ];
	$activity1 =  $_POST[ 'activity1' ];
	
//print_r($submenuname);
//print_r($activity);
//die;
 
 //$totmenuid =$cmn->getvalfield($connection,"savemenu_mapping","count(menuid)","userid='$userid'");

	//check Duplicate
	
		/*if ( $totmenuid == 0 ) {
					$totmenu = count($menuid);					
					for ($k = 0; $k < $totmenu; $k++) {	
				//insert
				
				mysqli_query($connection,"insert into savemenu_mapping set userid='$userid',menuid='$menuid[$k]',activity='$activity1[$k]'");
					//$form_data = array('userid' => $userid,'submenuname' => $submenuname[$i],'page_link' => $page_link[$i],'activity' => $activity[$i] );
					//dbRowInsert( $connection, $tblname, $form_data );
				}
		}
		
		else {
			//update
			//echo "DELETE FROM `role_mapping` WHERE userid = '$userid'";die;
			mysqli_query($connection,"DELETE FROM `savemenu_mapping` WHERE userid = '$userid'");
			$totmenu = count($menuid);					
					for ($k = 0; $k < $totmenu; $k++) {	
					
					echo "insert into savemenu_mapping set userid='$userid',menuid='$menuid[$k]',activity='$activity1[$k]'";
		mysqli_query($connection,"insert into savemenu_mapping set userid='$userid',menuid='$menuid[$k]',activity='$activity1[$k]'");
					} 
		}*/
		
		
		$totmenuid =$cmn->getvalfield($connection,"role_mapping","count(menuid)","userid='$userid'");
		if ( $totmenuid == 0 ) {
			$totactivity1 = count($activity1);		
			for ($k = 0; $k < $totactivity1; $k++) {		
			$menuid =$cmn->getvalfield($connection,"menu_details","menuid","menuid='$activity1[$k]'");
			//$page_link =$cmn->getvalfield($connection,"submenu_details","page_link","subid='$activity[$i]'");				
			mysqli_query($connection,"insert into role_mapping set userid='$userid',subid='$activity1[$k]'menuid='$menuid',activity='1'");		
		}
		}
		else
		{
			mysqli_query($connection,"DELETE FROM `role_mapping` WHERE userid = '$userid' and menuid!=0");
			$totactivity1 = count($activity1);		
			for ($k = 0; $k < $totactivity1; $k++) {		
			$menuid =$cmn->getvalfield($connection,"menu_details","menuid","menuid='$activity1[$k]'");
			//$page_link =$cmn->getvalfield($connection,"submenu_details","page_link","subid='$activity[$i]'");	
			echo "insert into role_mapping set userid='$userid',menuid='$menuid',activity='1'";
			mysqli_query($connection,"insert into role_mapping set userid='$userid',subid='$activity1[$k]',menuid='$menuid',activity='1'");
			}
			
		}
		
		
		
		
		$totmenu =$cmn->getvalfield($connection,"role_mapping","count(userid)","userid='$userid'");
		if ( $totmenu == 0 ) {
			$totactivity = count($activity);		
			for ($i = 0; $i < $totactivity; $i++) {	
			$submenuname =$cmn->getvalfield($connection,"submenu_details","submenuname","subid='$activity[$i]'");
			$page_link =$cmn->getvalfield($connection,"submenu_details","page_link","subid='$activity[$i]'");							
			mysqli_query($connection,"insert into role_mapping set userid='$userid',subid='$activity[$i]',submenuname='$submenuname',page_link='$page_link',activity='1'");		
		}
		//	$keyvalue = mysqli_insert_id( $connection );
		$action = 1;
		$process = "insert";
		}
		
		else {
		//update
		//echo "DELETE FROM `role_mapping` WHERE userid = '$userid' and menuid=0";die;
			mysqli_query($connection,"DELETE FROM `role_mapping` WHERE userid = '$userid' and menuid=0");
			$totactivity = count($activity);	
		
			for ($i = 0; $i < $totactivity; $i++) {			
			$submenuname =$cmn->getvalfield($connection,"submenu_details","submenuname","subid='$activity[$i]'");
			$page_link =$cmn->getvalfield($connection,"submenu_details","page_link","subid='$activity[$i]'");					
			//insert		
			mysqli_query($connection,"insert into role_mapping set userid='$userid',subid='$activity[$i]',submenuname='$submenuname',page_link='$page_link',activity='1'");
			} 
			$action = 2;
			$process = "updated";
			}		
		echo "<script>location='$pagename?action=$action&userid=$userid'</script>";

	
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

	<?php include("inc/header.php");?>


	<!-- End Navigation Bar-->
	<div class="wrapper">
		<form name="addServiceForm" method="post" action="">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-4">
		<div class="card" style="margin-top: 10px;">
		
		<div class="card-header with-border" style="text-align: center;">
							<h4 class="card-title">Role Service Mapping</h4>
						</div>
						<div class="table-responsive">
		        <div class="form-group">
				<label><h4>Role Name</h4></label>	
					<select  class="form-control" style="width:90%;" name="userid" id="userid" > <option value="">--Select--</option>
							
										<?php $sql=mysqli_query($connection,"select * from user");
											while($data=mysqli_fetch_array($sql)){
											?>
											<option value="<?php echo $data['userid']; ?>" ><?php echo $data['usertype'] ?></option>
											<?php } ?>
		
											</select>
                                             <script> document.getElementById('userid').value='<?php echo $userid; ?>'; </script>
				</div>
				 <div class="form-group">
					<center><input type="button" name="formSubmit" value="Go" onClick="changeUrl()" class="site-btn"></center>
					</div>
			</div>
		</div>
		</div>
		
		
		<div class="col-md-8">
					<div class="card card-success"  style="margin-top: 10px;">
						<div class="card-header with-border" style="text-align: center;">
							<h4 class="card-title">
								Role Service Details
							</h4>
						</div>
						<div class="table-responsive">
				<table class="table table-stripped table-bordered table-striped">
				<tr>
				<th>Sl. No</th>
				<th>Service Name</th>
				<th>Action</th>
				</tr>
				
				<tbody>
                <?php	$slno=1;
				$sql = mysqli_query($connection,"select * from menu_details order by menuid desc");
				while($row = mysqli_fetch_assoc($sql))
				{	
					?>
					
						<tr>
							<td style="text-align: center;">
								<?php echo $slno++; ?>
							</td>
							<td>
								<?php echo $row['menuname']; ?>
                                
                                <input class="form-check-input" type="hidden"  name="menuid[]"  value="<?php echo $row['menuid']; ?>">
                              
							</td>
							<td style="text-align: center;" >
							 <?php  $activity =$cmn->getvalfield($connection,"role_mapping","activity","userid='$userid' and activity=1 and menuid='$row[menuid]'"); ?>
							<div class="form-check abc-checkbox abc-checkbox-primary">
			<input class="form-check-input" type="checkbox" title="HOME" aria-label="Single checkbox One" id="activity" name="activity1[]" <?php if($activity==1){?> checked  <?php } ?> value="<?php echo $row['menuid']; ?>">
                        <!-- <input class="form-check-input" type="checkbox" id="singleCheckbox1" value="option1" aria-label="Single checkbox One"> -->
                        <label class="form-check-label" for="activity"></label>
                    </div>
							
							</td>
							</tr>
                            <?php } ?>
                            
                            
                              <?php	$slno=1;
				$sql_get = mysqli_query($connection,"select * from submenu_details order by subid desc");
				while($row_get = mysqli_fetch_assoc($sql_get))
				{	
					?>
					
						<tr>
							<td style="text-align: center;">
								<?php echo $slno++; ?>
							</td>
							<td>
								<?php echo $row_get['submenuname']; ?> (<?php echo $row_get['page_link']; ?>)
                                <input class="form-check-input" type="hidden"  name="submenuname[]"  value="<?php echo $row_get['submenuname']; ?>">
                                <input class="form-check-input" type="hidden"  name="page_link[]"  value="<?php echo $row_get['page_link']; ?>">
                                
                              
							</td>
							<td style="text-align: center;" >
                            
                            
							 <?php  $activity =$cmn->getvalfield($connection,"role_mapping","activity","userid='$userid' and submenuname='$row_get[submenuname]' and activity=1"); ?>
							<div class="form-check abc-checkbox abc-checkbox-primary">
			<input class="form-check-input" type="checkbox" title="HOME" aria-label="Single checkbox One" id="activity" name="activity[]" <?php if($activity==1){?> checked  <?php } ?> value="<?php echo $row_get['subid'];?>">
                        <!-- <input class="form-check-input" type="checkbox" id="singleCheckbox1" value="option1" aria-label="Single checkbox One"> -->
                        <label class="form-check-label" for="activity"></label>
                    </div>
							
							</td>
							</tr>
                            <?php } ?>
				
				</tbody>	
					<tr>
						<td colspan="4" style="text-align: center;">
						 <div class="col-xs-4">
							<input type="submit" name="submit" value="Submit"  class="site-btn">
						 </div>
						</td>
					</tr>
				
			</table>
			</div>
			</div>
			</div>
		
		</div>
		</div>
	</form>





		<!-- end col -->
	</div>
	<!-- end row -->
	</div>





	<!-- end container-fluid -->
	</div>
	<!-- end wrapper -->




	<?php include("inc/footer.php"); ?>
    <script>
	function changeUrl()
	{
		userid = document.getElementById("userid").value;
		 location='role_mapping.php?userid='+userid;
	}
	</script>

</body>
<!-- Mirrored from themesbrand.com/lexa/html/horizontal/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Aug 2019 07:19:42 GMT -->
</html>