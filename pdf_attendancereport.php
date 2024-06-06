<?php
error_reporting(0);
$host_name="localhost";
$db_name="suh_karnataka";
	$db_user="suh_karnataka";
	$db_pwd="J#k1F^778[HU";
	$connection = mysqli_connect("$host_name","$db_user","$db_pwd","$db_name");
	date_default_timezone_set('Asia/Kolkata');
		//$conn = new Connection();	
		include_once("lib/dboperation.php");
		include_once("lib/getval.php");
		$cmn = new Comman();
		
require("fpdf17/fpdf.php");
//$acc_type = "student";
//$title1 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = '1'");

$nowdate=date('d-m-Y');
if($_GET['atten_date']!="")
{
	$atten_date = addslashes(trim($_GET['atten_date']));

}

$pagedate = $cmn->dateformatindia($atten_date);
class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;
	function Header()
	{ 
	global $title1,$title2,$pagedate;
	
	
	
	    $this->Rect(5,5,287,200);
		$this->SetFont('courier','b',25);
		$this->Cell(90);
		$this->Cell(90,0,$title1,0,1,'C');
		$this->Ln(7);
		$this->SetFont('arial','b',15);
		$this->Cell(90);
		$this->Cell(90,0,$title2,0,1,'C');
		$this->Ln(2);
		$this->Cell(-1);
		$this->SetFont('arial','b',11);
	//	$this->Cell(275,5,"Date : ".$pagedate,0,1,'R');
		
		
	
		$this->SetWidths(array(15,130,51,24,12,20,30));
		$this->SetAligns(array('L','L','L','L','L','L'));
		
	}
	function Footer()
	{ 
	    $this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
     }
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}
function SetCellMargin($margin)
	 {
        // Set cell margin
        $this->cMargin = $margin;
    }
function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=7*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,7,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}
?>
<?php


function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}
$pdf=new PDF_MC_Table();
//$title1 = "Library Management";
$pdf->SetTitle($title1);
$title2 = "";
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('L','A4');

$slno=1;


//echo "select * from  attendance_details  $condata and atten_date='$atten_date' group by districtid asc";
 $ulbdetail=mysqli_query($connection,"select * from  attendance_details  where atten_date='$atten_date' group by districtid asc");
				  while($get_u=mysqli_fetch_array($ulbdetail)){ 
				   $districtname=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_u[districtid]'");
				     $ulbname=$cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_u[ulbid]'");
					   $totshelter=$cmn->getvalfield($connection,"attendance_details","count(aid)","atten_date='$atten_date' and ulbid='$get_u[ulbid]'");
					
		 $slno=1;
					     $pdf->Ln(1);
					   $pdf->setCellMargin(2);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(282,8,"District : ".$districtname."                      ULB : ".$ulbname,'1',1,'L',0);                      
		
		  
					 
		$pdf->setCellMargin(2);
		$pdf->SetFont('Arial','B',12);
					   $pdf->Cell(15,8,'SN','1',0,'L',0);
		$pdf->Cell(130,8,'Shelter Name',1,0,'L',0);
		$pdf->Cell(51,8,'Name',1,0,'L',0);  
		$pdf->Cell(24,8,'DOB',1,0,'L',0);
		$pdf->Cell(12,8,'Age',1,0,'L',0);
		$pdf->Cell(20,8,'Gender',1,0,'L',0);
		$pdf->Cell(30,8,'Atte. Date',1,1,'L',0);
		
				//	echo "select * from attendance_details atten_date='$atten_date'";				
				  $shelterdetail=mysqli_query($connection,"select * from attendance_details where atten_date = '$atten_date' and  ulbid= '$get_u[ulbid]' order by ngoid asc");
				  while($get_data=mysqli_fetch_array($shelterdetail)){
				      // $state=$cmn->getvalfield($connection,"m_state","statename","stateid='$get_data[stateid]'");
					    $district=$cmn->getvalfield($connection,"m_district","districtname","districtid='$get_data[districtid]'");
					 $ulbname = $cmn->getvalfield($connection,"ulb_master","ulbname","ulbid='$get_data[ulbid]'");
					  $ngo=$cmn->getvalfield($connection,"m_ngo","ngoname","ngoid='$get_data[ngoid]'");
					   $id=$cmn->getvalfield($connection,"personal_details","id","id='$get_data[pid]'");
						$per_name=$cmn->getvalfield($connection,"personal_details","per_name","id='$id'");
						$profile_photo=$cmn->getvalfield($connection,"personal_details","profile_photo","id='$id'");
						$date_of_birth=$cmn->getvalfield($connection,"personal_details","date_of_birth","id='$id'");
						$age=$cmn->getvalfield($connection,"personal_details","age","id='$id'");
						$gender=$cmn->getvalfield($connection,"personal_details","gender","id='$id'");
								 if($get_data['attendance']=='Present'){ 
								 $status = "Present";
								 } else { 
								  $status = "Absent";
								 } 		 
					
			       $pdf->setCellMargin(2);	
				 $pdf->SetFont('Arial','',11);
				 $pdf->SetTextColor(0,0,0);
				  $pdf->Row(array($slno++,$ngo,ucfirst(strtolower($per_name)),$cmn->dateformatindia($date_of_birth),$age,$gender,$cmn->dateformatindia($get_data['atten_date'])));
										  
				  }
			 }
		
	      $pdf->Output($nowdate.'Occupancy Report','I');				        
 ?>