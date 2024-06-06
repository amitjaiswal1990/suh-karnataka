<?php
include("adminsession.php");
		
$districtid=trim(addslashes($_REQUEST['districtid'])); 
$ulbid=trim(addslashes($_REQUEST['ulbid'])); 
$ngoid=trim(addslashes($_REQUEST['ngoid'])); 
			
$con = "where 1=1";

if($districtid!="")
{
$con .=" and districtid = '$districtid'";

}

if($ulbid!="")
{
$con .=" and ulbid = '$ulbid'";

}
if($ngoid!="")
{
$con .=" and ngoid = '$ngoid'";

}
//echo "SELECT * FROM m_district order by districtname asc";
?>



<h1>Shelter Details</h1>
		<div id="container">

		<article class="entry">

			

			<div class="entry-content">
				

		  
<?php
		  $shelter_list=array();
		  $sql = mysqli_query($connection,"select * from  m_ngo $con ");
				while($row=mysqli_fetch_assoc($sql)) {
				$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$row[districtid]'");
				$ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row[ulbid]'");
		  
        array_push($shelter_list,[$row['Y'],$row['X'],$districtname,$ulbname,$row['ngoname']]);

				}
			
 //echo $num_rows;
 ?>
 <script>
 
var shelter_list=<?php echo json_encode($shelter_list);?>;
var habIcon = L.icon({iconUrl: 'icon/red.png', iconSize: [30, 30],});
 for (var i = 0; i < shelter_list.length; i++) {
			            marker = new L.marker([shelter_list[i][0],shelter_list[i][1]],{icon: habIcon})
				            .bindPopup(shelter_list[i][2])
				            .addTo(shelterGroup).bindPopup("<p> District - "+shelter_list[i][2]+"<br> ULB - "+shelter_list[i][3]+"<br>Shelter Name - "+shelter_list[i][4]+"</p>");
	 
 }
	
var group = new L.featureGroup([marker]);
mymap.fitBounds(group.getBounds());
</script>
 
   
			</div>
		</article>

	</div>

		

</br>
<table class="table table-fixed table-striped table-bordered tableFixHead">
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
              <th style="vertical-align: middle;font-size:15px" class="head0 nosort">S.No.</th>
				
              <th style="vertical-align: middle;font-size:15px">District</th>
				<th style="vertical-align: middle;font-size:15px">ULB</th>
             
            
				
              <th style="vertical-align: middle;font-size:15px">Shelter</th>
               <th style="vertical-align: middle;font-size:15px" width="100px">SMA Name</th>
              <th style="vertical-align: middle;font-size:15px">Contact Person</th>
             
              
             </tr>
           <!--  <tr>
            
            
             <?php 
		
			 ?>
             
            <td></td>
            <td><strong>Total</strong></td>
            <td><strong><?php echo $totvender;?></strong></td>
            <td></td>
            <td></td>
             <td></td>
              <td></td>
            
            </tr>
            -->
          </thead>
           <tbody id="myTable">
            </span>
            
           
            
            <?php
											$slno=1;
											//echo "select * from vendor_details $con order by id desc";
											
											$sql_get = mysqli_query($connection,"select * from m_ngo $con");
											while($row_get = mysqli_fetch_assoc($sql_get))
											{
												$districtname = $cmn->getvalfield($connection,"m_district","districtname","districtid='$row_get[districtid]'");
				$ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$row_get[ulbid]'");
												?>
            <tr >
              <td><?php echo $slno++; ?></td>
				
					
					
            
              <td><?php echo $districtname;  ?></td>
              <td><?php echo $ulbname;  ?></td>
               <td><?php echo $row_get['ngoname'];  ?></td>
             	
              <td><?php echo $row_get['smaname'];?></td>
               <td><?php echo $row_get['contatct_person'];?></td>

            </tr>			

            <?php
											}
											?>
          </tbody>
        </table>

<script>
function searchrecorrd() {
var value = jQuery('#myInput').val().toLowerCase();
	//alert(value);
	
	 jQuery("#myTable tr").filter(function() {
      jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
    });

}
</script>
