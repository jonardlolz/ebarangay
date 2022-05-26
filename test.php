<?php include 'header.php' ?>
<div class="container-fluid">
  <div class="messaging">
    <div class="inbox_msg">
        <div class="mesgs">
            <div class="msg_history" id="msg_history"><!-- handles the connection to database -->

              <div class="outgoing_msg">
                <div class="sent_msg">
                    <p>Test</p>
                    <span class="time_date"> 05:43 PM   |    May 17</span></div>
              </div>

              <div class="outgoing_msg">
                <div class="sent_msg">
                    <p><img src="img\1633945260_gru.png" alt=""></p>
                    <span class="time_date"> 05:43 PM   |    May 17</span></div>
              </div>
          
        <div class="incoming_msg">
            <div class="incoming_msg_img_name">
                <div class="incoming_msg_img"> 
                    <img class="img-profile rounded-circle img-purokldr-profile" src="./img/profile_picture.jpg" alt="Purok" leader=""> 
                </div>
                <div class="incoming_msg_name"> 
                    <p>Purok Leader</p>
                </div>
            </div>
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p>asdasdasdasdwqeqweqweqwewqwwwwwwwwwwwwwwwwwwwwwwwwwwww</p>
                <span class="time_date"> 01:17 AM   |    May 20 </span></div>
            </div>
        </div>
        <div class="incoming_msg">
            <div class="incoming_msg_img_name">
                <div class="incoming_msg_img"> 
                    <img class="img-profile rounded-circle img-purokldr-profile" src="./img/profile_picture.jpg" alt="Purok" leader=""> 
                </div>
                <div class="incoming_msg_name"> 
                    <p>Purok Leader</p>
                </div>
            </div>
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p> </p>
                <span class="time_date"> 01:17 AM   |    May 20 </span></div>
            </div>
        </div></div>
                                <div class="type_msg m-2">
                                    <div class="input_msg_write">
                                        <input type="text" autocomplete="off" class="write_msg" id="message" placeholder="Type a message" style="width: 100%; resize: none; word-wrap: break-word;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php include 'footer.php' ?>