<?php
if($action != "")
{?>
<div class="widgetcontent" id="alertbox">
                        	
  <?php
  if($action == "3")
	{?>
    <div class="alert alert-danger bg-danger text-white mb-0" role="alert" >
      <button data-dismiss="alert" class="close" type="button">×</button>
      <strong>Record Deleted !! </strong>Succesfully
    </div><!--alert-->
  <?php
	}
	else if($action == "1")
	{?>
    <div class="alert alert-success bg-success text-white" role="alert">
      <button data-dismiss="alert" class="close" type="button">×</button>
       <strong>Record Inserted !! </strong>Succesfully
    </div><!--alert-->
     <?php
	}
	else if($action == "2")
	{?>
    <div class="alert alert-info bg-success text-white" role="alert" >
      <button data-dismiss="alert" class="close" type="button">×</button>
       <strong>Record Updated !! </strong>Succesfully
    </div><!--alert-->
 <?php
	}?>
</div>
<?php
}?>