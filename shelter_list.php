<?php
error_reporting(0);
include("adminsession.php");
$pagename = "shelter_list.php";
$module = "Add Shelter Details";
$submodule = "Add Shelter Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "m_shelter";
$tblpkey = "shelter_id";
$imgpath='';
$action='';


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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
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
    <div class="container">
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title" style="float:left">Deletion Deatils</h4>
        </div>
        <div class="modal-body">
         <form>
  <div class="form-group">
    <label for="delete_date">Deletion Date</label>
    <input type="date" class="form-control" id="delete_date" value="<?php echo date('Y-m-d'); ?>" aria-describedby="delete_date" placeholder="Enter Deletion Date">
   
  </div>
  <div class="form-group">
    <label for="Reason">Reason</label>
    <input type="text" class="form-control" id="reason" placeholder="Reason">
  </div>
   <input type="text" class="form-control" id="shelter_id" placeholder="shelter_id">
 <center> <button type="button" class="btn btn-primary" onclick='funDel();'>Delete</button></center>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
    

	<div class="wrapper">
      <?php if($action==1){?> <div class="col-md-12"><h1><span style="color:#F00;">Record Inserted Successfully</span></h1></div>  <?php } ?>
		<form  method="post" action="" enctype="multipart/form-data"><div><input type="hidden" name="org.apache.struts.taglib.html.TOKEN" value="23dbbcf7349cfcf95cbba4067c3c7704"></div>
		<input type="hidden" name="key">
		<input type="hidden" name="service_id" value="" id="service_id">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		<div class="card-header">
						<h4 class="card-title">Shelter Details </h4><a href="shelter_master.php" class="btn btn-success" style="float:right;">Back</a>
		</div>
		<div class="table-responsive">
				
		
		</div>
		</div>
		</div>
			</div>
			
	</form>
		
        

        <div class="row">
		<div class="col-md-12">
		<div class="card mt-12">
		
		<div class="table-responsive">
				<table class="table table-bordered table-striped">
				
					<tr>
					      <th>Sl.No</th>
                <th>District</th>
                <th>ULB</th>
                <th>Shelter Name</th>
                <th> Register Date</th>
                <th>SMA Name</th>
                <th>Capacity</th>
                <th>Men</th>
                <th>Women</th>
                <th>Third Gender</th>
                <th>Total</th>
                 <th>Status</th>
                 <?php if($usertype!='SHELTER'){ ?>
                   <th>Change Status</th>
                   <?php } ?>
                        <th>Action</th>
                        
					</tr>
					
					    <?php
				  $sno=1;
				  $shelterdetail=mysqli_query($connection,"select * from  m_shelter $conuser order by shelter_id desc");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				       $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					   $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
					  
					  if($get_data['approval_status']==0){
						  $status="<span style='color:red'><strong>Pending</strong></span>";
						  $changepro="Approval";
					  }else {
						  $status="<span style='color:#00F'><strong>Approved</strong></span>";
						  $changepro="Reject";
						  }
				  ?>
		 	      <tr>
		 	      <td><?php echo $sno++; ?></td>
		 	     <td><?php echo ucfirst(strtolower($district));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
				  <td><?php echo $ngo; ?></td>
				  <td><?php echo $cmn->dateformatindia($get_data['createdate'])?></td>
				 <td><?php echo $get_data['smaname']?></td>
                  <td><?php echo $get_data['design_capacity']?></td>
                   <td><?php echo $get_data['men']?></td>
				  <td><?php echo $get_data['women']?></td>
                   <td><?php echo $get_data['children']?></td>
                    <td><?php echo $get_data['total']?></td>
                     <td><?php echo $status;?></td>
                           <?php if($usertype!='SHELTER'){ ?>
                      <td><button <?php if($changepro=='Approval'){ ?> class="btn btn-info" <?php } else { ?> class="btn btn-danger" <?php } ?> onClick="getChanges(<?php echo $get_data['shelter_id']?>);"><?php echo $changepro;?></button></td>
                      <?php } ?>
                              <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='shelter_master.php?shelter_id=<?php echo  $get_data['shelter_id'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red"  data-toggle="modal" data-target="#myModal" onclick='GetModel(<?php echo  $get_data['shelter_id'] ; ?>);'></a></td>
                                                  <!-- <a class="fa fa-remove" style="font-size:20px;color:red"  data-toggle="modal" data-target="#myModal" onclick='funDel(<?php echo  $get_data['shelter_id'] ; ?>);'></a>-->
					    </tr>
					<?php } ?>  
					
					

				</table>
		</div>
		</div>
		</div>
		</div>
        </div>
		<!-- end container -->
	</div>



	<?php include("inc/footer.php"); ?>
<script>
function GetModel(id){
jQuery('#shelter_id').val(id);		
}
	function funDel()
	{ 
	var delete_date =  jQuery("#delete_date").val();
	var reason =  jQuery("#reason").val();
	var id =  jQuery("#shelter_id").val();
	
		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		imgpath = '<?php echo $imgpath; ?>';
		 //alert(module); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_shelter_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath+'&delete_date='+delete_date+'&reason='+reason,
			  dataType: 'html',
			  success: function(data){
				location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
  function getChanges(data){
	  
	   jQuery.ajax({
		  type: 'POST',
		  url: 'getchange_approval.php',
		  data: "data="+data,
		  dataType: 'html',
		  success: function(data){	
		
		   location='shelter_list.php';
			}
		  });//ajax close
	  
  }
  </script>
</body>

</html>