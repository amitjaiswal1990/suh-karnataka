<?php include("adminsession.php");

error_reporting(0);
	$crit = " where 1 = 1 ";

			$con = " where 1 = 1 ";

			$conulb = " where 1 = 1 ";
if($usertype=='ADMIN')

		{

			$crit = " where 1 = 1 ";

			$con = " where 1 = 1 ";

			$conulb = " where 1 = 1 ";

		

		}

		else

		{

			
			$con=" where districtid='$districtid' ";

			$conulb=" where districtid='$districtid'";

		}

if($_GET['fromdate']!="")

{

	$fromdate = addslashes(trim($_GET['fromdate']));



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

 

 

if($fromdate!="")

{

	//$fromdate = $cmn->dateformatusa($fromdate);

	//$todate = $cmn->dateformatusa($todate);

	$crit .= " and atten_date = '$fromdate'";

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

 header("Content-type: application/vnd-ms-excel");

$filename = "AttendanceReport".strtotime("now").'.xls';

// Defines the name of the export file "codelution-export.xls"

header("Content-Disposition: attachment; filename=".$filename);

?>




    <table class="table table-bordered table-striped">

		 	  <thead>

		 	     <tr>

		 	       <th>Sl.No</th>

                    <th>Date</th> 

                    <th>District</th>

                    <th>ULB</th>

                    <th>Shelter Name</th>

                    <th>Name</th>
					<th>Contact Number</th>
					<th>Post</th>
                    <th>Adhaar</th>

                    <th>Age</th>

                    <th>Gender</th>



                        <th colspan="2">Attendance</th>

					

		 	     </tr>

		 	  </thead>

		 	  <tbody>

		 	  

		 	      <?php

				  $sno=1;

				//  echo "select * from staff_details $crit";

				// echo "select * from staff_attendance_details $crit order by districtid asc";

				  $shelterdetail=mysqli_query($connection,"select * from staff_attendance_details $crit order by districtid asc");

				  while($get_data=mysqli_fetch_array($shelterdetail)){

				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");

					    $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");

					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");

					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");

					   $staffid=$cmn->getvalfield($connection,"staff_details","staffid","staffid='$get_data[staffid]'");
					   $contact_num=$cmn->getvalfield($connection,"staff_details","mobile_no","staffid='$staffid'");
						$per_name=$cmn->getvalfield($connection,"staff_details","staff_name","staffid='$staffid'");

						$profile_photo=$cmn->getvalfield($connection,"staff_details","imgname","staffid='$staffid'");

		
                        $adhar_no=$cmn->getvalfield($connection,"staff_details","adhar_no","staffid='$staffid'");
						$age=$cmn->getvalfield($connection,"staff_details","age","staffid='$staffid'");

						$gender=$cmn->getvalfield($connection,"staff_details","gender","staffid='$staffid'");
                        $post=$cmn->getvalfield($connection,"staff_details","post","staffid='$staffid'");
						

						

				  ?>

		 	      <tr>

		 	      <td><?php echo $sno++; ?></td>

		 	    <td><?php echo date('d-m-Y',strtotime($get_data['createdate']));?></td>
		 	    <td><?php echo ucfirst(strtolower($district));?></td>

                          <td><?php echo ucfirst(strtolower($ulbname));?></td>

				  <td><?php echo $ngo; ?></td>

				

				  <td>

				  <input type="hidden" id="staffid" name="staffid[]" value=" <?php echo $get_data['staffid']?>">

				  <?php echo $per_name;?></td>
				  <td><?php echo $contact_num; ?></td>
					<td><?php echo $post;?></td>
                   <td><?php echo $adhar_no;?></td>

                      <td><?php echo $age;?></td>

		 	       <td><?php echo $gender;?></td>

                             <td>

                             <?php if($get_data['attendance']=='Present'){ ?> <span style="color:#390"><strong>Present</strong></span> <?php } else { ?> <span style="color:#F00"><strong>Absent</strong></span> <?php } ?>        

                         </td>

			

		 	    </tr>

		 	    <?php } ?>

		 	   

		 	    

		 	  </tbody>

			</table>



 

