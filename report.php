<?php include_once 'header.php' ?>
<div class="col d-flex flex-column">
    <div class="container-fluid">
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
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
<?php include_once 'footer.php' ?>