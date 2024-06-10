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

	$con .= " and  camp_date between '$fromdate' and '$todate'";



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

$filename = "MedicalReport".strtotime("now").'.xls';

// Defines the name of the export file "codelution-export.xls"

header("Content-Disposition: attachment; filename=".$filename);

?>


 <table class="table table-bordered table-striped">

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
				  $shelterdetail=mysqli_query($connection,"select * from  medical_camp  $con and ngoid='$row[ngoid]'  order by medid desc");

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


