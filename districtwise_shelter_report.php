<?php

include("adminsession.php");

//error_reporting(0);

$_GET['stateid']=2;







if($usertype=='ADMIN')

		{

				$con1 = "where 1=1";

				$con='1=1';

				$crit=' 1=1';

		

		}

		else

		{

			$con1=" where districtid='$districtid' and ulbid='$ulbid' and ngoid='$ngoid'";

			$con=" districtid='$districtid'";

			$crit=" districtid='$districtid'";

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

	if($_GET['stateid']!=0 && $_GET['stateid']!=''){

		$con1 .=" and stateid = '$_GET[stateid]'";

		//$con .=" and stateid = '$_GET[stateid]'";

	}

	

	

	

	if($_GET['districtid']!=0 && $_GET['districtid']!=''){

		 $con1 .=" and districtid = '$_GET[districtid]'";

		 $con .=" and districtid = '$_GET[districtid]'";

	}

	if($_GET['ulbid']!=0 && $_GET['ulbid']!=''){

		  $con1 .=" and ulbid = '$_GET[ulbid]'";

		 $con .=" and ulbid = '$_GET[ulbid]'";

	}

	

	if($_GET['ngoid']!=0 && $_GET['ngoid']!=''){

		 $con1 .=" and ngoid = '$_GET[ngoid]'";

		 $con .=" and ngoid = '$_GET[ngoid]'";

	}

	

	if($fromdate!="" && $todate!="")

{

	//$fromdate = $cmn->dateformatusa($fromdate);

	//$todate = $cmn->dateformatusa($todate);

	$crit .= " and  createdate between '$fromdate' and '$todate'";

}



?>

<?php include("inc/body.php");?>
<?php include("inc/header.php");?>
	<!-- End Navigation Bar-->

<div class="wrapper">
	<div class="row">
		<div class="col-md-12">

				



<div class="container-fluid">

	<div class="card ">

		<div class="card-header ">

			<!-- <span class="pull-right text-danger">Amounts in Rs. only</span> -->

			<h4 class="card-title" style="text-align: center;" >

				

				<span>District wise Shelters Report</span>

			</h4>

		</div>

			<form  method="get" action="" enctype="multipart/form-data">

	<div class="table-responsive">

				<table class="table table-bordered table-striped">

                

                	<tr>

						<td style="widtd: 20%;">Date</td>

                       

                        <td style="widtd: 20%;">District Name</td>

                        <td style="widtd: 20%;">ULB Name </td>

                          <td style="widtd: 20%;">Shelter Name</td>

						</tr>

                        <tr>

                             <td style="widtd: 20%;"><input type="date" name="fromdate" id="fromdate" class="input-small"  placeholder='dd-mm-yyyy'

                     value="<?php echo $fromdate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask /> 

                     <input type="hidden" name="todate" id="todate" class="input-small" 

                    placeholder='dd-mm-yyyy' value="<?php echo $todate; ?>" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask />

                     </td>

                   

                    

                   

                       <td style="widtd: 20%;">

                      	<?php if($usertype=='SHELTER')

                        { ?>

                        <input  type="hidden"  name="districtid" value="<?php echo $districtid; ?>"  id="districtid" class="form-control" autocomplete="off">

                           <input  type="text"  name="district" value="<?php echo $district; ?>"  id="district"  readonly class="form-control" autocomplete="off">

                        

                        <?php } else { ?>

							

							 <select name="districtid" id="districtid" onChange="getulb();getshelter();"  class="form-control"><option value="">-- Select District--</option>

                        <?php $dist=mysqli_query($connection,"SELECT districtid,districtname FROM m_district $condata order by districtname asc");

							while($data=mysqli_fetch_array($dist)){

							

								?>

							  <option value="<?php echo $data['districtid']; ?>"><?php echo ucfirst(strtolower($data['districtname'])); ?></option>

						<?php } ?>

                     </select>

                         <script>document.getElementById('districtid').value='<?php echo $_GET['districtid']; ?>'; </script>

							

							<?php }?>

						</td>

						

						<td style="widtd: 20%;">

							<?php if($usertype=='SHELTER')

                        { ?>

                        <input  type="hidden"  name="ulbid" value="<?php echo $ulbid; ?>"  id="ulbid" class="form-control" autocomplete="off">

                           <input  type="text"  name="ulbname" value="<?php echo $ulbname; ?>"  id="ulbname"  readonly class="form-control" autocomplete="off">

                        

                        <?php } else { ?>

							

						 <select name="ulbid" id="ulbid" onChange="getshelter();"  class="form-control"><option value="">-- Select --</option>

                        <?php $dist=mysqli_query($connection,"select ulbid,ulbname from ulb_master $conulb order by ulbname asc");

							while($data=mysqli_fetch_array($dist)){?>

							  <option value="<?php echo $data['ulbid']; ?>"><?php echo ucfirst(strtolower($data['ulbname'])); ?></option>

						<?php } ?>

                     </select>

                       <script>document.getElementById('ulbid').value='<?php echo $_GET['ulbid']; ?>'; </script>

							

							<?php }?>

						</td>

						

						<td style="widtd: 20%;">

                      	<?php if($usertype=='SHELTER')

                        { ?>

                        <input  type="hidden"  name="ngoid" value="<?php echo $ngoid; ?>"  id="ngoid" class="form-control" autocomplete="off">

                           <input  type="text"  name="ngo" value="<?php echo $ngo; ?>"  id="ngo"  readonly class="form-control" autocomplete="off">

                        

                        <?php } else { ?>

							

						        <select name="ngoid" id="ngoid"  class="form-control" style="width:200px;" onChange="getdetails(this.value);">

                       <option value="">-Select Shelter Name-</option>

                                            <?php 

											$sql1 = "select ngoid,ngoname from m_ngo where $con order by ngoname asc";

											$res1 = mysqli_query($connection,$sql1);

											while($row1 = mysqli_fetch_array($res1))

												{

													

											?>

                                          			<option value="<?php echo $row1['ngoid']; ?>"><?php echo $row1['ngoname']; ?></option>

                                            <?php

												}

												

												?>

                                      </select>  

                                         <script>document.getElementById('ngoid').value='<?php echo $_GET['ngoid']; ?>'; </script>

							

							<?php }?>

                       </td>

                       <td >

                       

						     <input type="submit" name="submit" value="Submit"  style="width:100px; float:none;" class="site-btn">

                            <button ><a href="counseling_report.php"> Clear </a></button>  

						</td>

					

                    </tr>

                  

				</table>

		

		</div>

        <a href="excel_districtwise_shelter_report.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $todate;?>&districtid=<?php echo $_GET['districtid'];?>" class="btn btn-info" style="float:right">Export Excel</a>

        

		</form>

        <table>

						

							 

							<tr>

								<td colspan="12">

									<table id="districtWiseSheltersReport"  class="table display" cellspacing="0" width="100%"  >

									  <thead>

											<tr>

												<th style="text-align: center; width: 1%;">Sl.No.</th>

											

												<th style="text-align: center;">District Name</th>

											

												<th style="text-align: center;">No.of Shelters</th> 

												<th style="text-align: center;">Total Occupied</th>

												

												<th style="text-align: center;">Total Capacity</th>

											</tr>

									   </thead>

									   

										<tbody>

											<?php

	$sno=0;

	$tot=0;

	$totcap=0;

	$totocc=0;

	

	//echo $con1;

					 if($usertype=='SHELTER')

							{

								$sql_data=mysqli_query($connection,"select * from m_district where districtid='$districtid' group by districtid");

								

							}else{

							   

								$sql_data=mysqli_query($connection,"select * from m_district $con1 group by districtid");

							}

											while($get_data=mysqli_fetch_array($sql_data)){

												$sno++;

											 $distname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");

											  

												//$statename=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");

												

												

												$d_capacity=$cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","districtid='$get_data[districtid]'");

												$c_shelter=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","districtid='$get_data[districtid]'");



												

												$tot=$cmn->getvalfield($connection,"attendance_details","count(aid)","districtid='$get_data[districtid]' and attendance='Present' and atten_date='$fromdate'");

												$totocc =$totocc+$tot;

												$totcap +=$d_capacity;

											?>

												<tr>

													<td style="text-align: center;  width: 1%;"><?php echo $sno; ?></td>

													

													<td><?php echo $distname ?> </td>

												

											    	<td style="text-align: right;">

									

											    		<a href="all_shelter_details_report.php?stid=<?php echo $get_data['stateid'] ?>&distid=<?php echo $get_data['districtid'] ?>&ngoid=<?php echo $get_data['ngoid'] ?>&fromdate=<?php echo $fromdate; ?>"><?php echo $c_shelter ?></a>

											    	</td>

													

											    	<td style="text-align: right;">

											    		<a href="inmate_details_report.php?districtid=<?php echo $get_data['districtid'] ?>&fromdate=<?php echo $fromdate; ?>" class="comma sum" ><?php

												echo $tot;

												?></a>

											    	</td>

											    	<td align="right" class="comma  sum"><?php echo $d_capacity ?></td>

												

												</tr>

											

												<?php } ?>

											

										</tbody>

										<tfoot >

											<tr style="font-weight: bold;" >

												<td></td>

												<td style="text-align: center;">Total</td>

											

												

												<td align="right" class="total"><?php echo $c_shel=$cmn->getvalfield($connection,"m_ngo","count(ngoid)","$con"); ?></td>

												<td align="right" class="total"><?php echo $totocc; ?></td>

												<td align="right" class="total"><?php echo $totcap; ?></td>

											</tr>

										</tfoot>

									

									

									

								</table>

							</td>

						</tr>

							

</table>

					</div>

				</div>

		 	

		 	

		 	

		 	

		 	

		 	

		 	

		 	

		 	

		</div> <!-- End of card-body div -->

	</div> <!-- End of card div -->

</div><!--  End of container-fluid div -->



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



	function getmunicipal(){      

//alert('hello');

 var districtid = jQuery("#districtid").val();

//alert(districtid);   

		  jQuery.ajax({

		  type: 'POST',

		  url: 'getmunicipal.php',

		  data: "districtid="+districtid,

		  dataType: 'html',

		  success: function(data){				  

		//alert(data);

		

		jQuery('#corpmunicipal_id').html(data);//

				//jQuery('#showdatarecord').html(data);					

				

			}

		  });//ajax close

}

	function getpanchayat(){      

//alert('hello');

 var districtid = jQuery("#districtid").val();

//alert(districtid);   

		  jQuery.ajax({

		  type: 'POST',

		  url: 'getpanchayat.php',

		  data: "districtid="+districtid,

		  dataType: 'html',

		  success: function(data){				  

		//alert(data);

		

		jQuery('#panchayat_id').html(data);//

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

		

		jQuery('#ulbid').html(data);//

				//jQuery('#showdatarecord').html(data);					

				

			}

		  });//ajax close

}


$(document).ready(function() {
    $('#districtWiseSheltersReport').dataTable( {
       
    } );
} );
	</script>



</body>



</html>