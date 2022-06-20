<?php


require("node_modules/FPDF/fpdfsqltable.php");

session_start();


class PDF extends PDF_MySQL_Table{



    function Header(){
        include 'includes/dbh.inc.php';
        $brgyInfo = $conn->query("SELECT * FROM barangay WHERE BarangayName='{$_SESSION['userBarangay']}'")->fetch_assoc();
        $this->Image('img/'.$brgyInfo['barangay_pic'],10,6,25);
        $this->Image('img/eb-logo.png',170,6,25);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(80);
        $this->Cell(30,10,'Barangay '.$_SESSION['userBarangay'],0,0,'C');
        $this->Ln(20);
        $this->SetFont('Arial', '', 12);
        if(isset($_GET['purok'])){
            if($_GET['purok'] != 'All'){
                $this->Cell(30,10,'Purok: '.$_GET['purok'],0,0);
            }
            $this->Ln(5);
        }
        if(isset($_GET['reportType'])){
            if($_GET['reportType'] == 'ereklamoReport'){
                $this->Cell(30,10,'Type of Report: Reklamo Report',0,0);
            }
            elseif($_GET['reportType'] == 'requestReport'){
                $this->Cell(30,10,'Type of Report: Request Report',0,0);
            }
            elseif($_GET['reportType'] == 'paymentReport'){
                $this->Cell(30,10,'Type of Report: Payment Report',0,0);
            }
            elseif($_GET['reportType'] == 'userReport'){
                $this->Cell(30,10,'Type of Report: User Report',0,0);
            }
            elseif($_GET['reportType'] == 'electionReport'){
                $this->Cell(30,10,'Type of Report: Election Report',0,0);
            }
        }
        elseif(isset($_GET['residentPrint'])){
            if($_GET['residentPrint'] == 'Resident'){
                $this->Cell(30,10,'Type of Report: Resident',0,0);
            }
            if($_GET['residentPrint'] != 'Resident'){
                $this->Cell(30,10,'Type of Report: Resident - '.$_GET['residentPrint'],0,0);
            }
        }
        $this->Cell(120);
        $this->Cell(30,10,'Date:'.date("Y-m-d"),0,0);
        $this->Ln(20);
    }

    function Footer(){
        $this->Ln(10);
        $this->SetFont('Arial', '', 12);
        $this->Cell(160);
        $this->Cell(30,10,'Prepared by: '.$_SESSION['Firstname']. ' '.$_SESSION['Lastname'],0,0,'R');
        $this->Ln(5);
        $this->SetFont('Arial', '', 12);
        $this->Cell(160);
        $this->Cell(30,10,''.$_SESSION['userType'].'',0,0,'R');
        $this->SetY(-15);
        $this->SetFont('Arial', '', 11);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
include 'includes/dbh.inc.php';

$pdf = new PDF();
$pdf->AliasNbPages();   
$pdf->AddPage();

if(isset($_GET['reportType'])):
    if($_GET['reportType'] == 'ereklamoReport'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(30,30,30,30,30,30));
            $pdf->SetAligns(array('C','C','C','C','C','C'));
            $pdf->AddCol('complaineeName', 30, 'Complainee', 'C');
            $pdf->AddCol('respondername', 30, 'Responder', 'C');
            $pdf->AddCol('complaintName', 30, 'Complaint', 'C');
            $pdf->AddCol('detail', 40, 'Detail', 'C');
            $pdf->AddCol('dateComplained', 40, 'Date Complained', 'C');
            $pdf->AddCol('dateResolved', 40, 'Date Resolved', 'C');
            $pdf->Table($conn,"SELECT concat(complainee.Firstname, ' ', complainee.Lastname) as complaineeName,
                                concat(responder.Firstname, ' ', responder.Lastname) as respondername,
                                ereklamo.reklamoType as complaintName,
                                ereklamo.detail as detail,
                                DATE_FORMAT(ereklamo.CreatedOn, '%M %d, %Y') as dateComplained,
                                DATE_FORMAT(ereklamoreport.date, '%M %d, %Y') as dateResolved
                                FROM ereklamoreport 
                                INNER JOIN ereklamo on ereklamo.ReklamoID=ereklamoreport.ReklamoID 
                                INNER JOIN users responder ON responder.UsersID=ereklamoreport.respondentID 
                                INNER JOIN users complainee ON complainee.UsersID=ereklamo.complainee 
                                INNER JOIN chatroom ON ereklamo.ReklamoID=chatroom.idreference AND type='ereklamo' 
                                WHERE ereklamo.barangay='{$_SESSION['userBarangay']}' AND ereklamoreport.reportStatus='Resolved' 
                                ORDER BY date DESC");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(30,30,30,30,30,30));
            $pdf->SetAligns(array('C','C','C','C','C','C'));
            $pdf->AddCol('complaineeName', 30, 'Complainee', 'C');
            $pdf->AddCol('respondername', 30, 'Responder', 'C');
            $pdf->AddCol('complaintName', 30, 'Complaint', 'C');
            $pdf->AddCol('detail', 40, 'Detail', 'C');
            $pdf->AddCol('dateComplained', 40, 'Date Complained', 'C');
            $pdf->AddCol('dateResolved', 40, 'Date Resolved', 'C');
            $pdf->Table($conn,"SELECT concat(complainee.Firstname, ' ', complainee.Lastname) as complaineeName,
                                concat(responder.Firstname, ' ', responder.Lastname) as respondername,
                                ereklamo.reklamoType as complaintName,
                                ereklamo.detail as detail,
                                DATE_FORMAT(ereklamo.CreatedOn, '%M %d, %Y') as dateComplained,
                                DATE_FORMAT(ereklamoreport.date, '%M %d, %Y') as dateResolved
                                FROM ereklamoreport 
                                INNER JOIN ereklamo on ereklamo.ReklamoID=ereklamoreport.ReklamoID 
                                LEFT JOIN users responder ON responder.UsersID=ereklamoreport.respondentID 
                                LEFT JOIN users complainee ON complainee.UsersID=ereklamo.complainee 
                                INNER JOIN chatroom ON ereklamo.ReklamoID=chatroom.idreference AND type='ereklamo' 
                                WHERE ereklamo.barangay='{$_SESSION['userBarangay']}' AND ereklamoreport.reportStatus='Resolved' AND ereklamoreport.purok='{$_GET['purok']}'
                                ORDER BY date DESC");
        endif;
    elseif($_GET['reportType'] == 'userReport'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(38,38,38,38,38,38));
            $pdf->SetAligns(array('C','C','C','C','C','C'));
            $pdf->AddCol('residentName', 30, 'Resident', 'C');
            $pdf->AddCol('officerName', 30, 'Officer', 'C');
            $pdf->AddCol('reportStatus', 30, 'Status', 'C');
            $pdf->AddCol('reportMessage', 30, 'Message', 'C');
            $pdf->AddCol('dateReported', 30, 'Date Reported', 'C');

            $pdf->Table($conn,"SELECT concat(resident.Firstname, ' ', resident.Lastname) as residentName,
                            concat(officer.Firstname, ' ', officer.Lastname) as officerName,
                            reportStatus,
                            reportMessage,
                            DATE_FORMAT(date, '%M %d, %Y') as dateReported
                            FROM userreport 
                            INNER JOIN users resident ON resident.UsersID=userreport.UsersID 
                            INNER JOIN users officer ON officer.UsersID=userreport.OfficerID 
                            WHERE barangay='{$_SESSION['userBarangay']}'
                            ORDER BY date DESC");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(38,38,38,38,38,38));
            $pdf->SetAligns(array('C','C','C','C','C','C'));
            $pdf->AddCol('residentName', 30, 'Resident', 'C');
            $pdf->AddCol('officerName', 30, 'Officer', 'C');
            $pdf->AddCol('reportStatus', 30, 'Status', 'C');
            $pdf->AddCol('reportMessage', 30, 'Message', 'C');
            $pdf->AddCol('dateReported', 30, 'Date Reported', 'C');

            $pdf->Table($conn,"SELECT concat(resident.Firstname, ' ', resident.Lastname) as residentName,
                            concat(officer.Firstname, ' ', officer.Lastname) as officerName,
                            reportStatus,
                            reportMessage,
                            DATE_FORMAT(date, '%M %d, %Y') as dateReported
                            FROM userreport 
                            INNER JOIN users resident ON resident.UsersID=userreport.UsersID 
                            INNER JOIN users officer ON officer.UsersID=userreport.OfficerID 
                            WHERE barangay='{$_SESSION['userBarangay']}' AND purok='{$_GET['purok']}' 
                            ORDER BY date DESC");
        endif;
    elseif($_GET['reportType'] == 'requestReport'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(20,23,30,24,30,24,20,20));
            $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
            $pdf->AddCol('officername', 30, 'Officer', 'C');
            $pdf->AddCol('requestername', 30, 'Requester', 'C');
            $pdf->AddCol('documentType', 30, 'Document Type', 'C');
            $pdf->AddCol('purpose', 30, 'purpose', 'C');
            $pdf->AddCol('reportMessage', 30, 'Report Message', 'C');
            $pdf->AddCol('reportStatus', 30, 'Report Status', 'C');
            $pdf->AddCol('dateRequested', 30, 'Date Request', 'C');
            $pdf->AddCol('dateReported', 30, 'Date Report', 'C');

            $pdf->Table($conn,"SELECT concat(officer.Firstname, ' ', officer.Lastname) as officername,
                                concat(user.Firstname, ' ', user.Lastname) as requestername, 
                                documentType,
                                purpose,
                                reportMessage,
                                reportStatus,
                                DATE_FORMAT(request.requestedOn, '%M %d, %Y') as dateRequested,
                                DATE_FORMAT(requestreport.date, '%M %d, %Y') as dateReported
                                FROM requestreport
                                INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus!='Paid'
                                WHERE requestreport.barangay='{$_SESSION['userBarangay']}'
                                ORDER BY date DESC");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(20,23,30,24,30,24,20,20));
            $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
            $pdf->AddCol('officername', 30, 'Officer', 'C');
            $pdf->AddCol('requestername', 30, 'Requester', 'C');
            $pdf->AddCol('documentType', 30, 'Document Type', 'C');
            $pdf->AddCol('purpose', 30, 'purpose', 'C');
            $pdf->AddCol('reportMessage', 30, 'Report Message', 'C');
            $pdf->AddCol('reportStatus', 30, 'Report Status', 'C');
            $pdf->AddCol('dateRequested', 30, 'Date Request', 'C');
            $pdf->AddCol('dateReported', 30, 'Date Report', 'C');

            $pdf->Table($conn,"SELECT concat(officer.Firstname, ' ', officer.Lastname) as officername,
                                concat(user.Firstname, ' ', user.Lastname) as requestername, 
                                documentType,
                                purpose,
                                reportMessage,
                                reportStatus,
                                DATE_FORMAT(request.requestedOn, '%M %d, %Y') as dateRequested,
                                DATE_FORMAT(requestreport.date, '%M %d, %Y') as dateReported
                                FROM requestreport
                                INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus!='Paid'
                                WHERE requestreport.barangay='{$_SESSION['userBarangay']}' AND requestreport.purok='{$_GET['purok']}'
                                ORDER BY date DESC");
        endif;
    elseif($_GET['reportType'] == 'paymentReport'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(30,30,30,30,30,20,20));
            $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
            $pdf->AddCol('officername', 30, 'Officer', 'C');
            $pdf->AddCol('requestername', 30, 'Requester', 'C');
            $pdf->AddCol('documentType', 30, 'Document Type', 'C');
            $pdf->AddCol('purpose', 30, 'Purpose', 'C');
            $pdf->AddCol('amount', 30, 'Amount', 'C');
            $pdf->AddCol('dateRequested', 30, 'Date Request', 'C');
            $pdf->AddCol('dateReported', 30, 'Date Report', 'C');

            $pdf->Table($conn,"SELECT concat(officer.Firstname, ' ', officer.Lastname) as officername,
                                concat(user.Firstname, ' ', user.Lastname) as requestername, 
                                documentType,
                                purpose,
                                request.amount,
                                DATE_FORMAT(request.requestedOn, '%M %d, %Y') as dateRequested,
                                DATE_FORMAT(requestreport.date, '%M %d, %Y') as dateReported
                                FROM requestreport
                                INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus!='Paid'
                                WHERE requestreport.barangay='{$_SESSION['userBarangay']}'
                                ORDER BY date DESC");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(30,30,30,30,30,20,20));
            $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
            $pdf->AddCol('officername', 30, 'Officer', 'C');
            $pdf->AddCol('requestername', 30, 'Requester', 'C');
            $pdf->AddCol('documentType', 30, 'Document Type', 'C');
            $pdf->AddCol('purpose', 30, 'Purpose', 'C');
            $pdf->AddCol('amount', 30, 'Amount', 'C');
            $pdf->AddCol('dateRequested', 30, 'Date Request', 'C');
            $pdf->AddCol('dateReported', 30, 'Date Report', 'C');

            $pdf->Table($conn,"SELECT concat(officer.Firstname, ' ', officer.Lastname) as officername,
                                concat(user.Firstname, ' ', user.Lastname) as requestername, 
                                documentType,
                                purpose,
                                request.amount,
                                DATE_FORMAT(request.requestedOn, '%M %d, %Y') as dateRequested,
                                DATE_FORMAT(requestreport.date, '%M %d, %Y') as dateReported
                                FROM requestreport
                                INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus!='Paid'
                                WHERE requestreport.barangay='{$_SESSION['userBarangay']}' AND requestreport.purok='{$_GET['purok']}'
                                ORDER BY date DESC");
        endif;
    elseif($_GET['reportType'] == 'electionReport'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(45,45,45,45));
            $pdf->SetAligns(array('C','C','C','C'));
            $pdf->AddCol('electionTitle', 30, 'Election Title', 'C');
            $pdf->AddCol('purok', 30, 'Purok', 'C');
            $pdf->AddCol('created_at', 30, 'Date started', 'C');
            $pdf->AddCol('winnerName', 30, 'Elected candidate', 'C');

            $pdf->Table($conn,"SELECT election.purok, election.electionTitle, DATE_FORMAT(election.created_at, '%M %d, %Y') as created_at, election.electionStatus, results.electionID, results.UsersID, concat(users.Firstname, ' ', users.Lastname) as winnerName, candidateID, MAX(voteResults), position 
            FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID
            FROM votes INNER JOIN candidates ON candidates.candidateID = votes.candidateID
            GROUP BY candidateID) as results
            INNER JOIN election ON results.electionID=election.electionID
            INNER JOIN users ON results.UsersID=users.UsersID
            WHERE electionStatus='Finished' AND election.barangay='{$_SESSION['userBarangay']}'
            GROUP BY position;");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(45,45,45,45));
            $pdf->SetAligns(array('C','C','C','C'));
            $pdf->AddCol('electionTitle', 30, 'Election Title', 'C');
            $pdf->AddCol('purok', 30, 'Purok', 'C');
            $pdf->AddCol('created_at', 30, 'Date started', 'C');
            $pdf->AddCol('winnerName', 30, 'Elected candidate', 'C');

            $pdf->Table($conn,"SELECT election.purok, election.electionTitle, DATE_FORMAT(election.created_at, '%M %d, %Y') as created_at, election.electionStatus, results.electionID, results.UsersID, concat(users.Firstname, ' ', users.Lastname) as winnerName, candidateID, MAX(voteResults), position 
            FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID
            FROM votes INNER JOIN candidates ON candidates.candidateID = votes.candidateID
            GROUP BY candidateID) as results
            INNER JOIN election ON results.electionID=election.electionID
            INNER JOIN users ON results.UsersID=users.UsersID
            WHERE electionStatus='Finished' AND election.barangay='{$_SESSION['userBarangay']}' AND election.purok='{$_GET['purok']}'
            GROUP BY position;");
        endif;
    endif;
endif;
if(isset($_GET['residentPrint'])):
    if($_GET['residentPrint'] == 'Resident'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(35,25,25,25,25,25,30));
            $pdf->SetAligns(array('C','C','C','C','C','C','C'));
            $pdf->AddCol('residentName', 30, 'Name', 'C');
            $pdf->AddCol('dateofbirth', 30, 'Birthdate', 'C');
            $pdf->AddCol('civilStat', 30, 'Civil Status', 'C');
            $pdf->AddCol('userGender', 30, 'Gender', 'C');
            $pdf->AddCol('userPurok', 30, 'Purok', 'C');
            $pdf->AddCol('userType', 30, 'Type', 'C');
            $pdf->AddCol('startedLiving', 30, 'Started Living', 'C');

            $pdf->Table($conn,"SELECT concat(Firstname, ' ', Middlename, ', ' ,Lastname) as residentName, dateofbirth, civilStat, userGender, userPurok, userType, startedLiving FROM users WHERE userType!='Admin' AND userBarangay='{$_SESSION['userBarangay']}' ORDER BY FIELD(userType, 'Captain', 'Purok Leader', 'Secretary', 'Treasurer', 'Councilor', 'Resident')");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(35,25,25,25,25,25,30));
            $pdf->SetAligns(array('C','C','C','C','C','C','C'));
            $pdf->AddCol('residentName', 30, 'Name', 'C');
            $pdf->AddCol('dateofbirth', 30, 'Birthdate', 'C');
            $pdf->AddCol('civilStat', 30, 'Civil Status', 'C');
            $pdf->AddCol('userGender', 30, 'Gender', 'C');
            $pdf->AddCol('userPurok', 30, 'Purok', 'C');
            $pdf->AddCol('userType', 30, 'Type', 'C');
            $pdf->AddCol('startedLiving', 30, 'Started Living', 'C');

            $pdf->Table($conn,"SELECT concat(Firstname, ' ', Middlename, ', ' ,Lastname) as residentName, dateofbirth, civilStat, userGender, userPurok, userType, startedLiving FROM users WHERE userType!='Admin' AND userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_GET['purok']}' ORDER BY FIELD(userType, 'Captain', 'Purok Leader', 'Secretary', 'Treasurer', 'Councilor', 'Resident')");
        endif;
    elseif($_GET['residentPrint'] != 'Resident'):
        if($_GET['purok'] == 'All'):
            $pdf->SetWidths(array(35,25,25,25,25,25,30));
            $pdf->SetAligns(array('C','C','C','C','C','C','C'));
            $pdf->AddCol('residentName', 30, 'Name', 'C');
            $pdf->AddCol('dateofbirth', 30, 'Birthdate', 'C');
            $pdf->AddCol('civilStat', 30, 'Civil Status', 'C');
            $pdf->AddCol('userGender', 30, 'Gender', 'C');
            $pdf->AddCol('userPurok', 30, 'Purok', 'C');
            $pdf->AddCol('userType', 30, 'Type', 'C');
            $pdf->AddCol('startedLiving', 30, 'Started Living', 'C');

            $pdf->Table($conn,"SELECT concat(users.Firstname, ' ', users.Middlename, ', ' , users.Lastname) as residentName, users.dateofbirth, users.civilStat, users.userGender, users.userPurok, users.userType, users.startedLiving 
            FROM members 
            INNER JOIN residentcategory ON members.residentCatID=residentcategory.residentCatID
            INNER JOIN users ON members.UsersID=users.UsersID
            WHERE residentcategory.residentCatName='{$_GET['residentPrint']}'
            ORDER BY FIELD(userType, 'Captain', 'Purok Leader', 'Secretary', 'Treasurer', 'Councilor', 'Resident')");
        elseif($_GET['purok'] != 'All'):
            $pdf->SetWidths(array(35,25,25,25,25,25,30));
            $pdf->SetAligns(array('C','C','C','C','C','C','C'));
            $pdf->AddCol('residentName', 30, 'Name', 'C');
            $pdf->AddCol('dateofbirth', 30, 'Birthdate', 'C');
            $pdf->AddCol('civilStat', 30, 'Civil Status', 'C');
            $pdf->AddCol('userGender', 30, 'Gender', 'C');
            $pdf->AddCol('userPurok', 30, 'Purok', 'C');
            $pdf->AddCol('userType', 30, 'Type', 'C');
            $pdf->AddCol('startedLiving', 30, 'Started Living', 'C');

            $pdf->Table($conn,"SELECT concat(users.Firstname, ' ', users.Middlename, ', ' , users.Lastname) as residentName, users.dateofbirth, users.civilStat, users.userGender, users.userPurok, users.userType, users.startedLiving 
            FROM members 
            INNER JOIN residentcategory ON members.residentCatID=residentcategory.residentCatID
            INNER JOIN users ON members.UsersID=users.UsersID
            WHERE residentcategory.residentCatName='{$_GET['residentPrint']}' AND users.userPurok='{$_GET['purok']}'
            ORDER BY FIELD(userType, 'Captain', 'Purok Leader', 'Secretary', 'Treasurer', 'Councilor', 'Resident')");
        endif;
    endif;
endif;
$pdf->Output();

?>
