<!-- Footer -->
  <footer class="sticky-footer">
      <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright &copy; eBarangay 2021</span>
          </div>
      </div>
  </footer>
  </div>
  </div>

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
        <div class="modal-footer">
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
        <button type="button" class="btn btn-primary" name="submit" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
    const date = new Date();

    $.ajax({
      url: './includes/jsdbh.inc.php',
      type: 'GET',
      success: function (data) {
        var obj = jQuery.parseJSON(data);
        var scheduleArray = [];
        scheduleArray.push(obj);

        //console.log(obj[0].scheduleDate);
        $.each(obj, function(idx, jq) {
          console.log(jq.scheduleDate + " " + jq.ereklamoID);
        });

        schedule = new Date(obj[0].scheduleDate);
        //console.log(schedule.getMonth());


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
        if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()){
          days += `<div class="today">${i}</div>`;
          
        } 
        else if (i === schedule.getDate() && schedule.getMonth() === new Date().getMonth()){
          days += `<div class="today">${i}</div>`;
        }
        else {
          days += `<div>${i}</div>`;
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