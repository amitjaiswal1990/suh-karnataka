<?php

include("adminsession.php");



$perPage = 50;
$page = 0;
if (isset($_POST['page'])) { 
	$page  = $_POST['page']; 
} else { 
	$page=1; 
};  
$startFrom = ($page-1) * $perPage;  
$sqlQuery = "SELECT `id`, `profile_id`, `per_name`, `date_of_birth`, `age`, `gender`, `differently_abled`, `profile_photo`, `place_individual_identified`, `stateid`, `districtid`, `ulbid`, `panchayat_id`, `shelter_id`, `ngoid`, `phone_no`, `alternative_phone_no`, `address`, `percondition`, `status`, `domicile_state`, `domicile_district`, `domicile_village`, `marital_status`, `noofchild`, `last_stayed_place`, `period_stayed_place`, `connon_language`, `language_read`, `language_write`, `language_speak`, `qualification`, `study_place`, `health_condition`, `physical_ailment`, `fir_copy`, `imgname`, `employment`, `emp_type`, `skill`, `skill_type`, `ssecurity`, `adhaar_no`, `ration_no`, `createdate`, `bankac`, `userid`, `entry_type`, `remarks`, `reintegration`, `vacant_date`, `purpose_release`, `etc`, `exit_time`, `referrer_name`, `ref_mobile`, `ref_occupation`, `ref_remark`, `entry_time` FROM `personal_details` WHERE 1 LIMIT $startFrom, $perPage";  
	//echo $sqlQuery;
$result = mysqli_query($connection, $sqlQuery); 
$paginationHtml = '';
  $sno=1;
while ($get_data = mysqli_fetch_assoc($result)) { 
       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");

					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");

					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");

					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");

					     $attendance=$cmn->getvalfield($connection,"attendance_details","attendance","districtid='$get_data[districtid]' && ulbid='$get_data[ulbid]' && ngoid='$get_data[ngoid]' && atten_date='$currentdate' && pid='$get_data[id]'");


		 	      


		 	    $district= ucfirst(strtolower($district));

                $ulbname= ucfirst(strtolower($ulbname));
                $pername= $row['per_name'];

                // $dob=dateformatindia($row['date_of_birth']);
                $age=$row['age'];
                $gender= $row['gender'];

                 

                   

                             

    
    
	$paginationHtml.='<tr>';  
	$paginationHtml.='<td>'.$sno++.'</td>';
	$paginationHtml.='<td>'.$district.'</td>';
	$paginationHtml.='<td>'.$ulbname.'</td>'; 
	$paginationHtml.='<td>'.$pername.'</td>';
	$paginationHtml.='<td>'.$dob.'</td>';
	$paginationHtml.='<td>'.$age.'</td>'; 
	$paginationHtml.='<td>'.$gender.'</td>'; 
	
	
	$paginationHtml.='</tr>';  
} 
$jsonData = array(
	"html"	=> $paginationHtml,	
);
echo json_encode($jsonData); 
?>