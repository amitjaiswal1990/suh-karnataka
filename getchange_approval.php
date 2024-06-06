<?php
include("adminsession.php");
$shelter_id=trim(addslashes($_REQUEST['data'])); 

 $approval_status = $cmn->getvalfield($connection,"m_shelter","approval_status","shelter_id='$shelter_id'");

if($approval_status==0){
	mysqli_query($connection,"update m_shelter set approval_status=1 where shelter_id='$shelter_id' ");
}else{
	mysqli_query($connection,"update m_shelter set approval_status=0 where shelter_id='$shelter_id' ");
}
	

?>

                                     
