<?php include_once 'header.php' ?>
<?php if($_SESSION['userType'] == 'Captain'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
                                    <!--Right Options-->
                                </tr>
                                <?php endwhile; ?>
                                <!--Row 1-->
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Purok Leader'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
                                    <!--Right Options-->
                                </tr>
                                <?php endwhile; ?>
                                <!--Row 1-->
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Secretary'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
                                    <!--Right Options-->
                                </tr>
                                <?php endwhile; ?>
                                <!--Row 1-->
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Treasurer'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Report Type</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">From</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}' AND reportType='Request'");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["ReportType"] ?></td>
                                            <td><?php echo $row["reportMessage"] ?></td>
                                            <td><?php echo $row["UsersID"] ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Councilor'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
                                    <!--Right Options-->
                                </tr>
                                <?php endwhile; ?>
                                <!--Row 1-->
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
                                    <!--Right Options-->
                                </tr>
                                <?php endwhile; ?>
                                <!--Row 1-->
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php endif; ?>
<?php include_once 'footer.php' ?>