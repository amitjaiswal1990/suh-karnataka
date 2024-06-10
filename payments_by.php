<?php

include("adminsession.php");

//echo $usertype;die;

$pagename = "payments_by.php";

$module = "Add Payments Details";

$submodule = "Add Payments Details";

$btn_name = "Save";

$keyvalue = 0;

$tblname = "payments_by";

$tblpkey = "payid";

$imgpath = "uploaded/financial/";

$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");

	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");

if ( isset( $_GET[ 'payid' ] ) )

	$keyvalue = $_GET[ 'payid' ];

else

	$keyvalue = 0;

if ( isset( $_GET[ 'action' ] ) )

	$action = addslashes( trim( $_GET[ 'action' ] ) );

else

	$action = "";

		

	if ( isset( $_POST[ 'submit' ] ) ) {

			$paydate=$_POST['paydate'];

			$districtid =  $_POST['districtid'];			

			$ngoid =  $_POST['ngoid'];

			$ulbid =  $_POST['ulbid'];

			$term=$_POST['term'];

			//$ispaid=$_POST['ispaid'];

			$amount=$_POST['amount'];

			$remark=$_POST['remark'];

			$approved_by=$_POST['approved_by'];

			//$funds_received=$_POST['funds_received'];

		//	$funds_releases=$_POST['funds_releases'];

			$payment_made=$_POST['payment_made'];

				$underamount=$_POST['underamount'];

			 $other_payment_made=$_POST['payment_made1'];

			 $payment_made_under=$_POST['payment_made_under'];

			$other_payment_made_under=$_POST['payment_made_under1'];

			$total_approved_grant=$_POST['total_approved_grant'];





	//check Duplicate

	

		if ( $keyvalue == 0 ) {

			

			//insert

			$form_data = array('paydate' => $paydate,'term' => $term,'total_approved_grant'=>$total_approved_grant,'stateid' => $stateid,'districtid' => $districtid,'ulbid' => $ulbid,'ngoid' => $ngoid,'amount' => $amount,'remark' => $remark,'payment_made' => $payment_made,'payment_made_under' => $payment_made_under,'other_payment_made' => $other_payment_made,'other_payment_made_under' => $other_payment_made_under,'underamount' => $underamount,'approved_by' => $approved_by,'userid' => $loginid);

			dbRowInsert( $connection, $tblname, $form_data );

			$keyvalue = mysqli_insert_id( $connection );

			$uploaded_filename = uploadImage($imgpath,$imgname);

			//mysqli_query($connection,"update payments_by set imgname='$uploaded_filename' where payid='$keyvalue'");

			$action = 1;

			$process = "insert";

		} else {

			//update

			

			$form_data = array('paydate' => $paydate,'term' => $term,'total_approved_grant'=>$total_approved_grant,'stateid' => $stateid,'districtid' => $districtid,'ulbid' => $ulbid,'ngoid' => $ngoid,'amount' => $amount,'remark' => $remark,'payment_made' => $payment_made,'payment_made_under' => $payment_made_under,'other_payment_made' => $other_payment_made,'other_payment_made_under' => $other_payment_made_under,'underamount' => $underamount,'approved_by' => $approved_by,'userid' => $loginid);

			dbRowUpdate( $connection, $tblname, $form_data, "WHERE $tblpkey = '$keyvalue'" );

			

			

			$action = 2;

			$process = "updated";

		}



		echo "<script>location='$pagename?action=$action'</script>";



}



	



if (isset($_GET[$tblpkey])){

//$btn_name = "Update";

//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;

$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";

$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );





			$paydate=$rowedit['paydate'];

			$districtid =  $rowedit['districtid'];			

			$ngoid =  $rowedit['ngoid'];

			$ulbid =  $rowedit['ulbid'];

			$term=$rowedit['term'];			

			$amount=$rowedit['amount'];

			$remark=$rowedit['remark'];

			$approved_by=$rowedit['approved_by'];

			//$funds_received=$rowedit['funds_received'];

			//$funds_releases=$rowedit['funds_releases'];

			 $payment_made=$rowedit['payment_made'];

			$payment_made_under=$rowedit['payment_made_under'];

			 $other_payment_made=$rowedit['other_payment_made'];

			$other_payment_made_under=$rowedit['other_payment_made_under'];

			$total_approved_grant=$rowedit['total_approved_grant'];

			$underamount=$rowedit['underamount'];





} else {

$paydate=date('Y-m-d');



			//$districtid = '';			

			//$ngoid ='';

			//$ulbid =  '';

			$term='';

			//$ispaid=$rowedit['ispaid'];

			$amount='';

			$remark='';

			$approved_by='';

			$funds_received='';

			$funds_releases='';

			$payment_made='';

			$other_payment_made='';

			$payment_made_under='';

			$other_payment_made_under='';

			$underamount='';
			$total_approved_grant='';

//$imgname='';

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

           <h4 class="card-title">Payments Details Entry</h4><a href="payment_list.php" class="btn btn-info" style="float:right;">Show List</a>

					

		</div>

		<div class="table-responsive">

				<table class="table table-bordered table-striped">

                <tr>

						<th style="width: 20%;">District Name</th>

						

                       <td>

						<?php if($usertype=='SHELTER')

                        { ?>

                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">

                           <input  type="text"  name="district" value="<?php echo $district; ?>" required id="district"  readonly class="form-control" autocomplete="off">

                        

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

							

						        <select name="ngoid" id="ngoid" required class="form-control" onChange="getdetails(this.value);">

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

                	

						<th style="width: 25%;">Term </th>

						<td style="width: 25%;">

                         <select required name="term" id="term" class="form-control required"><option value="">-- Select --</option>

							<!--<option value="Monthly">Monthly</option>-->

							<option value="Quarterly">Quarterly</option>

                            <!--<option value="Half Yearly">Half Yearly</option>-->

                            <!--<option value="Annual">Annual</option>-->

						</select>

                        <script>  document.getElementById('term').value=('<?php echo $term;?>'); </script>

                        

                     </td>

					

					</tr>

                   <tr>

                        
        	<tr>
						<th style="width: 25%;">Total approved grant (psc)  </th>

						<td style="width: 25%;">

                         <input  type="number"  name="total_approved_grant" value="<?php echo $total_approved_grant; ?>"  id="total_approved_grant" required readonly class="form-control" autocomplete="off">


                     </td>

					

					</tr>

                   <tr>
						<th style="width: 25%;">Payment Made By State Towards</th>

						<td style="width: 25%;">

                    

                        <select required name="payment_made" id="payment_made" class="form-control required" onChange="GetStatePay(this.value);"><option value="">-- Select --</option>

							<option value="Survey">Survey</option>

							<option value="O and M">O&M </option>

                            <option value="Refurbishment">Refurbishment </option>

                            <option value="New Construction">New Construction </option>

                             <option value="Others">Others </option>

						</select>

                        <script>  document.getElementById('payment_made').value=('<?php echo $payment_made;?>'); </script>

                      

                        <br>

                     <div id="paystate"  >
						
						<input type="text"  name="payment_made1" value="<?php echo $other_payment_made; ?>" placeholder="Enter Other Mode"  class="form-control" autocomplete="off"><br>

						

                   </div>

                        

                      </td>

					

						<th style="width: 25%;">Amount (Rs)</th>

						<td style="width: 25%;"><input required type="number" name="amount" value="<?php echo $amount;?>" id="amount" class="form-control" autocomplete="off"></td>

					

					</tr>	

                    

                    

                    

                    <tr>

						<th style="width: 25%;">Payment Made By Shelter Towards</th>

						<td style="width: 25%;">

                     

                        <select required name="payment_made_under" id="payment_made_under" class="form-control required" onChange="GetShelterPay(this.value);"><option value="">-- Select --</option>

							<option value="O&M Recovery Mechanism">O&M Recovery Mechanism</option>

							<option value="No of Homeless">No of Homeless </option>

                            <option value="Recovered">Recovered </option>

                            <option value="Reunion">Reunion </option>

                             <option value="Others">Others </option>

						</select>

                        <script>  document.getElementById('payment_made_under').value=('<?php echo $payment_made_under;?>'); </script>

                       

                        
							<div id="payshelter" >
								<input type="text" name="payment_made_under1" value="<?php echo $other_payment_made_under; ?>" placeholder="Enter Other Mode"  class="form-control" autocomplete="off" ><br>
							</div>
							
                  

                      </td>

						

						<th style="width: 25%;">Amount (Rs)</th>

						<td style="width: 25%;"><input type="number" name="underamount" value="<?php echo $underamount;?>" id="underamount" class="form-control" required autocomplete="off"></td>

					

					</tr>

                    

                    

                    <tr>

						<th style="width: 25%;">Date</th>

						<td style="width: 25%;"><input type="date" name="paydate" value="<?php echo $paydate;?>" placeholder="DD-MM-YYYY"  id="paydate" class="form-control" required autocomplete="off"></td>

						

						<th style="width: 25%;">Remarks </th>

						<td style="width: 25%;"><input type="text" name="remark" value="<?php echo $remark;?>" id="remark" class="form-control" autocomplete="off"></td>

					

					</tr>

                    

                     <tr>

						<th style="width: 25%;">Approved By CO/CAO</th>

						<td style="width: 25%;"><input type="text" name="approved_by" value="<?php echo $approved_by;?>"  id="approved_by" class="form-control" required autocomplete="off"></td>

						

				

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


jQuery("#paystate").hide();
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


jQuery("#payshelter").hide();
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

function getdetails(){

}


  </script>

</body>



</html>