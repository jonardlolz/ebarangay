<!-- Footer -->
  
  </div>
  </div>
  <footer class="sticky-footer">
      <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright &copy; eBarangay 2021</span>
          </div>
      </div>
  </footer>
</div>
<!-- End of Footer -->

<!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer" style="display: flex !important;">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="view_modal" role='dialog'>
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="continue_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="continue_verify btn btn-primary">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="secondary_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer" style="display: flex !important;">
        <button type="button" class="btn btn-primary" name="submit" id='submit' onclick="$('#secondary_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="print_modal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnPrint">Print</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="verifyInfo" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name="submit" id='submit' onclick="$('#verifyInfo form').submit()">Confirm</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  </div>    
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        
    <!-- Page level plugins -->
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/sb-1.3.3/sp-2.0.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
      document.getElementById("btnPrint").onclick = function() {
        printElement(document.getElementById("printThis"));
        window.print();
      }

      function printElement(elem, append, delimiter) {
        var domClone = elem.cloneNode(true);

        var $printSection = document.getElementById("printSection");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }

        if (append !== true) {
            $printSection.innerHTML = "";
        }

        else if (append === true) {
            if (typeof(delimiter) === "string") {
                $printSection.innerHTML += delimiter;
            }
            else if (typeof(delimiter) === "object") {
                $printSection.appendChlid(delimiter);
            }
        }

        $printSection.appendChild(domClone);
    }
      $('.promptSchedule').click(function(){
          uni_modal("<center><b>Confirm attendance</b></center></center>","includes/ereklamo.inc.php?promptSchedule", "modal-md")
      })
      
      function notificationRead(){
        $.ajax({
          url: './includes/notifications.inc.php?read',
          type: 'POST',
          data: {id:$("notifications").attr('data-id')},
          success: function(data){
            $(".badge-counter").attr("hidden",true);
          }
        })
      }

      const date = new Date();

      $('.respond').click(function(){
          uni_modal("<center><b>Respond to eReklamo</b></center></center>","includes/ereklamo.inc.php?respond&chatroomID="+$(this).attr('data-chat')+"&reklamoid="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'), "modal-lg")
      })

      $.ajax({
        url: './includes/jsdbh.inc.php',
        type: 'GET',
        success: function (data) {
          var obj = jQuery.parseJSON(data);
          var scheduleArray = new Array();
          <?php 
          
          echo "var sessionID = {$_SESSION['UsersID']};";
          echo "var sessionUser = '{$_SESSION['userType']}';";

          ?>
          for(var key in obj){
            if(obj.hasOwnProperty(key)){
              scheduleDate = new Date(obj[key].scheduleDate)
              console.log(key + " -> " + scheduleDate.getDate());
              console.log(key + " -> " + obj[key].ereklamoID);
              console.log(key + " -> " + obj[key].complainee);
              console.log(key + " -> " + obj[key].scheduleTitle);
            }
          }

          // schedule = new Date(obj[0].scheduleDate);
          // console.log(obj[0].ereklamoID);
          // console.log(schedule.getMonth());


      const renderCalendar = () => {
        date.setDate(1);

        const monthDays = document.querySelector(".days");

        const lastDay = new Date(
          date.getFullYear(),
          date.getMonth() + 1,
          0
        ).getDate();

        const prevLastDay = new Date(
          date.getFullYear(),
          date.getMonth(),
          0
        ).getDate();

        const firstDayIndex = date.getDay();

        const lastDayIndex = new Date(
          date.getFullYear(),
          date.getMonth() + 1,
          0
        ).getDay();

        const nextDays = 7 - lastDayIndex - 1;

        const months = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];

        document.querySelector(".date h1").innerHTML = months[date.getMonth()];

        document.querySelector(".date p").innerHTML = new Date().toDateString();

        let days = "";

        for (let x = firstDayIndex; x > 0; x--) {
          days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
        }


        for (var i = 1; i <= lastDay; i++) {
          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              scheduleDate = new Date(obj[key].scheduleDate)
              if (i === scheduleDate.getDate() && scheduleDate.getMonth() === new Date().getMonth()) {
                if((sessionID == obj[key].UsersID || sessionID == obj[key].complainee) || sessionUser == 'Captain'){
                  days += `<span title="${obj[key].scheduleTitle}"><div class="scheduleToday" id=${obj[key].UsersID}>${i}</div></span>`;
                  break;
                }
              } 
            }
            if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()){
              days += `<div class="today">${i}</div>`;
              
            }
            else {
              days += `<div>${i}</div>`;
            }
            break;
          }
        }


        for (let j = 1; j <= nextDays; j++) {
          days += `<div class="next-date">${j}</div>`;
        }
        monthDays.innerHTML = days;
      };

      document.querySelector(".prev").addEventListener("click", () => {
        date.setMonth(date.getMonth() - 1);
        renderCalendar();
      });

      document.querySelector(".next").addEventListener("click", () => {
        date.setMonth(date.getMonth() + 1);
        renderCalendar();
      });

      renderCalendar();

        }
      });

    </script>


</body>



</html>