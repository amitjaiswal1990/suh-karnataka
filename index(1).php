<?php
include("dbconnect.php");
$tblname = 'dailyreport';
$tblpkey = 'reportid';
$pagename = 'index.php';
$module = "Master";
$submodule = "Daily Report";
$work_date =date('d-m-Y');
//echo $loginid;
if(isset($_GET['action']))
$action = $_GET['action'];
else
$action = 0;
// echo $_GET['reportid'];
$enable='enable';
if(isset($_GET['reportid']))
$reportid =  $_GET['reportid'];
else
$reportid = 0;


if(isset($_POST['submit']))
{  
    $reportid = trim(addslashes($_REQUEST['reportid'])); 
    $id = trim(addslashes($_REQUEST['id']));
	$work_date   =  $cmn->dateformatusa($_POST['work_date']);
	$start_time   =  $_POST['start_time'] ? $_POST['start_time'] : NULL;
	$end_time   =  $_POST['end_time'] ? $_POST['end_time'] : NULL;
	$activity        =  $_POST['activity'] ? $_POST['activity'] : NULL;
	$totcount        =  $_POST['totcount'] ? $_POST['totcount'] : NULL;
	$file_saved_at        =  $_POST['file_saved_at'] ? $_POST['file_saved_at'] : NULL;
	$project_status        =  $_POST['project_status'] ? $_POST['project_status'] : NULL;
	$email_recieved        =  $_POST['email_recieved'] ? $_POST['email_recieved'] : NULL;
	$email_sent        =  $_POST['email_sent'] ? $_POST['email_sent'] : NULL;
	$email_for        =  $_POST['email_for'] ? $_POST['email_for'] : NULL;
	$taskstatus        =  $_POST['taskstatus'] ? $_POST['taskstatus'] : NULL;
	
	if($_POST['enable']=='')
	$enable = 'enable';
	else
	$enable = $_POST['enable'];
	
	
	
	
		
		$form_data = array('work_date'=>$work_date,'loginid'=>$loginid,'id'=>$id,'start_time'=>$start_time,'end_time'=>$end_time,'activity'=>$activity,'totcount'=>$totcount,'file_saved_at'=>$file_saved_at,'project_status'=>$project_status,'email_recieved'=>$email_recieved,'email_sent'=>$email_sent,'email_for'=>$email_for,'taskstatus'=>$taskstatus,'usertype'=>'user','enable'=>$enable,'createdby'=>$userid,'ipaddress'=>$ipaddress,'createdate'=>$createdate);
		   if($reportid == 0)
		   {   
				  $res = $cmn->dbRowInsert($database_link_for_connection,$tblname, $form_data);
				  $action=1;
				  $keyvalue = mysqli_insert_id();
				  $process = "insert";
			}
			else
			{   
			
					$cmn->dbRowUpdate($database_link_for_connection,$tblname, $form_data,"WHERE reportid = '$reportid'");
					$action=2;
					$keyvalue = $reportid ;
					$process = "updated";
			  
			}
			 $cmn->InsertLog($database_link_for_connection,$pagename, $module, $submodule, $tblname, $tblpkey, $keyvalue, $process);
			 echo "<script>location='$pagename?action=$action'</script>";
		  }


if($reportid!=0)
{
	$sqledit      = "SELECT * from $tblname where $tblpkey = '$reportid'";
	$rowedit      = mysqli_fetch_array(mysqli_query($database_link_for_connection,$sqledit));	
	$tablekeyval = $rowedit['reportid'];
	$work_date   = $cmn->dateformatindia($rowedit['work_date']);
	$loginid   = $rowedit['loginid'];
	$id   = $rowedit['id'];
	$start_time   = $rowedit['start_time'];
	$end_time   = $rowedit['end_time'];
	$activity        = $rowedit['activity'];
	$totcount = $rowedit['totcount'];
	$file_saved_at = $rowedit['file_saved_at'];
	$project_status = $rowedit['project_status'];
	$email_recieved = $rowedit['email_recieved'];
	$email_sent = $rowedit['email_sent'];
	$email_for  = $rowedit['email_for'];
	$taskstatus =  $rowedit['taskstatus'];
	
	$enable        = $rowedit['enable'];
}

?>
<!DOCTYPE html>
<html lang="en">
			<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="">
			<meta name="author" content="Dashboard">
			<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
			<?php include("head.php") ?>
			</head>

			<body>
<section id="container" >
<!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** --> 
<!--header start-->
<header class="header black-bg">
              <?php include("header.php") ?>
            </header>
<!--header end--> 

<!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** --> 
<!--sidebar start-->
<aside>
<!-- sidebar menu start-->
<?php include("spanel.php") ?>
<!-- sidebar menu end-->
</aside>
<!--sidebar end--> 

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** --> 
<!--main content start-->
<section id="main-content">
              <section class="wrapper site-min-height">
    <?php include("../include/alerts.php"); ?>
    <h3><i class="fa"></i><?php echo $submodule ; ?></h3>
    <div class="row mt">
                  <div class="col-lg-12">
        <div class="form-panel">
                      <form method="post" action="">
            <div class="form-group">
                          <div class="col-md-3">
                <label> <strong>Project Name</strong> </label>
                <select class="form-control " style="width:250px;" name="id" id="id" onChange="getusertype(this.value);" required>
                              <option value="">-Select Project-</option>
                              <?php 
								  $sql=mysqli_query($database_link_for_connection,"select * from project_details order by project asc");
								  while($row=mysqli_fetch_assoc($sql))
								  {
								  ?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['project']." (".$row['project_id'].")"; ?></option>
                              <?php
								  }								  
								  ?>
                            </select>
                <script> document.getElementById('id').value='<?php echo $id; ?>'; </script> 
              </div>
                          <div class="col-md-3">
                <label> <strong>Todays Date</strong> </label>
                <input class="form-control" type="text" readonly  name="work_date" id="work_date" value="<?php echo $work_date; ?>" maxlength="50" />
              </div>
                          <div class="col-md-3">
                <label> <strong>Start Time</strong> </label>
                <input class="form-control" type="time" name="start_time" id="start_time" value="<?php echo $start_time; ?>" />
              </div>
                          <div class="col-md-3">
                <label> <strong>End time</strong> </label>
                <input class="form-control" type="time" name="end_time" id="end_time" value="<?php echo $end_time; ?>"/>
              </div>
              <div class="col-md-3">
                <label> <strong>Activity</strong> </label>
                <select name="activity" class="form-control">
                <option value="">Select Activity</option>
                <option value="Downloading">Downloading</option>
                <option value="Prepare Report">Prepare Report</option>
                <option value="Survey">Survey</option>
                <option value="Digitization">Digitization</option>
                <option value="Scanning Adhar">Scanning Adhar</option>
                <option value="Scanning Form">Scanning Form</option>
                <option value="Renaming">Renaming</option>
                <option value="Cropping">Cropping</option>
                <option value="PreQC">PreQC</option>
                <option value="Final QC">Final QC</option>
                <option value="Website Development">Website Development</option>
                
                </select>
              </div>
                          
              <div class="col-md-3">
                <label> <strong>Total Count(<span style="color:#F00">Not Changable</span>)</strong> </label>
                <input class="form-control" type="number" name="totcount" id="totcount" value="<?php echo $totcount; ?>" />
              </div>
                          <div class="col-md-3">
                <label> <strong>Today Completed</strong> </label>
                <input class="form-control" type="number" name="taskstatus" id="taskstatus" value="<?php echo $taskstatus; ?>">
              </div>
              
              
              
              <div class="col-md-3">
                <label> <strong>File save at</strong> </label>
                <input class="form-control" type="text" name="file_saved_at" id="file_saved_at" max="100" value="<?php echo $file_saved_at; ?>">
              </div>
              <div class="col-md-3">
                <label> <strong>Email Recieved From</strong> </label>
                <input class="form-control" type="text" name="email_recieved" id="email_recieved" max="100" value="<?php echo $email_recieved; ?>">
              </div>
              <div class="col-md-3">
                <label> <strong>Email Sent to</strong> </label>
                <input class="form-control" type="text" name="email_sent" id="email_sent" max="100" value="<?php echo $email_sent; ?>">
              </div>
              <div class="col-md-3">
                <label> <strong>Email Subject</strong> </label>
                <input class="form-control" type="text" name="email_for" id="email_for" max="100" value="<?php echo $email_for; ?>">
              </div>
              <div class="col-md-3">
                <label> <strong>Project Status</strong> </label>
                <input class="form-control" readonly type="number" name="project_status" id="project_status" max="100"">
              </div>
                          <div class="col-md-3">
                <label style="font-weight:bold; color:#000"> </label>
                <br>
              </div>
                        </div>
            <div class="clearfix"></div>
            <div class="form-group">
                          <div class="col-sm-12">
                <input type="hidden" name="<?php echo $tblpkey;?>" id="<?php echo $tblpkey;?>" value="<?php echo $tablekeyval;?>" >
                <button type="submit" name="submit" id="submit" onClick="return checkinputmaster('work_date,start_time')" class="btn btn-primary" style="margin-top:5px">Save</button>
                <button type="button"  onClick="document.location = '<?php echo $pagename ; ?>' ;" class="btn btn-danger" style="margin-top:5px">Reset</button>
              </div>
                        </div>
            <div class="clearfix"></div>
          </form>
                    </div>
      </div>
                </div>
    <h3><i class="fa"></i><?php echo $submodule ; ?> List</h3>
    <div class="row mt">
                  <div class="col-lg-12">
        <div class="col-lg-12">
                      <div class="form-panel">
            <table id="example" class="display" style="font-size:9px" cellspacing="0" width="100%">
                          <thead>
                <tr>
                              <th>S.NO.</th>
                              <th>Date</th>
                              <th>Project ID</th>
                              <th>Project</th>
                              <th>Start time</th>
                              <th>End time</th>
                              <th>Activity</th>
                              <th>Total Count</th>
                              <th>Today Completed</th>
                            
                            
                              <th>File Saved At</th>
                             <th>Email Recieved</th>
                             <th>Email Sent</th>
                             <th>Email Subject</th>
                             <th>Project Status</th>
                              <th>Deadline</th>
                              <th>Edit</th>
                            </tr>
              </thead>
                          <tbody>
                <?php
				  
									$slno=1;
									$sql = mysqli_query($database_link_for_connection,"select * from dailyreport where loginid='$loginid' order by reportid DESC");
									while($row=mysqli_fetch_assoc($sql))
									{
										$empname = $cmn->getvalfield($database_link_for_connection,"login_details","username","loginid='$row[loginid]'");
										$projectname = $cmn->getvalfield($database_link_for_connection,"project_details","project","id='$row[id]'");
										 $projectid = $cmn->getvalfield($database_link_for_connection,"project_details","project_id","id='$row[id]'");
										$deadline = $cmn->getvalfield($database_link_for_connection,"work_assign","deadline","id='$row[id]'");
										$cdate= $cmn->dateformatindia($row['work_date']);
										$ddate=$cmn->dateformatindia($deadline);
										 ?>
                <tr>
                              <th><?php echo $slno++;?></th>
                              <th><?php echo $cmn->dateformatindia($row['work_date']);?></th>
                              <th><?php echo $projectid;?></th>
                              <th><?php echo $projectname;?></th>
                              <th><?php echo $row['start_time'];?></th>
                              <th><?php echo $row['end_time'];?></th>
                              <th><?php echo $row['activity'];?></th>
                               <th><?php echo $row['totcount'];?></th>
                               <th><?php echo $row['taskstatus'];?></th>
                            <th><?php echo $row['file_saved_at'];?></th>
                            
                            <th><?php echo $row['email_recieved'];?></th>
                            <th><?php echo $row['email_sent'];?></th>
                            <th><?php echo $row['email_for'];?></th>
                            <th><?php echo $row['project_status'];?></th>
                              <th><?php if($ddate<=$work_date){
                  					?> <font color="red"><?php echo $ddate ;?></font>
                    		 <?php } else {?>
						  <font color="green"><?php 
						  echo $ddate ;}?></font></th>
                              <th> <?php 
						  if($cdate==$work_date){?>
                    <a href="index.php?reportid=<?php echo $row['reportid']?>"> edit</a>
                    <?php } else
						    echo " ";?>
                  </th>
                            </tr>
                <?php	}
									?>
              </tbody>
                        </table>
          </div>
                    </div>
      </div>
                </div>
  </section>
            </section>

<!--main content end--> 
<!--footer start-->
<footer class="site-footer">
              <?php include("footer.php") ?>
            </footer>
<!--footer end-->
</section>
<script>
	function funDel(id)
	{  //alert(id);   
		  tblname = '<?php echo $tblname; ?>';
		  tblpkey = '<?php echo $tblpkey; ?>';
		  submodule = '<?php echo $submodule; ?>';
		  pagename = '<?php echo $pagename; ?>';
		  module = '<?php echo $module; ?>';
		 // alert(tblpkey); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			$.ajax({
			  type: 'POST',
			  url: '../ajax/delete_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				 // alert(data);
				 // alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
			
			  });//ajax close
		}//confirm close
	} //fun close

  </script>
</body>
</html>
