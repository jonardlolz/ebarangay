<?php 
include 'dbh.inc.php';
session_start();
?>

<?php if(isset($_GET['addPurpose']) || isset($_GET['editPurpose'])): ?>
<div class="container-fluid">
    <?php if(isset($_GET['addPurpose'])): ?>
        <form action="includes/document.inc.php?add&docuType=<?php echo $_GET['docuType'] ?>" method="POST">
    <?php elseif(isset($_GET['editPurpose'])): ?>
        <form action="includes/document.inc.php?edit&docuType=<?php echo $_GET['docuType'] ?>&purposeID=<?php echo $_GET['purposeID'] ?>" method="POST">
    <?php endif; ?>
        <?php if(isset($_GET['editPurpose'])){
            $sql = $conn->query("SELECT * FROM documentpurpose WHERE purposeID='{$_GET['purposeID']}'");
            $editPurpose = $sql->fetch_assoc();
        } ?>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Document name: </label>
            </div>
            <div class="col-sm-6">
                <label><b><?php if(isset($_GET['docuName'])){ echo $_GET['docuName']; }?></b></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Purpose:</label>
            </div>
            <div class="col-sm-4">
                <input type="text" name="purpose" placeholder="Purpose" 
                <?php if(isset($_GET['editPurpose'])): ?> 
                    value="<?php echo $editPurpose['purpose'] ?>">
                <?php endif; ?>
                </input>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['addRequirement']) || isset($_GET['editRequirement'])): ?>
<div class="container-fluid">
    <?php if(isset($_GET['addRequirement'])): ?>
        <form action="includes/document.inc.php?addRequirementPost&docuType=<?php echo $_GET['docuType'] ?>" method="POST">
    <?php elseif(isset($_GET['editRequirement'])): ?>
        <form action="includes/document.inc.php?editRequirementPost&docuType=<?php echo $_GET['docuType'] ?>&requirementID=<?php echo $_GET['requirementID'] ?>" method="POST">
    <?php endif; ?>
        <?php if(isset($_GET['editRequirement'])){
            $sql = $conn->query("SELECT * FROM requirementlist WHERE requirementID='{$_GET['requirementID']}'");
            $editPurpose = $sql->fetch_assoc();
        } ?>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Requirement Name:</label>
            </div>
            <div class="col-sm-4">
                <input type="text" name="requirementName" placeholder="Requirement Name" 
                <?php if(isset($_GET['editRequirement'])): ?> 
                    value="<?php echo $editPurpose['requirementName'] ?>">
                <?php endif; ?>
                </input>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['viewPurpose'])): 
    $purposeSql = $conn->query("SELECT documentpurpose.*, documenttype.* FROM documentpurpose LEFT JOIN documenttype ON barangayDoc=documentID WHERE barangayDoc='{$_GET['docuType']}' AND barangay='{$_SESSION['userBarangay']}'");
    $purpose = $purposeSql->fetch_assoc();
?>
<style>
    #uni_modal .modal-footer{
        display: none;
    }
</style>
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="purposes-tab" data-toggle="tab" href="#purposes" role="tab" aria-controls="purposes" aria-selected="false">Purposes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="requirements-tab" data-toggle="tab" href="#requirements" role="tab" aria-controls="requirements" aria-selected="false">Requirements</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            <div class="container-fluid m-3">
                <?php $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID={$_GET['docuType']}");
                $documentinfo = $sql->fetch_assoc(); ?>
                <form action="includes/document.inc.php?postdocumentEdit&barangayid=<?php echo $documentinfo['DocumentID'] ?>" method="POST">
                    <div class="form-group col">
                        <div class="form-group row">
                            <div class="col">
                                Document name:
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" name="documentName" value="<?php echo $documentinfo['documentName'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                Document description:
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" name="documentDesc" value="<?php echo $documentinfo['documentDesc'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                Include fee?
                            </div>
                            <div class="col">
                                <input type="checkbox" onchange="showPriceField()" name="documentFee" id="allowFee" value="True" <?php if($documentinfo['allowFee'] == 'True'){ echo 'checked';}  ?>>
                            </div>
                        </div>
                        <div class="form-group row" id="priceField">
                            <div class="col">
                                Price: 
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" name="documentPrice" id="documentPrice" value="<?php echo $documentinfo['docPrice'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                Voter required?
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <input type="radio" id="voterTrue" onchange="checkVoter()" name="requiredVoter" value="True" <?php if($documentinfo['VoterRequired'] == 'True'){ echo 'checked'; }  ?>>
                                        <label for="voterTrue">True</label>
                                    </div>
                                    <div class="col">
                                        <input type="radio" id="voterFalse" onchange="checkVoter()" name="requiredVoter" value="False" <?php if($documentinfo['VoterRequired'] == 'False'){ echo 'checked'; }  ?>>
                                        <label for="voterFalse">False</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 m-2" id="lesseeSection" style="display: none; border-width: 1px; border-style: solid; border-color: #C6C3C3">
                            <div class="form-group row">
                                <div class="col">
                                    Minimum months residing in Barangay:
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-sm" type="number" name="minimumMos" value="<?php echo $documentinfo['minimumMos'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    Allow lessee?
                                </div>
                                <div class="col">
                                    <input type="checkbox" onchange="showNoteField()" name="allowLessee" id="allowLessee" value="True" <?php if($documentinfo['allowLessee'] == 'True'){ echo 'checked'; }  ?>>
                                </div>
                            </div>
                            <div class="form-group row" id="requireNoteField" style="display: none;">
                                <div class="col">
                                    Require note from Lessor?
                                </div>
                                <div class="col">
                                    <input type="checkbox" name="requireNote" id="requireNote" value="True" <?php if($documentinfo['requireLessorNote'] == 'True'){ echo 'checked'; }  ?>>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col">
                                Minimum months residing in Barangay:
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="number" name="minimumMos">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                Allow lessee?
                            </div>
                            <div class="col">
                                <input type="checkbox" onchange="showNoteField()" name="allowLessee" id="allowLessee" value="True">
                            </div>
                        </div>
                        <div class="form-group row" id="requireNoteField">
                            <div class="col">
                                Require note from Lessor?
                            </div>
                            <div class="col">
                                <input type="checkbox" name="requireNote" id="requireNote" value="True">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                Required voter?
                            </div>
                            <div class="col">
                                <input type="checkbox" name="requiredVoter" id="requiredVoter" value="True">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                Include fee?
                            </div>
                            <div class="col">
                                <input type="checkbox" onchange="showPriceField()" name="documentFee" id="allowFee" value="True" checked>
                            </div>
                        </div>
                        <div class="form-group row" id="priceField">
                            <div class="col">
                                Price: 
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" name="documentPrice" id="documentPrice" value="1">
                            </div>
                        </div> -->
                    </div>
                    <hr>
                    <div class="d-flex flex-row-reverse">
                        <button type="submit "class="btn-sm btn-success">Save</button>
                    </div>
                </form>
                <script>
                    checkVoter();
                    showNoteField();
                    function checkVoter(){
                        var requiredVoterTrue = document.getElementById("voterTrue");
                        var requiredVoterFalse = document.getElementById("voterFalse");
                        lesseeSection.style.display = requiredVoterFalse.checked ? "block" : "none";
                    }
                    
                    function showNoteField(){
                        var allowLessee = document.getElementById("allowLessee");
                        requireNoteField.style.display = allowLessee.checked ? "flex" : "none";
                    }
                    function showPriceField(){
                        var allowFee = document.getElementById("allowFee");
                        priceField.style.display = allowFee.checked ? "flex" : "none";
                    }
                </script>
            </div>
        </div>
        <div class="tab-pane fade" id="purposes" role="tabpanel" aria-labelledby="purposes-tab">
            <div class="container-fluid">
                <div class="d-flex flex-row-reverse m-2">
                    <button class="btn btn-primary add_purpose" data-id="<?php echo $_GET['docuType'] ?>" data-docu="<?php echo $_GET['docuName'] ?>">Add Purpose</button>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr class="bg-gradient-secondary text-white">
                                    <th>Purpose</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql=$conn->query("SELECT * FROM documentpurpose WHERE barangayDoc='{$_GET['docuType']}' AND barangay='{$_SESSION['userBarangay']}'");
                                    $x = 0;
                                    while($row=$sql->fetch_assoc()):
                                    
                                ?>
                                <tr>
                                    <td><?php echo $row['purpose'] ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="edit_purpose" data-id="<?php echo $_GET['docuType'] ?>" data-docu="<?php echo $_GET['docuName'] ?>" data-purposeid="<?php echo $row['purposeID'] ?>"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="delete_purpose" data-id="<?php echo $row['purposeID'] ?>" data-docu="<?php echo $row['purposeID'] ?>"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                
                                <?php 
                                    $x++; endwhile; 
                                    if($x <= 0):
                                ?>
                                <tr>
                                    <td colspan="6" class="align-center">No data in this table.</td>
                                    
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row-reverse m-2">
                    <button class="btn btn-primary add_requirement" data-id="<?php echo $_GET['docuType'] ?>" data-docu="<?php echo $_GET['docuName'] ?>">Add Requirement</button>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr class="bg-gradient-secondary text-white">
                                    <th>Requirement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql=$conn->query("SELECT * FROM requirementlist WHERE DocumentID={$_GET['docuType']}");
                                    $x = 0;
                                    while($row=$sql->fetch_assoc()):
                                    
                                ?>
                                <tr>
                                    <td><?php echo $row['requirementName'] ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="edit_requirement" data-id="<?php echo $row['requirementID'] ?>" data-docu="<?php echo $_GET['docuType'] ?>"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="delete_requirement" data-id="<?php echo $row['requirementID'] ?>" data-docu="<?php echo $row['requirementID'] ?>"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                
                                <?php 
                                    $x++; endwhile; 
                                    if($x <= 0):
                                ?>
                                <tr>
                                    <td colspan="6" class="align-center">No data in this table.</td>
                                    
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php elseif(isset($_GET['addDocument'])): ?>

<div class="container-fluid">
    <form action="includes/document.inc.php?postdocumentAdd&barangay=<?php echo $_GET['barangay'] ?>" method="POST">
        <div class="form-group col">
            <div class="form-group row">
                <div class="col">
                    Document name:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentName" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Document description:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentDesc" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Include fee?
                </div>
                <div class="col">
                    <input type="checkbox" onchange="showPriceField()" name="documentFee" id="allowFee" value="True" checked>
                </div>
            </div>
            <div class="form-group row" id="priceField">
                <div class="col">
                    Price: 
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentPrice" id="documentPrice" value="1" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Voter required?
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="voterTrue" onchange="checkVoter()" name="requiredVoter" value="True">
                            <label for="voterTrue">True</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="voterFalse" onchange="checkVoter()" name="requiredVoter" value="False">
                            <label for="voterFalse">False</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 m-2" id="lesseeSection" style="display: none; border-width: 1px; border-style: solid; border-color: #C6C3C3">
                <div class="form-group row">
                    <div class="col">
                        Minimum months residing in Barangay:
                    </div>
                    <div class="col">
                        <input class="form-control form-control-sm" type="number" name="minimumMos">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        Allow lessee?
                    </div>
                    <div class="col">
                        <input type="checkbox" onchange="showNoteField()" name="allowLessee" id="allowLessee" value="True">
                    </div>
                </div>
                <div class="form-group row" id="requireNoteField" style="display: none;">
                    <div class="col">
                        Require note from Lessor?
                    </div>
                    <div class="col">
                        <input type="checkbox" name="requireNote" id="requireNote" value="True">
                    </div>
                </div>
            </div>
            <div class="alert alert-danger m-2">
                <p>Please fill all the required fields.</p>
            </div>
            <!-- <div class="form-group row">
                <div class="col">
                    Minimum months residing in Barangay:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="number" name="minimumMos">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Allow lessee?
                </div>
                <div class="col">
                    <input type="checkbox" onchange="showNoteField()" name="allowLessee" id="allowLessee" value="True">
                </div>
            </div>
            <div class="form-group row" id="requireNoteField">
                <div class="col">
                    Require note from Lessor?
                </div>
                <div class="col">
                    <input type="checkbox" name="requireNote" id="requireNote" value="True">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Required voter?
                </div>
                <div class="col">
                    <input type="checkbox" name="requiredVoter" id="requiredVoter" value="True">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Include fee?
                </div>
                <div class="col">
                    <input type="checkbox" onchange="showPriceField()" name="documentFee" id="allowFee" value="True" checked>
                </div>
            </div>
            <div class="form-group row" id="priceField">
                <div class="col">
                    Price: 
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentPrice" id="documentPrice" value="1">
                </div>
            </div> -->
        </div>
    </form>
    <script>
        function checkVoter(){
            var requiredVoterTrue = document.getElementById("voterTrue");
            var requiredVoterFalse = document.getElementById("voterFalse");
            lesseeSection.style.display = requiredVoterFalse.checked ? "block" : "none";
        }
        function showNoteField(){
            var allowLessee = document.getElementById("allowLessee");
            requireNoteField.style.display = allowLessee.checked ? "flex" : "none";
        }

        function showPriceField(){
            var allowFee = document.getElementById("allowFee");
            priceField.style.display = allowFee.checked ? "flex" : "none";
        }
    </script>
</div>

<?php elseif(isset($_GET['editDocument'])): ?>

<div class="container-fluid">
    <?php $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID={$_GET['documentid']}");
    $documentinfo = $sql->fetch_assoc(); ?>
    <form action="includes/document.inc.php?postdocumentEdit&barangayid=<?php echo $documentinfo['DocumentID'] ?>" method="POST">
        <div class="form-group col">
            <div class="form-group row">
                <div class="col">
                    Document name:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentName" value="<?php echo $documentinfo['documentName'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Document description:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentDesc" value="<?php echo $documentinfo['documentDesc'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Include fee?
                </div>
                <div class="col">
                    <input type="checkbox" onchange="showPriceField()" name="documentFee" id="allowFee" value="True" <?php if($documentinfo['allowFee'] == 'True'){ echo 'checked';}  ?>>
                </div>
            </div>
            <div class="form-group row" id="priceField">
                <div class="col">
                    Price: 
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentPrice" id="documentPrice" value="<?php echo $documentinfo['docPrice'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Voter required?
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="voterTrue" onchange="checkVoter()" name="requiredVoter" value="True" <?php if($documentinfo['VoterRequired'] == 'True'){ echo 'checked'; }  ?>>
                            <label for="voterTrue">True</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="voterFalse" onchange="checkVoter()" name="requiredVoter" value="False" <?php if($documentinfo['VoterRequired'] == 'True'){ echo 'checked'; }  ?>>
                            <label for="voterFalse">False</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 m-2" id="lesseeSection" style="display: none; border-width: 1px; border-style: solid; border-color: #C6C3C3">
                <div class="form-group row">
                    <div class="col">
                        Minimum months residing in Barangay:
                    </div>
                    <div class="col">
                        <input class="form-control form-control-sm" type="number" name="minimumMos" value="<?php echo $documentinfo['minimumMos'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        Allow lessee?
                    </div>
                    <div class="col">
                        <input type="checkbox" onchange="showNoteField()" name="allowLessee" id="allowLessee" value="True" <?php if($documentinfo['allowLessee'] == 'True'){ echo 'checked'; }  ?>>
                    </div>
                </div>
                <div class="form-group row" id="requireNoteField" style="display: none;">
                    <div class="col">
                        Require note from Lessor?
                    </div>
                    <div class="col">
                        <input type="checkbox" name="requireNote" id="requireNote" value="True" <?php if($documentinfo['requireLessorNote'] == 'True'){ echo 'checked'; }  ?>>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col">
                    Minimum months residing in Barangay:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="number" name="minimumMos">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Allow lessee?
                </div>
                <div class="col">
                    <input type="checkbox" onchange="showNoteField()" name="allowLessee" id="allowLessee" value="True">
                </div>
            </div>
            <div class="form-group row" id="requireNoteField">
                <div class="col">
                    Require note from Lessor?
                </div>
                <div class="col">
                    <input type="checkbox" name="requireNote" id="requireNote" value="True">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Required voter?
                </div>
                <div class="col">
                    <input type="checkbox" name="requiredVoter" id="requiredVoter" value="True">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Include fee?
                </div>
                <div class="col">
                    <input type="checkbox" onchange="showPriceField()" name="documentFee" id="allowFee" value="True" checked>
                </div>
            </div>
            <div class="form-group row" id="priceField">
                <div class="col">
                    Price: 
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentPrice" id="documentPrice" value="1">
                </div>
            </div> -->
        </div>
    </form>
    
    <script>
        checkVoter();
        showNoteField();
        function checkVoter(){
            var requiredVoterTrue = document.getElementById("voterTrue");
            var requiredVoterFalse = document.getElementById("voterFalse");
            lesseeSection.style.display = requiredVoterFalse.checked ? "block" : "none";
        }
        
        function showNoteField(){
            var allowLessee = document.getElementById("allowLessee");
            requireNoteField.style.display = allowLessee.checked ? "flex" : "none";
        }
        function showPriceField(){
            var allowFee = document.getElementById("allowFee");
            priceField.style.display = allowFee.checked ? "flex" : "none";
        }
    </script>
</div>

<?php elseif(isset($_GET['delete'])):
    extract($_POST);
    $sql = $conn->query("DELETE FROM documentpurpose WHERE purposeID = $id");
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../document.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../document.php?error=none"); //no errors were made
    exit();
?>

<?php elseif(isset($_GET['delete_document'])):
    extract($_POST);
    $sql = "DELETE FROM documenttype WHERE DocumentID=$id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../request.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();

?>

<?php elseif(isset($_GET['add'])): 
    extract($_POST);
    $sql = "INSERT INTO documentpurpose(purpose, barangayDoc, barangay)
            VALUES('$purpose', '{$_GET['docuType']}', '{$_SESSION['userBarangay']}')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
    
?>
<?php elseif(isset($_GET['edit'])):
    extract($_POST);
    $sql = "UPDATE documentpurpose SET purpose='$purpose' WHERE purposeID={$_GET['purposeID']}";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
?>

<?php elseif(isset($_GET['addRequirementPost'])): 
    extract($_POST);
    $sql = "INSERT INTO requirementlist(requirementName, DocumentID)
            VALUES('$requirementName', '{$_GET['docuType']}')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
    
?>
<?php elseif(isset($_GET['editRequirementPost'])):
    extract($_POST);
    $sql = "UPDATE requirementlist SET requirementName='$requirementName' WHERE requirementID={$_GET['requirementID']}";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
?>
<?php elseif(isset($_GET['deleteRequirement'])):
    extract($_POST);
    $sql = "DELETE FROM requirementlist WHERE requirementID=$id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
?>

<?php elseif(isset($_GET['postdocumentAdd'])): 
    extract($_POST);
    
    if($documentFee == ''){
        $documentFee = 'False';
        $documentPrice = '0';
    }
    if($requiredVoter == 'True'){
        $minimumMos = 0;
        $allowLessee = 'False';
        $requireNote = 'False';
    }
    elseif($requiredVoter == 'False'){
        if($allowLessee == 'False'){
            $requireNote = 'False';
        }
    }

    $sql = "INSERT INTO documenttype(documentName, barangayName, documentDesc, allowFee, docPrice, VoterRequired, minimumMos, allowLessee, requireLessorNote)
            VALUES('$documentName', '{$_GET['barangay']}', '$documentDesc', '$documentFee', '$documentPrice', '$requiredVoter', '$minimumMos', '$allowLessee', '$requireNote')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
    
?>
<?php elseif(isset($_GET['postdocumentEdit'])): 
    extract($_POST);
    
    if($documentFee == ''){
        $documentFee = 'False';
        $documentPrice = '0';
    }
    if($requiredVoter == 'True'){
        $minimumMos = 0;
        $allowLessee = 'False';
        $requireNote = 'False';
    }
    elseif($requiredVoter == 'False'){
        if($allowLessee == ''){
            $allowLessee = 'False';
            $requireNote = 'False';
        }
        elseif($allowLessee == 'True'){
            if($requireNote == ''){
                $requireNote = 'False';
            }
        }
    }


    $sql = "UPDATE documenttype SET documentName='$documentName', allowFee='$documentFee', documentdesc='$documentDesc', docPrice='$documentPrice', minimumMos='$minimumMos', VoterRequired='$requiredVoter', allowLessee='$allowLessee', requireLessorNote='$requireNote' WHERE DocumentID={$_GET['barangayid']}";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../services.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../services.php?error=none"); //no errors were made
    exit();
    
?>
<?php endif; ?>

<script>
    window.start_load = function(){
    $('body').prepend('<div id="preloader2"></div>')
    }
    window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
        })
    }
    window.viewer_modal = function($src = ''){
    start_load()
    var t = $src.split('.')
    t = t[1]
    if(t =='mp4'){
        var view = $("<video src='"+$src+"' controls autoplay></video>")
    }else{
        var view = $("<img src='"+$src+"' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
            show:true,
            backdrop:'static',
            keyboard:false,
            focus:true
            })
            end_load()  

}
    window.uni_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size)
                    }else{
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#uni_modal').modal({
                    show:true,
                    backdrop:'static',
                    keyboard:false,
                    focus:true
                    })
                    end_load()
                }
            }
        })
    }
    window.secondary_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#secondary_modal .modal-title').html($title)
                    $('#secondary_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#secondary_modal .modal-dialog').addClass($size)
                    }else{
                        $('#secondary_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#secondary_modal').modal({
                    show:true,
                    backdrop:'static',
                    keyboard:false,
                    focus:true
                    })
                    end_load()
                }
            }
        })
    }
    window._conf = function($msg='',$func='',$params = []){
        $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
        $('#confirm_modal .modal-body').html($msg)
        $('#confirm_modal').modal('show')
    }
    window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
        var Toast = Swal.mixin({
        toast: true,
        position: $pos || 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
        Toast.fire({
        icon: $bg,
        title: $msg
        })
    }

    $('.comment-textfield').on('keypress', function (e) {
        if(e.which == 13 && e.shiftKey == false){
            if($('#preload2').length <= 0){
                start_load();
            }else{
                return false;
            }
            var post_id = $(this).attr('data-id')
            var comment = $(this).val()
            $(this).val('')
            $.ajax({
                url:'ajax.php?action=save_comment',
                method:'POST',
                data:{post_id:post_id,comment:comment},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            var cfield = $('#comment-clone .card-comment').clone()
                            cfield.find('.img-circle').attr('src','assets/uploads/'+resp.data.profile_pic)
                            cfield.find('.uname').text(resp.data.name)
                            cfield.find('.comment').html(resp.data.comment)
                            cfield.find('.timestamp').text(resp.data.timestamp)
                        $('.post-card[data-id="'+post_id+'"]').find('.card-comments').append(cfield)
                        var cc = $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text();
                            cc = cc.replace(/,/g,'');
                            cc = parseInt(cc) + 1
                        $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text(cc)
                        }else{
                            alert_toast("An error occured","danger")
                        }
                        end_load()
                    }
                }
            })
            return false;
        }
    })

    $('.add_purpose').click(function(){
        secondary_modal("<center><b>Add purpose for " + $(this).attr('data-docu') + "</b></center></center>","includes/document.inc.php?addPurpose&docuName="+$(this).attr('data-docu')+"&docuType="+$(this).attr('data-id'));
    })
    $('.edit_purpose').click(function(){
        secondary_modal("<center><b>Edit purpose for " + $(this).attr('data-docu') + "</b></center></center>","includes/document.inc.php?editPurpose&docuName="+$(this).attr('data-docu')+"&docuType="+$(this).attr('data-id')+"&purposeID="+$(this).attr('data-purposeid'));
    })
    $('.delete_purpose').click(function(){
        _conf("Are you sure you want to delete this purpose?","deletePurpose",[$(this).attr('data-id')]);
    })
    $('.add_requirement').click(function(){
        secondary_modal("<center><b>Add requirement for " + "<?php echo $documentinfo['documentName'] ?>" + "</b></center></center>","includes/document.inc.php?addRequirement&docuName="+$(this).attr('data-docu')+"&docuType="+$(this).attr('data-id'));
    })
    $('.edit_requirement').click(function(){
        secondary_modal("<center><b>Edit requirement for " + "<?php echo $documentinfo['documentName'] ?>" + "</b></center></center>","includes/document.inc.php?editRequirement&docuType="+$(this).attr('data-docu')+"&requirementID="+$(this).attr('data-id'));
    })
    $('.delete_requirement').click(function(){
        _conf("Are you sure you want to delete this requirement?","deleteRequirement",[$(this).attr('data-id')]);
    })
    function deletePurpose($id){
        start_load()
        $.ajax({
            url:'includes/document.inc.php?delete',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
    function deleteRequirement($id){
        start_load()
        $.ajax({
            url:'includes/document.inc.php?deleteRequirement',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
</script>