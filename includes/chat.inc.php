<?php 
include 'dbh.inc.php';
session_start();

if(isset($_GET['showchat'])){
    $chat=$conn->query("SELECT chat.*, concat(users.Firstname, ' ', users.Lastname) as name, users.profile_pic FROM chat INNER JOIN users ON chat.UsersID=users.UsersID WHERE chatroomID=(SELECT chatroomID FROM chatroom WHERE type='ereklamo' AND idreference={$_GET['reklamoid']})"); 
    $result = "";
    while($chatrow=$chat->fetch_assoc()):
        $date=date_create($chatrow['mesgdate']);
    ?>
    <?php if($_SESSION['UsersID'] != $chatrow['UsersID']): 
        $result .= "
        <div class='incoming_msg'>
            <div class='incoming_msg_img'> <img src='./img/". $chatrow['profile_pic'] . "' alt=". $chatrow['name'] . "> </div>
            <div class='received_msg'>
                <div class='received_withd_msg'>
                    <p>".$chatrow['message']."</p>
                <span class='time_date'> " . date_format($date, 'h:i A') . "   |    " . date_format($date, 'M d') . " </span></div>
            </div>
        </div>";
    ?>
    <?php else: 
        $result .= "<div class='outgoing_msg'>
            <div class='sent_msg'>
                <p>".$chatrow['message']."</p>
                <span class='time_date'> ".date_format($date, 'h:i A')."   |    " . date_format($date, 'M d') . "</span></div>
            </div>
        </div>";
        endif; 
    endwhile; 
    echo $result; 
}

else if(isset($_GET['sendchat'])){
    extract($_POST);
    
    mysqli_begin_transaction($conn);

    $a1 = mysqli_query($conn, "INSERT INTO chat(UsersID, chatroomID, message) VALUES({$_SESSION['UsersID']}, {$_GET['chatroomID']}, '$message')");

    if($a1){
        mysqli_commit($conn);
    }
    else{
        mysqli_rollback($conn);
        exit();
    }
}

?>