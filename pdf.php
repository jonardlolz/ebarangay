<?php

// Include autoloader 
require_once 'vendor\dompdf\autoload.inc.php'; 
session_start(); 

// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

// Load HTML content 
$dompdf->loadHtml("<html>
<head><meta http-equiv=Content-Type content='text/html; charset=UTF-8'>

</head>
<body>

<div style='position:absolute;left:240.53px;top:34.80px' class='cls_002'><span class='cls_002'>Republic of the Philippines</span></div>
<div style='position:absolute;left:245.21px;top:48.84px' class='cls_003'><span class='cls_003'>BARANGAY {$_SESSION['userBarangay']}</span></div>
<div style='position:absolute;left:278.57px;top:62.40px' class='cls_002'><span class='cls_002'>Davao City</span></div>
<div style='position:absolute;left:174.74px;top:103.94px' class='cls_005'><span class='cls_005'>B A R A N G AY   C L E AR A N C E</span></div>
<div style='position:absolute;left:90.02px;top:147.74px' class='cls_006'><span class='cls_006'>TO WHOM IT MAY CONCERN:</span></div>
<div style='position:absolute;left:126.02px;top:175.34px' class='cls_004'><span class='cls_004'>This is to certify that </span><span class='cls_009'>complete name</span><span class='cls_004'> with residence and postal address at</span></div>
<div style='position:absolute;left:90.02px;top:189.02px' class='cls_010'><span class='cls_010'>&lt;Street Address></span><span class='cls_011'>,</span><span class='cls_004'> Barangay Mintal, Davao City has no derogatory record filed in</span></div>
<div style='position:absolute;left:90.02px;top:202.94px' class='cls_004'><span class='cls_004'>our Barangay Office.</span></div>
<div style='position:absolute;left:126.02px;top:230.54px' class='cls_004'><span class='cls_004'>The above-named individual who is a bonafide resident of this barangay is</span></div>
<div style='position:absolute;left:90.02px;top:244.37px' class='cls_004'><span class='cls_004'>a person of good moral character, peace-loving and civic minded citizen.</span></div>
<div style='position:absolute;left:126.02px;top:271.97px' class='cls_004'><span class='cls_004'>This  certification/clearance  is  hereby  issued  in  connection  with  the</span></div>
<div style='position:absolute;left:90.02px;top:285.65px' class='cls_004'><span class='cls_004'>subject’s application for </span><span class='cls_008'>&lt;state reason for application></span><span class='cls_004'> and for whatever legal</span></div>
<div style='position:absolute;left:90.02px;top:299.57px' class='cls_004'><span class='cls_004'>purpose it may serve him/her best, and is valid for six (6) from the date issued.</span></div>
<div style='position:absolute;left:126.02px;top:327.17px' class='cls_006'><span class='cls_006'>NOT VALID WITHOUT OFFICIAL SEAL.</span></div>
<div style='position:absolute;left:126.02px;top:354.77px' class='cls_004'><span class='cls_004'>Given this Monday, May 20, 2013.</span></div>
<div style='position:absolute;left:126.02px;top:354.77px' class='cls_004'><span class='cls_004'>Given this Monday, May 20, 2013.</span></div>
<div style='position:absolute;left:400.07px;top:400.99px' class='cls_006'><span class='cls_006'><img src='signature.png' alt='signature' style='width: 25%;'></span></div>

<div style='position:absolute;left:342.07px;top:409.99px' class='cls_006'><span class='cls_006'>RAMON M. BARGAMENTO II</span></div>
<div style='position:absolute;left:384.79px;top:423.79px' class='cls_004'><span class='cls_004'>Punong Barangay</span></div>
<div style='position:absolute;left:90.02px;top:451.39px' class='cls_004'><span class='cls_004'>Specimen Signature of Applicant:</span></div>
<div style='position:absolute;left:130.02px;top:465.99px' class='cls_004'><span class='cls_004'><img src='signature.png' alt='signature' style='width: 25%;'></span></div>
<div style='position:absolute;left:130.02px;top:478.99px' class='cls_004'><span class='cls_004'> Resident Resident</span></div>
<div style='position:absolute;left:90.02px;top:478.99px' class='cls_004'><span class='cls_004'>___________________________</span></div>
<div style='position:absolute;left:90.02px;top:534.19px' class='cls_004'><span class='cls_004'>CTC No. _______</span></div>
<div style='position:absolute;left:90.02px;top:547.99px' class='cls_004'><span class='cls_004'>Issued at ________</span></div>
<div style='position:absolute;left:90.02px;top:561.79px' class='cls_004'><span class='cls_004'>Issued on _______</span></div>
</div>

</body>
</html>
"); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF to Browser 
$dompdf->stream();