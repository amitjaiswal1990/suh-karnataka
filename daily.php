
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->
<?php 
// include("header.php"); 
include_once("config.php");
$perPage = 50;
$sqlQuery = "SELECT * FROM  personal_details";
$result = mysqli_query($connection, $sqlQuery);
$totalRecords = mysqli_num_rows($result);
echo $totalPages = ceil($totalRecords/$perPage)
?>
<script src="plugin/simple-bootstrap-paginator.js"></script>
<script src="js/pagination.js"></script>
<?php include('container.php');?>
<div class="container">	
	<div class="row">
		<h2>Example: Advanced Ajax Pagination with PHP and MySQL</h2> 
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Sl.No</th>

                          <!--<th>Photo</th>-->

                                    <th>District</th>

                    <th>ULB</th>

                    <th>Shelter Name</th>

                    <th>Name</th>

                    <th>DOB</th>

                    <th>Age</th>

                    <th>Gender</th>



                        <!--<th colspan="2">Attendance</th>-->

				</tr>
			</thead>
			<tbody id="content">     
			</tbody>
		</table>   
		<div id="pagination"></div>    
		<input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">	
	</div>    
</div>
<div class="insert-post-ads1" style="margin-top:20px;">

</div>
</div>
</body></html>






