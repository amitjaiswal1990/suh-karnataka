<?php include("adminsession.php");

$pagename = "amrut_process.php";
$module = "Amrut";
$submodule = "Amrut";
$btn_name = "Search";
$keyvalue =0 ;
$tblname = "vendor_details";
$tblpkey = "id";
$imgpath = "uploaded/plan/";
// echo $filepdf="uploaded/plan/44.pdf";

if(isset($_GET['project_name']))
{
$project_name = addslashes(trim($_GET['project_name']));
}
else
{
$project_name = "";
}
$con = "where 1=1";


if($project_name!="")
{
$con .=" and project_name = '$project_name'";

}




?>


<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <script src="js/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-multiselect.min.js" ></script>
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="js/leafletjs/leaflet.css" />
    <script src="js/leafletjs/leaflet.js" ></script>
    <script type="text/javascript" src="js/wicket.js" ></script>
    <script type="text/javascript" src="js/wicket-leaflet.js" ></script>
	<title>Tumakuru | View Map</title>		
</head>

<style>
    .container-fluid{
    	box-shadow:0 8px 16px 0 rgba(0,0,0,0.2);
    }
</style>

<body style="background-color:#E7E7E7;">
 

    
    
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tumakuru</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a></li>
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mapping <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="viewmap.php">View Map</a></li>
                <li><a href="analysis.php">Analysis</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Plan Approval <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="plan_approval.php">Plan Approval</a></li>
               
              </ul>
            </li>
             <li><a href="amrut_process.php">Amrut Project</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="plan_approval.php">Plan Upload</a></li>
                <li><a href="#">Upload Data</a></li>
                <li><a href="#">Delete Data</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">User Details</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container-fluid">
        
        	<form   method="get" action="" >
            <div id="searchdesk">
            <table  width="70%">
             
                  <tr>
                  <td width="15%"><strong>Project Name</strong></td>
                  <td>
                                            <select class="form-control" id="project_name" name="project_name" >
                        <option value="">-Select Project-</option>
                      
                                            <?php 
											$sql1 = "select project_name from amrut_process group by project_name asc";
											$res1 = mysqli_query($connection,$sql1);
											while($row1 = mysqli_fetch_array($res1))
												{
											?>
                                          			<option value="<?php echo $row1['project_name']; ?>"><?php echo strtoupper($row1['project_name']); ?></option>
                                            <?php
												}
												
												?>
                                      </select>
                                      <script> document.getElementById('project_name').value='<?php echo $project_name; ?>'; </script>  
                                            </td>
                                            <td>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            
                                            
                   
                                           
                                            <td><input type="submit" id="submit"  value="Search" class="btn btn-success"></td>
                                            
                   
                                             
              </tr>
             
             
          
              
            </table>
 
 </div>
 
          </form>
        
        
    </div> 
    
      <div id="searchmob" style="display:none">
                    <table>
<tr>

<td style="padding-left:10px"> <input type="submit" id="submit" onClick="getSearch();" value="Search" class="btn btn-success"> </td>
<td style="padding-left:10px"><a href="index.php" class="btn btn-primary">Clear</a></td>

<td style="padding-left:10px"><div id="showdronimage"></div></td>

</tr>

</table>
</div>
           
 
		  <br>

        <!--widgetcontent-->
       
         <div id="mapid" style="height: 450px; width: 100%;">
         
         </div>
       
                            <div class="widgetcontent bordered" id="showdatarecord">  </div>
                      
        
        
        
    
        <h3 class="widgettitle"><?php echo $submodule; ?> Project Details</h3>
        
            	<table class="table table-fixed table-striped table-bordered tableFixHead" style="font-size:12px" >
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                    
                        <tr>
                        	
                          	<th class="head0 nosort">S.No.</th>
                        
                                                <th class="head0">GID</th>
                                                 <th class="head0">Project Name</th> 
                                                <th class="head0">Work</th>
                                                <th class="head0">SHPSC Approved Amount</th>
                                                <th class="head0">Date of Award</th>
                                                <th class="head0">Agency</th>  
                                                <th class="head0">Contract Amount</th> 
                                                <th class="head0">Contract Duration</th> 
                                                <th class="head0">Completion Date</th> 
                                                <th class="head0">Financial Progress</th>
                                                <th class="head0">Percentage</th>
                                                <th class="head0">Length of Drain</th>
                                                <th class="head0">Width of Drain</th> 
                        </tr>
                    </thead>
                    <tbody>
                        
                      
                               <?php
											$slno=1;
											
											
											$sql_get = mysqli_query($connection,"select * from amrut_process $con order by amrid asc");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['gid'] ; ?></td>
                                                 <td><?php echo $row_get['project_name'] ; ?></td> 
                                                <td><?php echo $row_get['work'] ; ?></td>
                                                <td><?php echo $row_get['SHPSC_approved_amount'] ; ?></td>
                                                <td><?php echo $row_get['date_of_award'] ; ?></td>
                                                <td><?php echo $row_get['agency'] ; ?></td>  
                                                <td><?php echo $row_get['contract_amount'] ; ?></td> 
                                                <td><?php echo $row_get['contract_duration'] ; ?></td> 
                                                <td><?php echo $row_get['completion_date'] ; ?></td> 
                                                <td><?php echo $row_get['financial_progress'] ; ?></td>
                                                <td><?php echo $row_get['percentage'] ; ?></td>
                                                <td><?php echo $row_get['length_of_drain'] ; ?></td>
                                                <td><?php echo $row_get['width_of_drain'] ; ?></td> 
                                 
                             
                              
                        </tr>
                    
                        <?php
											}
											?>
                        
                        
                    </tbody>
                </table>
               
           

    <br>

    
    
    <br>
    
    
    
    
    
    
    
    <br>
    
    <footer style="background:#3b6998; height: 40px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" align="right"><p style="color:white;padding-top: 10px;padding-right: 25px;"><em>Brought to you by <strong>Infomaps</strong></em></p></div>
            </div>
        </div>
    </footer>

<script>
 var mymap = L.map('mapid').setView([13.350, 77.10], 10);
		//var habitationGroup = L.layerGroup().addTo(mymap);
		//var gpGroup = L.layerGroup().addTo(mymap);
		var habitationGroup = L.layerGroup().addTo(mymap);
			var amrutmarkerGroup = L.layerGroup().addTo(mymap);
		var marker;
		L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			subdomains: ['a','b','c']
        }).addTo(mymap);

 
		//if($Usage1=="" && $Construction=="" && $Area_Violation=="" && $Street_Name==""){
	
<?php	$amrutmarker=array();
	$sql = mysqli_query($connection,"select * from amrut_process $con");
	while($row=mysqli_fetch_assoc($sql)) {	
	if($row['X']!='' && $row['Y']!='')
												{
	array_push($amrutmarker, [$row['Y'],$row['X'],$row['project_name'],$row['work'],$row['SHPSC_approved_amount'],$row['date_of_award'],$row['contract_amount'],$row['agency'],$row['contract_duration'],$row['completion_date']]);
	} }
	?>	
	var amrutmarker=<?php echo json_encode($amrutmarker);?>;
	
	for (var i = 0; i < amrutmarker.length; i++) {				
	if(amrutmarker[i][2]=='Green Space & Parks'){
	var Icon = L.icon({iconUrl: 'marker/green.png', iconSize: [25, 25],});
	}
	if(amrutmarker[i][2]=='Storm Water Drains'){
	var Icon = L.icon({iconUrl: 'marker/blue.png', iconSize: [25, 25],});
	}
	if(amrutmarker[i][2]=='Urban Transport'){
	var Icon = L.icon({iconUrl: 'marker/red.png', iconSize: [25, 25],});
	}
	marker = new L.marker([amrutmarker[i][0],amrutmarker[i][1]],{icon: Icon})
	.addTo(amrutmarkerGroup).bindPopup("<p><strong>Project</strong> -  "+amrutmarker[i][2]+"<br><strong>Work</strong> -  "+amrutmarker[i][3]+"<br><strong>SHPSC Amount</strong> -  "+amrutmarker[i][4]+"<br><strong>Date of Award</strong> -  "+amrutmarker[i][5]+"<br><strong>Contract Amount</strong> -  "+amrutmarker[i][6]+"<br><strong>Agency</strong> -  "+amrutmarker[i][7]+"<br><strong>Contract Duration</strong> -  "+amrutmarker[i][8]+"<br><strong>Completion Date</strong> -  "+amrutmarker[i][9]+"<br></p>");
	
	}
			
</script>

<script>

$(function(){
	    $('#gg').hide(); 
  $('#myForm').submit(function() {
	  //alert('hello');
    $('#gg').show(); 
    return true;
  });
});

    </script>

</body>

</html>