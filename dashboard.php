<?php include("adminsession.php");

  $currentdate=date('Y-m-d');

  $firstdate=date('Y-m-1');

//   eho $firstdate=date('Y-m-1');die;

     $lastmonth = date('Y-m-1',strtotime("-1 month"));

     $yesterdaydate = date('Y-m-d',strtotime("-1 days"));

$previousmonthdayfirst= date("Y-n-j", strtotime("first day of previous month"));

$previousmonthdaylast= date("Y-n-j", strtotime("last day of previous month"));

//echo $conuser1;die;

$totstate = $cmn->getvalfield($connection,"m_state","count(stateid)","1=1");

$totdist = $cmn->getvalfield($connection,"m_district","count(districtid)","$condata2");

//$totcorpo = $cmn->getvalfield($connection,"m_corpmunicipal","count(corpmunicipal_id)","1=1");

//$tottown = $cmn->getvalfield($connection,"m_townpanchayat","count(panchayat_id)","1=1");

$totulb = $cmn->getvalfield($connection,"ulb_master","count(ulbid)","$condata2");

$totngoid = $cmn->getvalfield($connection,"m_ngo","count(ngoid)","$condata1");



//echo $condata1;die;



//$totispection = $cmn->getvalfield($connection,"inspection_details","count(insid)","1=1");





$totshelter = $cmn->getvalfield($connection,"m_ngo","count(ngoid)","$condata1");

$totdesign_capacity = $cmn->getvalfield($connection,"m_ngo","sum(design_capacity)","$condata1");
$totdesign_capacity_male = $cmn->getvalfield($connection,"m_ngo","sum(men)","$condata1");
$totdesign_capacity_female = $cmn->getvalfield($connection,"m_ngo","sum(women)","$condata1");
$totrapid = $cmn->getvalfield($connection,"rapidsurvey","count(surveyid)","$conuser1  and conductdate BETWEEN '$firstdate' AND '$currentdate'  and (men1>0 || women1>0 || children1>0 || PWP1>0) ");

$totthirdparty = $cmn->getvalfield($connection,"thirdpartysurey","count(surveyid)","$conuser1  and conductdate BETWEEN '$firstdate' AND '$currentdate' ");





$totmedical = $cmn->getvalfield($connection,"medical_camp","count(medid)","$conuser1  and camp_date BETWEEN '$firstdate' AND '$currentdate'");

// $totoccupa = $cmn->getvalfield($connection,"attendance_details","count(aid)","$conuser1 and atten_date='$currentdate'");

$totperson = $cmn->getvalfield($connection,"attendance_details","count(distinct(ngoid))","$conuser1 and atten_date='$currentdate'");



$pre_totmedical = $cmn->getvalfield($connection,"medical_camp","count(medid)","$conuser1  and camp_date BETWEEN '$previousmonthdayfirst' AND '$previousmonthdaylast'");

 $pre_totoccupa = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$yesterdaydate'");

 $totoccupa = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$currentdate'  ");

// $pre_totoccupa = $cmn->getvalfield($connection,"attendance_details","count(aid)","$conuser1 and atten_date='$yesterdaydate'");

 

   $todaymale = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$currentdate' and personal_details.gender='Male' and personal_details.age > 14");

   $yesterdaymale = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$yesterdaydate' and personal_details.gender='Male' and personal_details.age > 14 ");

  

  

   

  //Female

   $todayfemale = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$currentdate' and personal_details.gender='Female' and personal_details.age > 14 ");

   $yesterdayfemale = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$yesterdaydate' and personal_details.gender='Female' and personal_details.age > 14 ");

  

 

$pre_totperson = $cmn->getvalfield($connection,"attendance_details","count(distinct(userid))","$conuser1 and atten_date='$yesterdaydate'");



$pre_totrapid = $cmn->getvalfield($connection,"rapidsurvey","count(surveyid)","$conuser1  and conductdate BETWEEN '$previousmonthdayfirst' AND '$previousmonthdaylast'  and (men1>0 || women1>0 || children1>0 || PWP1>0) ");

$pre_totthirdparty = $cmn->getvalfield($connection,"thirdpartysurey","count(surveyid)","$conuser1  and conductdate BETWEEN '$lastmonth' AND '$firstdate' ");

//die;



 //Third Gender

  

   $todaychildren = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$currentdate' and personal_details.age < 14  ");

   $yesterdaychildren = $cmn->getvalfield($connection,"attendance_details  LEFT JOIN personal_details ON attendance_details.pid = personal_details.id","count(id)","$conuserjoin and  attendance_details.atten_date='$yesterdaydate' and personal_details.age < 14");

  

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

  <div class="container-fluid">

    <div class="row">

      

      <div class="col-xl-3 col-md-6" style="height: 150px;">

       <a href="districtwisereport.php"> <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

            

              <h3 class="text-uppercase mb-3">Districts</h3>

              <h3 class="mb-4"><center>29</center></h3>

             </div>

          </div>

        </div>

        </a>

      </div>

     

      <div class="col-xl-3 col-md-6" style="height: 150px;">

        <a href="ulbwisereport.php"> <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

            

              <h3 class="text-uppercase mb-3">ULBs </h3>

              <h3 class="mb-4"><center>47<?php //echo $totulb;?></center></h3>

             </div>

          </div>

        </div></a>

      </div>

    <div class="col-xl-3 col-md-6" style="height: 150px;">

       <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

            

              <h3 class="text-uppercase mb-3">Shelters</h3>

               <a href="shelterwisereport.php" style="color:#FFF";> <div class="col-xl-6 col-md-6"  >Shelters : <?php echo $totshelter;?></div></a>

             <div class="col-xl-6 col-md-6" style="height: 37px;">Capacity : <?php echo $totdesign_capacity;?> </div>

            <div class="col-xl-6 col-md-6" style="height: 37px;">Male : <?php echo $totdesign_capacity_male;?> </div><div class="col-xl-6 col-md-6" style="height: 37px;">Women : <?php echo $totdesign_capacity_female;?> </div>

             </div>

          </div>

        </div>

      </div>

      

      <div class="col-xl-3 col-md-6" style="height: 150px;">

        <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

             

               <h4 class="text-uppercase mb-3">Monthly Medical Camps</h4>

                 <a href="medical_camplist.php?fromdate=<?php echo $previousmonthdayfirst;?>&todate=<?php echo $previousmonthdaylast;?>" style="color:#FFF"> <div class="col-xl-6 col-md-6"  >Last Month : <?php echo $pre_totmedical;?></div></a>

              <a href="medical_camplist.php?fromdate=<?php echo $firstdate;?>&todate=<?php echo $currentdate;?>" style="color:#FFF"><div class="col-xl-6 col-md-6" style="height: 37px;">Curr. Month : <?php echo $totmedical;?></div></a>

             

             </div>

          </div>

        </div>

      </div>

    </div>

    

    

     <div class="row">

    

      

      

       <div class="col-xl-3 col-md-6" style="height: 150px;" >

      <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white" >

            

               <h3 class="text-uppercase mb-3">Occupancy</h3>

            
<div style="overflow-y:scroll;    height: 37px;">
             <a href="yes_total_occupation.php" style="color:#FFF">   <div class="col-xl-6 col-md-6"  >Yesterday : <?php echo $pre_totoccupa;?><br>Male : <?php echo $yesterdaymale;?> <br> Female : <?php echo $yesterdayfemale;?><br> Children : <?php echo $yesterdaychildren;?></div></a>

              <a href="total_occupation.php" style="color:#FFF">   <div class="col-xl-6 col-md-6" style="height: 37px;">Today : <?php echo $totoccupa;?><br>Male : <?php echo $todaymale;?><br> Female : <?php echo $todayfemale;?><br> Children : <?php echo $todaychildren;?></div></a>
</div>
            

            

             </div>

          </div>

        </div> 

      </div>

      

       <div class="col-xl-3 col-md-6" >

        <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

            

              <h3 class="text-uppercase mb-3" ><span>Daily Report Status</span> </h3>

               <a href="yes_shelter_daily_status.php" style="color:#FFF";> <div class="col-xl-6 col-md-6"  >Yesterday : <?php echo $pre_totperson;?></div></a>

             <a href="shelter_daily_status.php" style="color:#FFF">  <div class="col-xl-6 col-md-6" style="height: 37px;">Today : <?php echo $totperson;?></div></a>

            

             

            </div>

          </div>

        </div>

      </div>

        <div class="col-xl-3 col-md-6" style="height: 150px;">

      <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

            

              <h3 class="text-uppercase mb-3">Rapid Survey (Shelter)</h3>

                <a href="pre_dashboardrapidsurveyreport.php" style="color:#FFF";> <div class="col-xl-6 col-md-6"  >Last Month : <?php echo $pre_totrapid;?></div></a>

             <a href="dashboardrapidsurveyreport.php" style="color:#FFF";>  <div class="col-xl-6 col-md-6" style="height: 37px;">Curr. Month : <?php echo $totrapid;?></div></a>

             

             </div>

          </div>

        </div>

      </div>

      

      <div class="col-xl-3 col-md-6" style="height: 150px;">

        <div class="card mini-stat bg-primary">

          <div class="card-body mini-stat-img">

            <div class="mini-stat-icon"><i class="mdi mdi-buffer float-right"></i></div>

            <div class="text-white">

            

              <h3 class="text-uppercase mb-3">Third Party Survey (ULB) </h3>

           <!--<a href="pre_dashboardthirdpartyreport.php?id=2" style="color:#FFF";>    <div class="col-xl-6 col-md-6"  >Last Month : <?php /*echo $pre_totthirdparty;*/?></div></a>-->

           <a href="Third Party Survey 2021-22.pdf" target="blank" style="color:#FFF";>    <div class="col-xl-12 col-md-12"  >Last Year 2021-22 :  7372</div></a><br><br>

             <!--<a href="dashboardthirdpartyreport.php?id=2" style="color:#FFF";> <div class="col-xl-6 col-md-6" style="height: 37px;">Curr. Month : <?php /*echo $totthirdparty;*/?></div></a>-->

              

            

             </div>

          </div>

        </div></a>

      </div>

    </div>

    

    <div class="row">

   

     

    </div>

    <!-- end row -->

    

    <!-- end row -->

    

    <!-- end row -->

    

    <!-- end row -->

  </div>

  <!-- end container-fluid -->

</div>

<?php $totthirdparty = $cmn->getvalfield($connection,"thirdpartysurey","count(surveyid)","$condata1  and conductdate BETWEEN '$firstdate' AND '$currentdate' and (men1>0 || women1>0 || children1>0 || PWP1>0) "); ?>

	</div>

	<!-- end row -->

	 <!-- Footer -->

		<?php include 'inc/footer.php'; ?>

		<!-- End Footer -->

		<!-- jQuery  -->

		

</body>



</html>