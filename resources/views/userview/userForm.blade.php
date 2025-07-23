<!DOCTYPE html><html lang="en">
<head>
   @include('userview.css')
  <style>
 
  .form-container {
    background: #fff;
    max-width: 1100px;
    margin-left: 350px; margin-top: 50px;
    border-radius: 8px;
    box-shadow: 0 2px 8px #fcdbcc;
    padding: 32px 40px 40px 40px;
  }
  h2 {
    text-align: center;
    margin-bottom: 16px;
    font-size: 1.5em;
    font-weight: 500;
    letter-spacing: 1px;
  }
  .section-title {
    font-weight: 500;
    margin-top: 28px;
    margin-bottom: 10px;
    color: #2d3a4b;
    font-size: 1.1em;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 3px;
  }
  label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: 500;
  }
  input[type="text"], input[type="date"], input[type="time"], textarea {
    width: 100%;
    padding: 7px 10px;
    margin-bottom: 14px;
    border: 1px solid #bfc9d1;
    border-radius: 4px;
    font-size: 1em;
    background: #fafbfc;
  }
  textarea {
    min-height: 50px;
    resize: vertical;
  }
  .row {
    display: flex;
    gap: 18px;
  }
  .col {
    flex: 1;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 18px;
    background: #f7f8fa;
  }
  th, td {
    border: 1px solid #bfc9d1;
    padding: 7px 8px;
    text-align: left;
    font-size: 1em;
  }
  th {
    background: #eaf0f6;
    font-weight: 500;
  }
  .checkbox-group {
    margin-bottom: 10px;
  }
  .checkbox-group label {
    margin-right: 16px;
    font-weight: 400;
  }
  .signature-section {
    margin-top: 30px;
    border-top: 1px dashed #bfc9d1;
    padding-top: 16px;
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
  }
  .signature-box {
    flex: 1;
    min-width: 240px;
  }
  .signature-line {
    margin-top: 30px;
    border-bottom: 1px solid #bfc9d1;
    width: 80%;
    margin-bottom: 8px;
  }
  .approval-section {
    margin-top: 32px;
    border-top: 2px solid #e0e0e0;
    padding-top: 20px;
  }
  .approval-table th, .approval-table td {
    background: #fff;
  }
  .driver-section {
    margin-top: 32px;
    border-top: 2px solid #e0e0e0;
    padding-top: 20px;
  }
  .note {
    font-size: 0.95em;
    color: #666;
    margin-top: 18px;
  }
  @media (max-width: 700px) {
    .form-container {
      padding: 16px 4vw;
    }
    .row {
      flex-direction: column;
      gap: 0;
    }
  }

  </style>
</head>

<body>

     <!-- START Wrapper -->
     <div class="wrapper">

          <!-- ========== Topbar Start ========== -->
          @include('userview.header')

          <!-- Activity Timeline -->
          @include('userview.topFeatureBar')
          <!-- ========== Topbar End ========== -->
          <!-- ========== Left Sidebar Start ========== -->
    <div class="form-container">
    <h2>VEHICLE REQUISITION FORM FOR OUTSTATION TRIP</h2>
    <div class="note">(To be submitted to the Transport Division at least 03 working days prior to departure date)</div>

    <div class="section-title">Applicant Details</div>
    <div class="row">
      <div class="col">
        <label>1. Service No. and Name of Applicant:</label>
        <input type="text" name="service_no_name">
      </div>
      <div class="col">
        <label>2. Designation:</label>
        <input type="text" name="designation">
      </div>
      <div class="col">
        <label>3. Department:</label>
        <input type="text" name="department">
      </div>
    </div>
    <label>4. Contact No./s:</label>
    <input type="text" name="contact_no">

    <label>5. Purpose of Travelling:</label>
    <textarea name="purpose"></textarea>

    <div class="checkbox-group">
      <label>Supporting Document(s) attached:</label>
      <input type="checkbox" name="supporting_docs" value="yes"> Yes
      <input type="checkbox" name="supporting_docs" value="no"> No
    </div>

    <div class="section-title">6. Name(s) of Person(s) Travelling</div>
    <table>
      <tr>
        <th>SN</th>
        <th>Service No.</th>
        <th>Name</th>
      </tr>
      <tr>
        <td>i.</td>
        <td><input type="text" name="sn1_service_no"></td>
        <td><input type="text" name="sn1_name"></td>
      </tr>
      <tr>
        <td>ii.</td>
        <td><input type="text" name="sn2_service_no"></td>
        <td><input type="text" name="sn2_name"></td>
      </tr>
      <tr>
        <td>iii.</td>
        <td><input type="text" name="sn3_service_no"></td>
        <td><input type="text" name="sn3_name"></td>
      </tr>
      <tr>
        <td>iv.</td>
        <td><input type="text" name="sn4_service_no"></td>
        <td><input type="text" name="sn4_name"></td>
      </tr>
      <tr>
        <td>v.</td>
        <td><input type="text" name="sn5_service_no"></td>
        <td><input type="text" name="sn5_name"></td>
      </tr>
    </table>

    <div class="section-title">7. Proposed Journey</div>
    <div class="row">
      <div class="col">
        <label>From:</label>
        <input type="text" name="from">
      </div>
      <div class="col">
        <label>To:</label>
        <input type="text" name="to">
      </div>
    </div>
    <div class="row">
      <div class="col">
        <label>8. Date & Time of Departure:</label>
        <input type="date" name="departure_date">
        <input type="time" name="departure_time">
      </div>
      <div class="col">
        <label>9. Date & Time of Return (From Outstation):</label>
        <input type="date" name="return_date">
        <input type="time" name="return_time">
      </div>
    </div>
    <label>10. Proposed Route:</label>
    <input type="text" name="route">
    <label>11. Name of the place to park vehicle:</label>
    <input type="text" name="parking_place">
    <div class="note">In Colombo, the vehicle should be parked at APC, Mt. Lavinia</div>

    <div class="section-title">12. Tentative Programme</div>
    <table>
      <tr>
        <th>Day</th>
        <th>Date</th>
        <th>Place(s) to be visited</th>
      </tr>
      <tr>
        <td>01</td>
        <td><input type="date" name="prog1_date"></td>
        <td><input type="text" name="prog1_place"></td>
      </tr>
      <tr>
        <td>02</td>
        <td><input type="date" name="prog2_date"></td>
        <td><input type="text" name="prog2_place"></td>
      </tr>
      <tr>
        <td>03</td>
        <td><input type="date" name="prog3_date"></td>
        <td><input type="text" name="prog3_place"></td>
      </tr>
      <tr>
        <td>04</td>
        <td><input type="date" name="prog4_date"></td>
        <td><input type="text" name="prog4_place"></td>
      </tr>
    </table>

    <div class="note">
      I am aware of the general instructions on the usage of University vehicles and declare that I will take full care and responsibility of the vehicle during the period of the trip.
    </div>

    <div class="signature-section">
      <div class="signature-box">
        <label>Signature of the Applicant</label>
        <div class="signature-line"></div>
        <label>Date:</label>
        <input type="date" name="applicant_date">
      </div>
      <div class="signature-box">
        <label>Head of the Department / Division</label>
        <div class="signature-line"></div>
        <label>Date:</label>
        <input type="date" name="hod_date">
      </div>
    </div>

    <div class="approval-section">
      <div class="section-title">Recommendation of Deputy Registrar / General Administration</div>
      <table class="approval-table">
        <tr>
          <td>
            <label>Recommended / Not Recommended</label>
            <input type="text" name="dr_recommendation">
            <br>
            <label>Deputy Registrar / General Administration</label>
            <br>
            <label>Date:</label>
            <input type="date" name="dr_date">
          </td>
          <td>
            <label>Comments (if any):</label>
            <textarea name="dr_comments"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <label>Approved / Not Approved</label>
            <input type="text" name="vc_approval">
            <br>
            <label>Vice-Chancellor / Registrar</label>
          </td>
          <td>
            <label>Reservation of Vehicle and Driver</label>
            <br>
            Vehicle No.: <input type="text" name="vehicle_no"><br>
            Driver: <input type="text" name="driver">
          </td>
        </tr>
      </table>
    </div>

    <div class="driver-section">
      <div class="section-title">To be filled by the Driver</div>
      <label>1. Meter reading at the start of journey:</label>
      <input type="text" name="start_meter">

      <table>
        <tr>
          <th>Date</th>
          <th>Place Visited</th>
          <th>KM</th>
          <th>Sign. (Officer)</th>
        </tr>
        <tr>
          <td><input type="date" name="day1_date"></td>
          <td><input type="text" name="day1_place"></td>
          <td><input type="text" name="day1_km"></td>
          <td><input type="text" name="day1_sign"></td>
        </tr>
        <tr>
          <td><input type="date" name="day2_date"></td>
          <td><input type="text" name="day2_place"></td>
          <td><input type="text" name="day2_km"></td>
          <td><input type="text" name="day2_sign"></td>
        </tr>
        <tr>
          <td><input type="date" name="day3_date"></td>
          <td><input type="text" name="day3_place"></td>
          <td><input type="text" name="day3_km"></td>
          <td><input type="text" name="day3_sign"></td>
        </tr>
        <tr>
          <td><input type="date" name="day4_date"></td>
          <td><input type="text" name="day4_place"></td>
          <td><input type="text" name="day4_km"></td>
          <td><input type="text" name="day4_sign"></td>
        </tr>
        <tr>
          <td><input type="date" name="day5_date"></td>
          <td><input type="text" name="day5_place"></td>
          <td><input type="text" name="day5_km"></td>
          <td><input type="text" name="day5_sign"></td>
        </tr>
      </table>
      <label>2. Final Meter reading (at SEUSL):</label>
      <input type="text" name="final_meter">
      <label>3. Total Mileage (KM):</label>
      <input type="text" name="total_mileage">
      <label>4. Reports, if any damages / defects:</label>
      <textarea name="damage_report"></textarea>

      <div class="row">
        <div class="col">
          <label>Driver's Name:</label>
          <input type="text" name="driver_name">
        </div>
        <div class="col">
          <label>Signature:</label>
          <input type="text" name="driver_signature">
        </div>
        <div class="col">
          <label>Date:</label>
          <input type="date" name="driver_date">
        </div>
      </div>
    </div>

    <div class="section-title">Certified Correct</div>
    <div style="margin-bottom: 32px;">
      <input type="text" name="certified_correct" style="width: 40%;">
    </div>
    <div class="note">
      <strong>Note:</strong>
      <br>1. To be returned by Driver to DR / General Administration after completion of the trip.
      <br>2. Travelling & Subsistence will be paid only after receipt of this form.
    </div>
  </div>

          <!-- ========== App Menu Start ========== -->
          @include('userview.appMenu')
          <!-- ========== App Menu End ========== -->

          <!-- ==================================================== -->
          <!-- Start right Content here -->
          <!-- ==================================================== -->
          
          <!-- ==================================================== -->
          <!-- End Page Content -->
          <!-- ==================================================== -->

     </div>
     <!-- END Wrapper -->

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="admincss/js/vendor.js"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="admincss/js/app.js"></script>

     <!-- Vector Map Js -->
     <script src="admincss/js/jsvectormap.min.js"></script>
     <script src="admincss/js/world-merc.js"></script>
     <script src="admincss/js/world.js"></script>

     <!-- Dashboard Js -->
     <script src="admincss/js/dashboard.js"></script>



</body></html>