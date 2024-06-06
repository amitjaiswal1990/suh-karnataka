<?php
include("adminsession.php");
$pagename = "payment_list.php";
$module = "Payment Details";
$submodule = "Add Payment Details";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "payments_by";
$tblpkey = "payid";
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
						<h4 class="card-title">Payment Details</h4><a href="payments_by.php" class="btn btn-success" style="float:right;">Back</a>
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
                        <th>Shelter</th>
						<th>Date</th>						
						<th>Amount</th>
                        <th>Remark</th>
                        <th>Action</th>
					</tr>
					
					    <?php
				 $sn=1;
				
						$dist=mysqli_query($connection,"select * from payments_by $conuser order by payid desc");
							while($data=mysqli_fetch_array($dist)){
							$ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$data[ulbid]'");
							$ngoname = $cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$data[ngoid]'");
							$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$data[districtid]'");
								?>
					    <tr>
					      <td><?php echo $sn++;?></td>
                        <td><?php echo ucfirst(strtolower($districtname));?></td>
                          <td><?php echo ucfirst(strtolower($ulbname));?></td>
                            <td><?php echo ucfirst(strtolower($ngoname));?></td>
                         <td><?php echo $cmn->dateformatindia($data['paydate']);?></td>
					      <td><?php echo $data['amount'];?></td>                          
                           <td><?php echo $data['remark'];?></td>
                              <td><a class="fa fa-edit" style="font-size:20px"  title="Edit" href='payments_by.php?payid=<?php echo  $data['payid'] ; ?>'></a> /
                                                <a class="fa fa-remove" style="font-size:20px;color:red" onclick='funDel(<?php echo  $data['payid'] ; ?>);'></a></td>
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
	function funDel(id)
	{  //alert(id);   
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
			  url: 'ajax/delete_image_master.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module+'&imgpath='+imgpath,
			  dataType: 'html',
			  success: function(data){
				//alert(data);
				   location='<?php echo $pagename."?action=3" ; ?>';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close
  </script>
</body>

</html>