<?php

//error_reporting(0);

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

if($_GET['fromdate']!="" && $_GET['todate']!="")

{

	$fromdate = addslashes(trim($_GET['fromdate']));

	$todate = addslashes(trim($_GET['todate']));

}

else

{

	$fromdate = date("Y-m-d"); 

	$todate = date('Y-m-d');

}



if($_GET['fromage']!="" && $_GET['toage']!="")

{

	$fromage = addslashes(trim($_GET['fromage']));

	$toage = addslashes(trim($_GET['toage']));

}

else

{

	$fromage = ''; 

	$toage ='';

}

if($_GET['fromperiod']!="" && $_GET['toperiod']!="")

{

	$fromperiod = addslashes(trim($_GET['fromperiod']));

	$toperiod = addslashes(trim($_GET['toperiod']));

}

else

{

	$fromperiod = ''; 

	$toperiod ='';

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

	

	if($_GET['gender']) {

	$gender = trim(addslashes($_GET['gender']));

	}

	else

	{

	$gender='';

	}

 

 



if($fromdate!="" && $todate!="")

{

	//$fromdate = $cmn->dateformatusa($fromdate);

	//$todate = $cmn->dateformatusa($todate);

	$crit .= " and  createdate between '$fromdate' and '$todate'";

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

	if($fromage!="" && $toage!="")

{

	//$fromdate = $cmn->dateformatusa($fromdate);

	//$todate = $cmn->dateformatusa($todate);

	$crit .= " and  age between '$fromage' and '$toage'";

}



if($fromperiod!="" && $toperiod!="")

{

	//$fromdate = $cmn->dateformatusa($fromdate);

	//$todate = $cmn->dateformatusa($todate);

	$crit .= " and  period_stayed_place between '$fromperiod' and '$toperiod'";

}

if($gender !='') {

		 $crit .= " and gender= '$gender'";

		 

	}

	

	

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

						<h4 class="card-title">Beneficiary Profile/ Beneficiary Report</h4>

		</div>

		<div class="table-responsive">

				<table class="table table-bordered table-striped">

                

                	<tr>

						<td style="widtd: 20%;">From Date</td>

                        <td style="widtd: 20%;">To Date</td>

                        <td style="widtd: 20%;">District Name</td>

                        <td style="widtd: 20%;">ULB Name </td>

                          <td style="widtd: 20%;">Shelter Name</td>

                         

						</tr>

                        <tr>

                             <td style="widtd: 20%;"><input type="date" name="fromdate" id="fromdate" class="input-small"  placeholder='dd-mm-yyyy'

                     value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> </td>

                   

                    

                    <td style="widtd: 20%;"><input type="date" name="todate" id="todate" class="input-small" 

                    placeholder='dd-mm-yyyy' value="<?php echo $todate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /></td>

                    	

                       <td style="widtd: 20%;">

                      	<?php if($usertype=='SHELTER')

                        { ?>

                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">

                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">

                        

                        <?php } else { ?>

							

							 <select  name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>

                        <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");

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

                        <?php $dist=mysqli_query($connection,"select * from ulb_master $conulb order by ulbname asc");

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

							

						        <select name="ngoid" id="ngoid"  class="form-control" style="width:150px;" onChange="getdetails(this.value);">

                       <option value="">-Select Shelter Name-</option>

                                            <?php 

											$sql1 = "select distinct ngoname,ngoid from m_ngo $con order by ngoname asc";

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

                       <tr> <td style="widtd: 20%;">Age</td>

                        

                        <td style="widtd: 20%;">Duration of Stay</td>

                        <td style="widtd: 20%;">Gender</td>

                       </tr>

                       <tr>

							<td ><input type="number" name="fromage"  style="width:80px; float:left"  value="<?php echo $fromage; ?>" id="fromage" class="form-control" autocomplete="off" placeholder="From">

                            <input type="number" name="toage" style="width:80px; float:right"  value="<?php echo $toage; ?>" id="toage" class="form-control" autocomplete="off" placeholder="To">

                            </td>

                            <td ><input type="number" name="fromperiod"  style="width:80px; float:left"  value="<?php echo $fromperiod; ?>" id="fromperiod" class="form-control" autocomplete="off" placeholder="From">

                            <input type="number" name="toperiod"  style="width:80px; float:right"  value="<?php echo $toperiod; ?>" id="toperiod" class="form-control" autocomplete="off" placeholder="To">

                            </td>

                            	<td > <select name="gender" id="gender"  class="form-control" style="width:150px;">

                                 <option value="">-Select-</option>

                                        <option value="Male">Male</option>

                                        <option value="Female">Female</option>

                                        <option value="Third Gender">Third Gender</option>

                                      </select>  

                                         <script>document.getElementById('gender').value='<?php echo $gender; ?>'; </script></td>

                                	

                      

					  <td colspan="2" >

                       

						    

                            <a href="inspection_details_report.php" style="width:100px; float:none; float:center;" class="btn btn-danger"> Clear </a>  

                             <input type="submit" name="submit" value="Submit"  style="width:100px; float:none; float:center;" class="btn btn-success">

						</td>

                    </tr>

                    

                    <tr>

						

                       

						</tr>

                        

                  

				</table>

		

		</div>

		</div>

		</div>

			</div>

			

	</form>

      <a href="excel_personal_details.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&districtid=<?php echo $districtid;?>&ulbid=<?php echo $ulbid;?>&ngoid=<?php echo $ngoid;?>&fromage=<?php echo $fromage;?>&toage=<?php echo $toage;?>&fromperiod=<?php echo $fromperiod;?>&toperiod=<?php echo $toperiod;?>&gender=<?php echo $gender;?>" class="btn btn-info" style="float:right">Export Excel</a>

    

    

    

	  <table id="dataTable" class="table display">

		 	  <thead>

		 	     <tr>

		 	       <th>Sl.No</th>

                     <th>Photo</th>

                                    <th>District</th>

                    <th>ULB</th>

                    <th>Shelter Name</th>

                    <th>Name</th>

                    <th>DOB</th>

                    <th>Age</th>

                    <th>Gender</th>



                        

					

		 	     </tr>

		 	  </thead>

		 	  <tbody>

		 	  

		 	      <?php

				  $sno=1;

	

				  $shelterdetail=mysqli_query($connection,"select * from personal_details $crit");

				  while($get_data=mysqli_fetch_array($shelterdetail)){

				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");

					    $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");

					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");

					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");

					 //  $id=$cmn->getvalfield($connection,"attendance_details","id","id='$get_data[pid]'");

			

						

				  ?>

		 	      <tr>

		 	      <td><?php echo $sno++; ?></td>

		 	     <td> <?php if($get_data['profile_photo']!=''){?>  <img src="uploaded//personal/inmate/<?php echo $get_data['profile_photo'];?>"   style=" height:30px; width:30px;" id="imgprvw" /> <?php } ?></td> 

		 	    <td><?php echo ucfirst(strtolower($district));?></td>

                          <td><?php echo ucfirst(strtolower($ulbname));?></td>

				  <td><?php echo $ngo; ?></td>

				

				  <td>

				

				  <?php echo $get_data['per_name']?></td>

                    <td><?php echo dateformatindia($get_data['date_of_birth'])?></td>

                      <td><?php echo $get_data['age']?></td>

		 	       <td><?php echo $get_data['gender']?></td>

                           

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