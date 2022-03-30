<?php include 'header.php' ?>

<div class="container p-4">
    <div class="card shadow mb-4 m-4">
        <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Document</h6>
        </div>
        <div class="card-body" style="font-size: 100%">
            <div class="container">
                <div class="row">
                    <div class="col">
                        Document Type: 
                        <select name="documentType" id="documentType">
                            <option value="">Select document type</option>
                            <option value="cedula">Cedula</option>
                            <option value="barangayclearance">Barangay Clearance</option>
                            <option value="businesspermit">Business Permit</option>
                            <option value="indigencyclearance">Indigency Clearance</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Purpose: 
                        <input type="text" name="purpose" />
                    </div>
                </div>
            </div>          
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

<?php include 'footer.php' ?>