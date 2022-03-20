<?php 
include 'dbh.inc.php'; 
session_start();
?>

<?php if(isset($_GET["electionID"])): ?>
<div class="container-fluid">
    <form action="includes/manageCandidate.inc.php" class="user" method="post">
        <div class="form-group">
            <div class="col-sm-7">
                <select class="form-select form-select-lg" id="resident" name="resident" required>
                    <option value="none" disabled hidden selected>Resident Name</option>
                    <?php $residents = $conn->query("SELECT * FROM users 
                                                    WHERE users.userType = 'Resident'
                                                    AND userBarangay='Paknaan' 
                                                    AND userPurok='Kamatis'");
                        while($brow = $residents->fetch_assoc()): 
                            if(in_array($brow['UsersID'], $_SESSION['arrayCandidate'])){ continue; }?>  
                            <option value="<?php echo $brow['UsersID'] ?>"><?php echo $brow["Firstname"].' '.$brow["Lastname"] ?></option>
                        <?php 
                            endwhile; 
                        ?>
                </select>
                <!-- <input type="text" class="form-control form-control-sm" id="UsersID"
                name="UsersID" placeholder="Users ID#" value=""> -->
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7">
                <select name="electionTerm" id="electionTerm" class="form-control form-control-sm form-select d-inline">
                    <option value="none" hidden selected>Election Term</option>
                    <?php
                        $election = $conn->query("SELECT * FROM election WHERE electionID={$_GET['electionID']}");
                        while($erow=$election->fetch_assoc()):
                    ?>
                    <option value="<?php echo $erow["electionID"] ?>" selected><?php echo $erow["electionTitle"] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7">
                <select name="position" id="position" class="form-control form-control-sm form-select d-inline">
                    <option value="Purok Leader" selected>Purok Leader</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7">
                <textarea cols="30" rows="3" name="platform" id="platform" class="form-control comment-textfield" style="resize:none;" placeholder="Platform"></textarea>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET["id"])): ?>
    <?php 
        $id = $_GET["id"];
        $candidates = $conn->query("SELECT candidates.*, election.electionTitle FROM candidates INNER JOIN election ON candidates.electionID = election.electionID WHERE candidateID = $id");
        while($row=$candidates->fetch_assoc()):
    ?>
        <div class="container-fluid">
            <form action="includes/manageCandidate.inc.php?id=<?php echo $row["candidateID"] ?>" class="user" method="post">
                <div class="form-group">
                    <div class="col-sm-7">
                        <select name="electionTerm" id="electionTerm" class="form-control form-control-sm form-select d-inline">
                            <option value="<?php echo $row["electionID"] ?>" hidden selected><?php echo $row["electionTitle"] ?></option>
                            <?php
                                $election = $conn->query("SELECT * FROM election WHERE electionStatus='Active'");
                                while($erow=$election->fetch_assoc()):
                            ?>
                            <option value="<?php echo $erow["electionID"] ?>"><?php echo $erow["electionTitle"] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7">
                        <select name="position" id="position" class="form-control form-control-sm form-select d-inline">
                            <option value="<?php echo $row["position"] ?>" hidden selected><?php echo $row["position"] ?></option>
                            <option value="Captain">Captain</option>
                            <option value="Purok Leader">Purok Leader</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Secretary">Secretary</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7" id="inputArea">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7">
                        <textarea cols="30" rows="3" name="platform" id="platform" class="form-control comment-textfield" style="resize:none;" placeholder="Platform"><?php echo $row["platform"] ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    <?php endwhile; ?>

<?php endif; ?>

<script>
$("#position").change(function () {
  var numInputs = $(this).val();
  if(numInputs == "Purok Leader"){
    $("#inputArea").append(
        '<select name="purokArea" id="purok" class="form-control form-control-sm" />');
  }
  else{
      $("#purok").remove();
  }
});

    
</script>