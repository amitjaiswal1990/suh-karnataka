<?php

error_reporting(0);

include("adminsession.php");

if($usertype=='ADMIN')

		{

			$crit = " where 1 = 1 ";

			$con = " where 1 = 1 ";

			$conulb = " where 1 = 1 ";

		

		}

		elseif($usertype=='DISTRICT')

		{

			$crit = " where districtid='$districtid' ";

			$con = " where districtid='$districtid' ";

			$conulb = " where districtid='$districtid' ";

		

		}

		

		elseif($usertype=='ULB')

		{

			$crit = " where ulbid='$ulbid' ";

			$con = " where ulbid='$ulbid' ";

			$conulb = " where ulbid='$ulbid' ";

		

		}

			elseif($usertype=='SHELTER')

		{

			$crit=" where userid='$loginid' ";

			$con=" where districtid='$districtid' ";

			$conulb=" where districtid='$districtid' ";

		}



if($_GET['districtid']) {

	 $districtid = trim(addslashes($_GET['districtid']));

	}

	else

	{

	$districtid='';

	}

	if($_GET['ulbid']) {

	$ulbid = trim(addslashes($_GET['ulbid']));

	}

	else

	{

	$ulbid='';

	}

	if($_GET['ngoid']) {

	$ngoid = trim(addslashes($_GET['ngoid']));

	}

	else

	{

	$ngoid='';

	}

	

	if($_GET['commi_type']) {

	$commi_type = trim(addslashes($_GET['commi_type']));

	}

	else

	{

	$commi_type='';

	}

 if($commi_type !='') {

		$crit .= " and commi_type= '$commi_type'";

		$con .= " and commi_type= '$commi_type'";

	}

 



if($_GET['fromdate']!="" && $_GET['todate']!="")

{

	$fromdate = date("Y-m",strtotime($_GET['fromdate']));


	$todate = date("Y-m",strtotime($_GET['todate']));

}

else

{

	$fromdate = date("Y-m"); 

	$todate = date('Y-m');

}

if($fromdate!="" && $todate!="")

{

//	$fromdate = $cmn->dateformatusa($fromdate);

//	$todate = $cmn->dateformatusa($todate);

	$camp_date = " and  camp_date between '$fromdate' and '$todate'";



}	

if($districtid !='') {

		 $crit .= " and districtid= '$districtid'";

		  $con .= " and districtid= '$districtid'";

		    $conulb .= " and districtid= '$districtid'";

	}	

	

	if($ulbid !='') {

		$crit .= " and ulbid= '$ulbid'";

		$con .= " and ulbid= '$ulbid'";

	}

	

	if($ngoid !='') {

		$crit .= " and ngoid= '$ngoid'";

		$con .= " and ngoid= '$ngoid'";

	}

	//echo "select * from ulb_master where districtid='$districtid' order by ulbname asc";die;

?>

<?php include("inc/body.php");?>



	<?php include("inc/header.php");?>





	<!-- End Navigation Bar-->

	<div class="wrapper">

		

		

			<div class="row">

				

				<div class="col-md-12">

				<form  method="get" action="" enctype="multipart/form-data"><div><input type="hidden" ></div>

		<input type="hidden" name="key">

		<input type="hidden" name="service_id" value="" id="service_id">

		<div class="container-fluid">

		<div class="row">

		<div class="col-md-12">

		<div class="card mt-12">

		<div class="card-header">
						<h4 class="card-title">Medical Camp Report</h4>

		</div>

		<div class="table-responsive">

				<table class="table table-bordered table-striped">

                

                	<tr>

						<td style="width: 15%;">From Month</td>

                        <td style="width: 15%;">To Month</td>

                        <td style="width: 20%;">District Name</td>

                        <td style="width: 20%;">ULB Name </td>

                          <td style="width: 20%;">Shelter Name</td>
						  <td style="width: 10%;"></td>

						</tr>

                        <tr>

                          	<td style="width: 15%;">
						  		<input type="month" name="fromdate" id="fromdate" class="input-small form-control"  placeholder='dd-mm-yyyy'

                     			value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> 
							</td>
                    

					 		<td style="width: 15%;">
								<input type="month" name="todate" id="todate" class="input-small form-control"  placeholder='dd-mm-yyyy'

								value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> 
							</td>

                       		<td style="widtd: 20%;">

								<?php if($usertype=='SHELTER')

								{ ?>

								<input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">

								<input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">

								

								<?php } else { ?>

							

								<select  name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>

									<?php $dist=mysqli_query($connection,"SELECT districtid,districtname FROM m_district $condata order by districtname asc");

										while($data=mysqli_fetch_array($dist)){

										

											?>

										<option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>

									<?php } ?>

								</select>

								<script>document.getElementById('districtid').value='<?php echo $districtid; ?>'; </script>

								
											
								<?php }?>

							</td>

						

						<td style="widtd: 20%;">

								<?php if($usertype=='SHELTER')

							{ ?>

							<input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">

							<input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">

							

							<?php } else { ?>

								

							<select  name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>

								<?php $dist=mysqli_query($connection,"select ulbid,ulbname from ulb_master $conulb order by ulbname asc");

									while($data=mysqli_fetch_array($dist)){?>

									<option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>

								<?php } ?>

							</select>

							<script>document.getElementById('ulbid').value='<?php echo $ulbid; ?>'; </script>

								

								<?php }?>

						</td>

						

						<td style="widtd: 20%;">

								<?php if($usertype=='SHELTER')

								{ ?>

								<input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">

								<input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">

								

								<?php } else { ?>

									

										<select name="ngoid" id="ngoid"  class="form-control" onChange="getdetails(this.value);">

							<option value="">-Select Shelter Name-</option>

													<?php 

													echo $sql1 = "select distinct ngoname,ngoid from m_ngo $con order by ngoname asc";

													$res1 = mysqli_query($connection,$sql1);

													while($row1 = mysqli_fetch_array($res1)){ ?>

															<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>

													<?php

														}

														

														?>

											</select>  

												<script>document.getElementById('ngoid').value='<?php echo $ngoid; ?>'; </script>

									

									<?php }?>

                       	</td>

                       <td style="widtd: 10%;">

                       

						     <input type="submit" name="submit" value="Submit"  class="btn btn-success site-btn">

                            <button class="btn btn-warning "><a href="medical_report.php"> Clear </a></button>  

						</td>

					

                    </tr>

                  

				</table>

		

		</div>

		</div>

		</div>

			</div>

			  <a href="excel_medical_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&districtid=<?php echo $districtid;?>&ulbid=<?php echo $ulbid;?>&ngoid=<?php echo $ngoid;?>" class="btn btn-info" style="float:right">Export Excel</a>

	</form>

    

    <table id="dataTable" class="table display">

		 	  <thead>

		 	     <tr>

		 	       <th>Sl.No</th>

					 

					 <th>District</th>

					<th>ULB</th>

					 <th>Shelter Name</th>

		 	       <th>Camp Date</th>

		 	       <th>No. Of Doctor</th>

                   <th>No.of Persons Checked</th>

                   <th>No.of Persons Treated</th>

				  <th>Remark</th>

				<th>Updated Status</th>

		 	     </tr>

		 	  </thead>

		 	  <tbody>

		 	  

		 	      <?php

				  $sno=1;

				//  echo "select * from m_ngo $crit order by districtid,ulbid,ngoname";
                $sqql=mysqli_query($connection,"select * from m_ngo $crit order by districtid,ulbid,ngoname");
				  while($row=mysqli_fetch_array($sqql)){
				    //   echo "select * from  medical_camp  where $con and ngoid='$row[ngoid]'  order by medid desc";
				  $shelterdetail=mysqli_query($connection,"select * from  medical_camp  $con $camp_date and ngoid='$row[ngoid]'  order by medid desc");

				  $get_data=mysqli_fetch_array($shelterdetail);
                  $count=mysqli_num_rows($shelterdetail);
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$row[stateid]'");

					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$row[districtid]'");

					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row[ulbid]'");
				 
				  ?>

		 	      <tr>

		 	      <td><?php echo $sno++; ?></td>

		 	     <td><?php echo ucfirst(strtolower($district));?></td>

                          <td><?php echo ucfirst(strtolower($ulbname));?></td>

				  <td><?php echo $row['ngoname']; ?></td>

				  <td><?php echo $cmn->dateformatindia($get_data['camp_date'])?></td>

				 <td><?php echo $get_data['no_doctors']?></td>

                  <td><?php echo $get_data['no_persons_checked']?></td>

                   <td><?php echo $get_data['no_persons_treated']?></td>

				  <td><?php echo $get_data['remarks']?></td>

		 	       <td><?php if($count<1){?><span style="color:red">No</span><?php } else{?><span style="color:green">Yes</span><?php } ?></td>


		 	    </tr>

		 	    <?php } ?>

		 	   

		 	    

		 	  </tbody>

			</table>



		</div>

				<!-- end col -->

		

			<!-- end row -->

		</div>











		<!-- end col -->

	</div>

	<!-- end row -->

	











	<!-- end container-fluid -->

	</div>

	<!-- end wrapper -->









	<?php include("inc/footer.php"); ?>







<script>

	function funDel(id)

	{  //alert(id);   

		tblname = '<?php echo $tblname; ?>';

		tblpkey = '<?php echo $tblpkey; ?>';

		pagename = '<?php echo $pagename; ?>';

		submodule = '<?php echo $submodule; ?>';

		module = '<?php echo $module; ?>';

		 //alert(module); 

		if(confirm("Are you sure! You want to delete this record."))

		{

			jQuery.ajax({

			  type: 'POST',

			  url: 'ajax/delete_master.php',

			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,

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

		  url: 'getngoreport.php',

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

		  url: 'getulbreport.php',

		  data: "districtid="+districtid,

		  dataType: 'html',

		  success: function(data){	

		  jQuery('#ulbid').html(data);

		

		

				//jQuery('#showdatarecord').html(data);					

				

			}

		  });//ajax close

}

$(document).ready(function() {
    $('#dataTable').dataTable( {
       
    } );
} );
  </script>



</body>

</html>