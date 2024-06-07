 <?php

include("adminsession.php");

error_reporting(0);

$pagename = "inspection_details_entry.php";

$module = "Add Inspection Details";

$submodule = "Inspection Master";

$btn_name = "Save";

$keyvalue = 0;

$tblname = "inspection_details";

$tblpkey = "insid";

$imgpath = "uploaded/inspection/";

$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");

	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");

if ( isset( $_GET[ 'insid' ] ) )

	$keyvalue = $_GET[ 'insid' ];

else

	$keyvalue = 0;

	



if ( isset( $_GET[ 'action' ] ) )

	$action = addslashes( trim($_GET['action']) );

else

	$action = "";

if ( isset( $_POST[ 'submit' ] ) ) {

	

$districtid =  $_POST['districtid'];			

$ngoid =  $_POST['ngoid'];

$ulbid =  $_POST['ulbid'];
$upload_image =  $_POST['upload_image'];
//ocation_of_shelter=$_POST['location_of_shelter'];

$extent_of_shelter=$_POST['extent_of_shelter'];

$executive_commitee=$_POST['executive_commitee'];

$date_of_formation_ec=$_POST['date_of_formation_ec'];

$noofcomplain_solved=$_POST['noofcomplain_solved'];

$executive_committee_meeting=$_POST['executive_committee_meeting'];

$noofcomplain_recieved=$_POST['noofcomplain_recieved'];	

$no_inmates=$_POST['no_inmates'];

$ngoid=$_POST['ngoid'];		

$male_aged_people_no =  $_POST['male_aged_people_no'];

$male_children_no =  $_POST['male_children_no'];

$male_others_no =  $_POST['male_others_no'];

$male_differently_abled =  $_POST['male_differently_abled'];

$female_aged_people_no =  $_POST['female_aged_people_no'];

$female_children_no =  $_POST['female_children_no'];

$female_others_no =  $_POST['female_others_no'];

$female_differently_abled =  $_POST['female_differently_abled'];

$cleaning_of_room=$_POST['cleaning_of_room'];			       

$cleaning_of_bathroom=$_POST['cleaning_of_bathroom'];   

$bank_account_formed=$_POST['bank_account_formed'];  

$fund_out_flow=$_POST['fund_out_flow'];   

$fund_in_flow=$_POST['fund_in_flow'];     

$festivals_org=$_POST['festivals_org'];     

$project_work_students=$_POST['project_work_students'];                  

$orientation_per_month=$_POST['orientation_per_month'];                 

$dpr_status=$_POST['dpr_status'];  

$suggestions_of_inmates=$_POST['suggestions_of_inmates'];

$overall_remarks=$_POST['overall_remarks'];	

$registername =  $_POST['registername'];

$register_type =  $_POST['register_type'];

$ameniti_type =  $_POST['ameniti_type'];

$amenitiename =  $_POST['amenitiename'];

$no_of_resident =  $_POST['no_of_resident'];

$no_of_available =  $_POST['no_of_available'];

$remark =  $_POST['remark'];

$no_of_organized =  $_POST['no_of_organized'];

$corpus_account =  $_POST['corpus_account'];

$inspection_date =  $_POST['inspection_date'];

$imgname= $_FILES['imgname'];

$itemname =  $_POST['itemname'];

$available =  $_POST['available'];

$amenitieid =  $_POST['amenitieid'];

//$ngoid =  $_POST['ngoid'];

$third_aged_people_no =  $_POST['third_aged_people_no'];

$third_children_no =  $_POST['third_children_no'];

$third_others_no =  $_POST['third_others_no'];

$third_differently_abled =  $_POST['third_differently_abled'];
$designation =  $_POST['designation'];


		if ( $keyvalue == 0 ) {
			$upload_image_filename = uploadImage($imgpath,$upload_image);	
		  //  echo "insert into inspection_details set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',executive_commitee='$executive_commitee',date_of_formation_ec='$date_of_formation_ec',noofcomplain_solved='$noofcomplain_solved',executive_committee_meeting='$executive_committee_meeting',noofcomplain_recieved='$noofcomplain_recieved',no_inmates='$no_inmates',male_aged_people_no='$male_aged_people_no',male_children_no='$male_children_no',male_others_no='$male_others_no',male_differently_abled='$male_differently_abled',female_aged_people_no='$female_aged_people_no',female_children_no='$female_children_no',female_others_no='$female_others_no',female_differently_abled='$female_differently_abled',cleaning_of_room='$cleaning_of_room',cleaning_of_bathroom='$cleaning_of_bathroom',bank_account_formed='$bank_account_formed',fund_out_flow='$fund_out_flow',fund_in_flow='$fund_in_flow',festivals_org='$festivals_org',project_work_students='$project_work_students',orientation_per_month='$orientation_per_month',dpr_status='$dpr_status',suggestions_of_inmates='$suggestions_of_inmates',overall_remarks='$overall_remarks',corpus_account='$corpus_account',inspection_date='$inspection_date',third_aged_people_no='$third_aged_people_no',third_children_no='$third_children_no',third_others_no='$third_others_no',third_differently_abled='$third_differently_abled',userid='$loginid',inspection_officer='$_POST[inspection_officer]'";die;

	mysqli_query($connection,"insert into inspection_details set stateid='$stateid',designation='$designation',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',executive_commitee='$executive_commitee',date_of_formation_ec='$date_of_formation_ec',noofcomplain_solved='$noofcomplain_solved',executive_committee_meeting='$executive_committee_meeting',noofcomplain_recieved='$noofcomplain_recieved',no_inmates='$no_inmates',male_aged_people_no='$male_aged_people_no',male_children_no='$male_children_no',male_others_no='$male_others_no',male_differently_abled='$male_differently_abled',female_aged_people_no='$female_aged_people_no',female_children_no='$female_children_no',female_others_no='$female_others_no',female_differently_abled='$female_differently_abled',cleaning_of_room='$cleaning_of_room',cleaning_of_bathroom='$cleaning_of_bathroom',bank_account_formed='$bank_account_formed',fund_out_flow='$fund_out_flow',fund_in_flow='$fund_in_flow',festivals_org='$festivals_org',project_work_students='$project_work_students',orientation_per_month='$orientation_per_month',dpr_status='$dpr_status',suggestions_of_inmates='$suggestions_of_inmates',overall_remarks='$overall_remarks',corpus_account='$corpus_account',inspection_date='$inspection_date',third_aged_people_no='
	$third_aged_people_no',third_children_no='$third_children_no',upload_image='$upload_image_filename',third_others_no='$third_others_no',third_differently_abled='$third_differently_abled',userid='$loginid',inspection_officer='$_POST[inspection_officer]'");

	

	$lastid = mysqli_insert_id($connection);

	$uploaded_filename = uploadImage($imgpath,$imgname);			

			mysqli_query($connection,"update inspection_details set imgname='$uploaded_filename' where insid='$lastid'");	

	 $totreg = count($registername);	

	for ($x = 0; $x < $totreg; $x++) {	



	mysqli_query($connection,"insert into save_register_type_inspection set insid='$lastid',registername='$registername[$x]',register_type='$register_type[$x]',no_of_organized='$no_of_organized[$x]',remark='$remark[$x]'");

	}

	

$totam = count($amenitiename);	

	for ($i = 0; $i < $totam; $i++) {	

	

	mysqli_query($connection,"insert into save_amenities_inspection set insid='$lastid',amenitiename='$amenitiename[$i]',ameniti_type='$ameniti_type[$i]',no_of_resident='$no_of_resident[$i]',no_of_available='$no_of_available[$i]'");

	}

	//check Duplicate

	

	$totki = count($itemname);	

	for ($k = 0; $k < $totki; $k++) {	

	

	mysqli_query($connection,"insert into  save_kichen_ins set insid='$lastid',kitemname='$itemname[$k]',available='$available[$k]',amenitieid='$amenitieid[$k]'");

	} 

	$action=1;

		}

		else

		{

	

			mysqli_query($connection,"update inspection_details set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',designation='$designation',executive_commitee='$executive_commitee',date_of_formation_ec='$date_of_formation_ec',noofcomplain_solved='$noofcomplain_solved',executive_committee_meeting='$executive_committee_meeting',noofcomplain_recieved='$noofcomplain_recieved',no_inmates='$no_inmates',male_aged_people_no='$male_aged_people_no',male_children_no='$male_children_no',male_others_no='$male_others_no',male_differently_abled='$male_differently_abled',female_aged_people_no='$female_aged_people_no',female_children_no='$female_children_no',female_others_no='$female_others_no',female_differently_abled='$female_differently_abled',cleaning_of_room='$cleaning_of_room',cleaning_of_bathroom='$cleaning_of_bathroom',bank_account_formed='$bank_account_formed',fund_out_flow='$fund_out_flow',fund_in_flow='$fund_in_flow',festivals_org='$festivals_org',project_work_students='$project_work_students',orientation_per_month='$orientation_per_month',dpr_status='$dpr_status',suggestions_of_inmates='$suggestions_of_inmates',overall_remarks='$overall_remarks',corpus_account='$corpus_account',inspection_date='$inspection_date',third_aged_people_no='$third_aged_people_no',third_children_no='$third_children_no',third_others_no='$third_others_no',third_differently_abled='$third_differently_abled',userid='$loginid',inspection_officer='$_POST[inspection_officer]' where insid = '$keyvalue'");

	

mysqli_query($connection,"delete from save_register_type_inspection where insid = '$keyvalue'");

mysqli_query($connection,"delete from save_amenities_inspection where insid = '$keyvalue'");

mysqli_query($connection,"delete from save_kichen_ins where insid = '$keyvalue'");

		

			if($_FILES['imgname']['tmp_name']!="")

				{
					//delete old file
					 $rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"insid = '$keyvalue'"));
					 $oldimg = $rowimg["imgname"];
					if($oldimg != "")
					unlink("uploaded/inspection/$oldimg");
					//insert new file
					$uploaded_filename = uploadImage($imgpath,$imgname);	
					//echo "update inspection_details set imgname='$uploaded_filename' where insid='$keyvalue'";die;
					mysqli_query($connection,"update inspection_details set imgname='$uploaded_filename' where insid='$keyvalue'");
				}

			
				if($_FILES['imgname']['upload_image']!="")

				{
					//delete old file
					 $rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"insid = '$keyvalue'"));
					 $oldimg = $rowimg["upload_image"];
					if($oldimg != "")
					unlink("uploaded/inspection/$oldimg");
					//insert new file
					$upload_image_filename = uploadImage($imgpath,$imgname);	
					//echo "update inspection_details set imgname='$uploaded_filename' where insid='$keyvalue'";die;
					mysqli_query($connection,"update inspection_details set upload_image='$upload_image_filename' where insid='$keyvalue'");
				}
			

	 $totreg = count($registername);	

	for ($x = 0; $x < $totreg; $x++) {	



	mysqli_query($connection,"insert into save_register_type_inspection set insid='$keyvalue',registername='$registername[$x]',register_type='$register_type[$x]',no_of_organized='$no_of_organized[$x]',remark='$remark[$x]'");

	}

	

$totam = count($amenitiename);	

	for ($i = 0; $i < $totam; $i++) {	

	

	mysqli_query($connection,"insert into save_amenities_inspection set insid='$keyvalue',amenitiename='$amenitiename[$i]',ameniti_type='$ameniti_type[$i]',no_of_resident='$no_of_resident[$i]',no_of_available='$no_of_available[$i]'");

	}

	//check Duplicate

	

	$totki = count($itemname);	

	for ($k = 0; $k < $totki; $k++) {	

	

	mysqli_query($connection,"insert into  save_kichen_ins set insid='$keyvalue',kitemname='$itemname[$k]',available='$available[$k]',amenitieid='$amenitieid[$k]'");

	} 

		$action=2;	

		}

// 		echo "<script>location='$pagename?action=$action'</script>";



}

if (isset($_GET[$tblpkey])){

//$btn_name = "Update";

//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;

$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";

$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );

$districtid =  $rowedit['districtid'];			

$ngoid =  $rowedit['ngoid'];
$designation =  $rowedit['designation'];

$ulbid =  $rowedit['ulbid'];

//ocation_of_shelter=$rowedit['location_of_shelter'];

$extent_of_shelter=$rowedit['extent_of_shelter'];

$executive_commitee=$rowedit['executive_commitee'];

 $date_of_formation_ec=$rowedit['date_of_formation_ec'];

$noofcomplain_solved=$rowedit['noofcomplain_solved'];

$executive_committee_meeting=$rowedit['executive_committee_meeting'];

$noofcomplain_recieved=$rowedit['noofcomplain_recieved'];	

$no_inmates=$rowedit['no_inmates'];

//$ngoid=$rowedit['ngoid'];		

$male_aged_people_no =  $rowedit['male_aged_people_no'];

$male_children_no =  $rowedit['male_children_no'];

$male_others_no =  $rowedit['male_others_no'];

$male_differently_abled =  $rowedit['male_differently_abled'];

$female_aged_people_no =  $rowedit['female_aged_people_no'];

$female_children_no =  $rowedit['female_children_no'];

$female_others_no =  $rowedit['female_others_no'];

$female_differently_abled =  $rowedit['female_differently_abled'];

$cleaning_of_room=$rowedit['cleaning_of_room'];			       

$cleaning_of_bathroom=$rowedit['cleaning_of_bathroom'];   

$bank_account_formed=$rowedit['bank_account_formed'];  

$fund_out_flow=$rowedit['fund_out_flow'];   

$fund_in_flow=$rowedit['fund_in_flow'];     

$festivals_org=$rowedit['festivals_org'];     

$project_work_students=$rowedit['project_work_students'];                  

 $orientation_per_month=$rowedit['orientation_per_month'];                 

$dpr_status=$rowedit['dpr_status'];  

$suggestions_of_inmates=$rowedit['suggestions_of_inmates'];

$overall_remarks=$rowedit['overall_remarks'];	

$registername =  $rowedit['registername'];

$register_type =  $rowedit['register_type'];

$ameniti_type =  $rowedit['ameniti_type'];

$amenitiename =  $rowedit['amenitiename'];

$no_of_resident =  $rowedit['no_of_resident'];

$no_of_available =  $rowedit['no_of_available'];

$remark =  $rowedit['remark'];

$no_of_organized =  $rowedit['no_of_organized'];

$corpus_account =  $rowedit['corpus_account'];

$inspection_date =  $rowedit['inspection_date'];

$imgname= $rowedit['imgname'];

$itemname =  $rowedit['itemname'];

$available =  $rowedit['available'];

$amenitieid =  $rowedit['amenitieid'];

$ngoid =  $rowedit['ngoid'];

$third_aged_people_no =  $rowedit['third_aged_people_no'];

$third_children_no =  $rowedit['third_children_no'];

$third_others_no =  $rowedit['third_others_no'];

$third_differently_abled =  $rowedit['third_differently_abled'];

$inspection_officer=$rowedit['inspection_officer'];

} else {

$districtid = '';			

$ngoid = '';

$ulbid = '';

//ocation_of_shelter=$rowedit['location_of_shelter'];

$extent_of_shelter='';

$executive_commitee='';

$date_of_formation_ec = date('d-m-Y');

$noofcomplain_solved='';

$executive_committee_meeting='';

$noofcomplain_recieved='';	



//$no_inmates='';

//$ngoid=$rowedit['ngoid'];		





				$male_children_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 0 AND 14 and gender='Male' and userid='$loginid'");

				$female_children_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 0 AND 14 and gender='Female' and userid='$loginid'");

				$third_children_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 0 AND 14 and gender='Third Gender' and userid='$loginid'");

				

				$male_aged_people_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 15 AND 59 and gender='Male' and userid='$loginid'");

				$female_aged_people_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 15 AND 59 and gender='Female' and userid='$loginid'");

				$third_aged_people_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 15 AND 59 and gender='Third Gender' and userid='$loginid'");

				

				$male_others_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 60 AND 100 and gender='Male' and userid='$loginid'");

				$female_others_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 60 AND 100 and gender='Female' and userid='$loginid'");

				$third_others_no=$cmn->getvalfield($connection,"personal_details","count(id)","age BETWEEN 60 AND 100 and gender='Third Gender' and userid='$loginid'");

				

				$male_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Male' and userid='$loginid'");

				$female_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Female' and userid='$loginid'");

				$third_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Third Gender' and userid='$loginid'");

				

				

				

				$male_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Male' and userid='$loginid'");

				$female_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Female' and userid='$loginid'");

				$third_differently_abled=$cmn->getvalfield($connection,"personal_details","count(id)","differently_abled='Yes' and gender='Third Gender' and userid='$loginid'");

				

				





$cleaning_of_room='';			       

$cleaning_of_bathroom='';   

$bank_account_formed='';  

$fund_out_flow='';   

$fund_in_flow='';     

$festivals_org='';     

$project_work_students='';                  

$orientation_per_month='';                 

$dpr_status='';  

$suggestions_of_inmates='';

$overall_remarks='';	

$registername = '';

$register_type = '';

$ameniti_type ='';

$amenitiename = '';

$no_of_resident = '';

$no_of_available ='';

$remark =  '';

$no_of_organized = '';

$corpus_account = '';

$inspection_date = date('d-m-Y');

$itemname ='';

$available =  '';

$amenitieid ='';

$ngoid =  '';

$inspection_officer='';
$designation='';

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



     <div class="wrapper">



         <?php  include("inc/alerts.php");?>



         <div class="container-fluid">









             <div class="row">

                 <div class="col-md-12">

                     <div class="card mt-12">

                         <div class="card-header">

                             <h4 class="card-title">Inspection Details Entry</h4><a href="inspection_details_list.php"
                                 class="btn btn-info" style="float:right;">Show List</a>





                         </div>



                         <div class="table-responsive">

                             <form name="addServiceForm" method="post" action="" enctype="multipart/form-data">

                                 <table class="table table-bordered table-striped">

                                     <tr>

                                         <th style="width: 20%;">District Name</th>
                                         <td>
                                             <?php if($usertype=='SHELTER'){ ?>
                                             <input type="hidden" name="districtid" value="<?php echo $districtid; ?>"
                                                 id="contatct_person" class="form-control" autocomplete="off">

                                             <input type="text" name="district" value="<?php echo $district; ?>"
                                                 id="district" readonly class="form-control" autocomplete="off">

                                             <?php } else { ?>
                                             <select required name="districtid" id="districtid"
                                                 onChange="getulb();getshelter();" class="form-control">
                                                 <option value="">-- Select District--</option>
                                                 <?php $dist=mysqli_query($connection,"SELECT * FROM m_district $condata order by districtname asc");
													while($data=mysqli_fetch_array($dist)){
												 ?>
                                                 <option value="<?php echo $data['districtid']; ?>">
                                                     <?php echo ucfirst(strtolower($data['districtname'])); ?></option>
                                                 <?php } ?>
                                             </select>
                                             <script>
                                             document.getElementById('districtid').value = '<?php echo $districtid; ?>';
                                             </script>
                                             <?php }?>
                                         </td>
                                         </td>
                                         <th style="width: 20%;">ULB Name </th>
                                         <td style="width: 25%;">
                                             <?php if($usertype=='SHELTER') { ?>
                                             <input type="hidden" name="ulbid" value="<?php echo $ulbid; ?>" id="ulbid"
                                                 class="form-control" autocomplete="off">
                                             <input type="text" name="ulbname" value="<?php echo $ulbname; ?>"
                                                 id="ulbname" readonly class="form-control" autocomplete="off">
                                             <?php } else { ?>
                                             <select required name="ulbid" id="ulbid" onChange="getshelter();"
                                                 class="form-control">
                                                 <option value="">-- Select --</option>
                                                 <?php $dist=mysqli_query($connection,"select * from ulb_master $condata order by ulbname asc");
													while($data=mysqli_fetch_array($dist)){?>
                                                 <option value="<?php echo $data['ulbid']; ?>">
                                                     <?php echo ucfirst(strtolower($data['ulbname'])); ?></option>
                                                 <?php } ?>
                                             </select>
                                             <script>
                                             document.getElementById('ulbid').value = '<?php echo $ulbid; ?>';
                                             </script>

                                             <?php }?>
                                             <div id="nor">
                                             </div>
                                         </td>
                                     </tr>
                                     <tr>

                                         <th style="width: 20%;">Shelter Name</th>



                                         <td style="width: 25%;">

                                             <?php if($usertype=='SHELTER') { ?>

                                             <input type="hidden" name="ngoid" value="<?php echo $ngoid; ?>" id="ngoid"
                                                 class="form-control" autocomplete="off">

                                             <input type="text" name="ngo" value="<?php echo $ngo; ?>" id="ngo" readonly
                                                 class="form-control" autocomplete="off">



                                             <?php } else { ?>



                                             <select name="ngoid" id="ngoid" required class="form-control"
                                                 onChange="getdetails(this.value);">

                                                 <option value="">-Select Shelter Name-</option>

                                                 <?php 

											$sql1 = "select distinct ngoname,ngoid from m_ngo $condata order by ngoname asc";

											$res1 = mysqli_query($connection,$sql1);

											while($row1 = mysqli_fetch_array($res1)){ ?>

                                                 <option value="<?php echo $row1['ngoid']; ?>">
                                                     <?php echo $row1['ngoname']; ?></option>

                                                 <?php	} ?>

                                             </select>

                                             <script>
                                             document.getElementById('ngoid').value = '<?php echo $ngoid; ?>';
                                             </script>
                                             <?php }?>
                                         </td>
                                         <th> Inspection Officer Name </th>

                                         <td>
                                             <input type="text" name="inspection_officer" id="inspection_officer"
                                                 value='<?php echo $inspection_officer;?>' autocomplete="off" required
                                                 class="form-control">
                                         </td>
                                     </tr>
                                     <tr>

                                         <th style="width: 20%;">Date of Inspection</th>

                                         <td style="width: 25%;"> <input type="date"
                                                 onKeyUP="this.value = this.value.toUpperCase();" name="inspection_date"
                                                 id="inspection_date" value="<?php echo $inspection_date;?>"
                                                 class="form-control" autocomplete="off"></td>



                                         <th>Officer Designation</th>

                                         <td><input type="text" name="designation" value="<?php echo $designation;?>"
                                                 autocomplete="off" id="designation" class="form-control datePicker "
                                                 required></td>
                                     </tr>
                                     <tr>
                                         <th style="width: 20%;">Upload Image</th>
                                         <td style="width: 25%;"> <input type="file"
                                                 name="upload_image"
                                                 id="upload_image" 
                                                 class="form-control" autocomplete="off"></td>
                                     </tr>

                                     <tr>

                                         <td align="center" colspan="4">

                                             <input type="submit" name="submit" value="Submit"
                                                 style="width:200px; float:none;" class="site-btn">
                                         </td>
                                     </tr>
                                 </table>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- end container -->
     </div>
     <?php include("inc/footer.php"); ?>
     <script>
     function getdetails(ngoid)
     {
         jQuery.ajax({

             type: 'POST',

             url: 'getngodetails.php',

             data: "ngoid=" + ngoid,

             dataType: 'html',

             success: function(data) {

                 // 		alert(data);



                 var jsonobj = jQuery.parseJSON(data);

                 //$( "#shelter_type option:selected" ).text(jsonobj.s_type);					



                 jQuery('#no_inmates').val(jsonobj.design_capacity);





                 //jQuery('#showdatarecord').html(data);					



             }

         }); //ajax close

     }

     function getshelter() {



         var districtid = jQuery("#districtid").val();

         var ulbid = jQuery("#ulbid").val();

         //alert(districtid);   

         jQuery.ajax({

             type: 'POST',

             url: 'getngo.php',

             data: "districtid=" + districtid + '&ulbid=' + ulbid,

             dataType: 'html',

             success: function(data) {

                 //	alert(data);







                 jQuery('#ngoid').html(data); //

                 //jQuery('#showdatarecord').html(data);					



             }

         }); //ajax close

     }



     function getulb() {

         //alert('hello');

         var districtid = jQuery("#districtid").val();

         //alert(districtid);   

         jQuery.ajax({

             type: 'POST',

             url: 'getulb.php',

             data: "districtid=" + districtid,

             dataType: 'html',

             success: function(data) {

                 jQuery('#ulbid').html(data);





                 //jQuery('#showdatarecord').html(data);					



             }

         }); //ajax close

     }

     function getKichan(avail, amenitiename)
     {
         if (amenitiename == 'KITCHEN' && avail == 'Yes') {
             jQuery("#kichendata").show();
         } else
         {
             jQuery("#kichendata").hide();
         }
     }
     function getdistrict() {
         //alert('hello');
         var stateid = jQuery("#stateid").val();

         jQuery.ajax({
             type: 'POST',
             url: 'getdistrict.php',
             data: "stateid=" + stateid,
             dataType: 'html',
             success: function(data) {
                 jQuery('#districtid').html(data);
             }

         }); //ajax close

     }



     function getmunicipal() {

         //alert('hello');

         var districtid = jQuery("#districtid").val();

         //alert(districtid);   

         jQuery.ajax({

             type: 'POST',

             url: 'getmunicipal.php',

             data: "districtid=" + districtid,

             dataType: 'html',

             success: function(data) {

                 //alert(data);



                 jQuery('#corpmunicipal_id').html(data); //

                 //jQuery('#showdatarecord').html(data);					



             }

         }); //ajax close

     }

     function getpanchayat() {

         //alert('hello');

         var districtid = jQuery("#districtid").val();

         //alert(districtid);   

         jQuery.ajax({

             type: 'POST',

             url: 'getpanchayat.php',

             data: "districtid=" + districtid,

             dataType: 'html',

             success: function(data) {

                 //alert(data);



                 jQuery('#panchayat_id').html(data); //

                 //jQuery('#showdatarecord').html(data);					



             }

         }); //ajax close

     }

     function getngo() {

         //alert('hello');

         var districtid = jQuery("#districtid").val();

         //alert(districtid);   

         jQuery.ajax({

             type: 'POST',

             url: 'getngo.php',

             data: "districtid=" + districtid,

             dataType: 'html',

             success: function(data) {

                 //alert(data);



                 jQuery('#ngoid').html(data); //

                 //jQuery('#showdatarecord').html(data);					



             }

         }); //ajax close

     }





     function showhide(s_type)

     {

         //var s_type=jQuery("#s_type").val();



         if (s_type == 'Normal') {



             jQuery("#Normal").show();

         } else

         {

             jQuery("#Normal").hide();

         }

     }



     function hideShowCorpus(bank_account_formed)

     {



         if (bank_account_formed == 'Yes') {



             jQuery("#showac").show();

         } else

         {

             jQuery("#showac").hide();

         }





     }
     </script>



 </body>



 </html>