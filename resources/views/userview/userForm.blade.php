<!DOCTYPE html><html lang="en">
<head>
   @include('userview.css')
  <style>
 
  .form-container {
    background: #fff;
    max-width: 1100px;
    margin-left: 200px; margin-top: 50px;
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
  input[type="text"], input[type="date"], input[type="time"], textarea, select {
    width: 100%;
    padding: 7px 10px;
    margin-bottom: 14px;
    border: 1px solid #bfc9d1;
    border-radius: 4px;
    font-size: 1em;
    background: #fafbfc;
  }
  .date-input {
    width: 40%;
    display: flex;
    gap: 800px;

  }
  .submit-button{
    background-color: #a7d4f8ff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    
  }
  .submit-button:hover {
    background-color: #2853ffff;
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
    width: 40%;
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
    
    <!-- Success/Error Messages -->
    <div id="message-container" style="display: none; padding: 10px; margin-bottom: 20px; border-radius: 4px;"></div>
    
    <form id="applicationForm" enctype="multipart/form-data">

    <div class="section-title">Applicant Details</div>
    <div class="row">
  <div class="col">
    <label>1. Service No. and Name of Applicant:</label>
    <input type="text" name="service_no_name" required>
  </div>
  <div class="col">
    <label>2. Designation:</label>
    <input type="text" name="designation" required>
  </div>
  <div class="col">
    <label>3. Faculty:</label>
    <select name="faculty" required>
      <option value="">-- Select Faculty --</option>
      <option value="Faculty of Applied Sciences">Faculty of Applied Sciences</option>
      <option value="Faculty of Management Studies">Faculty of Management Studies</option>
      <option value="Faculty of Technology">Faculty of Technology</option>
      <option value="Faculty of Computing">Faculty of Computing</option>
      <option value="Faculty of Social Science and language">Faculty of Social Science and language</option>
      <option value="Faculty of Geomatics">Faculty of Geomatics</option>
      <option value="Faculty of Medicine">Faculty of Medicine</option>
      <option value="Faculty of Agricultural Sciences">Faculty of Agricultural Sciences</option>
    </select>
  </div>
</div>

<div class="row">
  <div class="col">
    <label>4. Department:</label>
    <input type="text" name="department" required>
  </div>
  <div class="col">
    <label>5. Contact No./s:</label>
    <input type="text" name="contact_no" required>
  </div>
</div>

<label>6. Purpose of Travelling:</label>
<textarea name="purpose" required></textarea>


    <div class="checkbox-group">
      <label>Supporting Document(s) attached:</label>
      <input type="radio" name="supporting_docs" value="yes" required> Yes
      <input type="radio" name="supporting_docs" value="no" required> No
    </div>
    
    <!-- File Upload Section for Supporting Documents -->
    <div id="documents-section" style="display: none; margin-top: 10px;">
      <label>Upload Supporting Documents:</label>
      <input type="file" name="supporting_documents[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
      <div class="note">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max 5MB each)</div>
    </div>

    <div class="section-title">6. Name(s) of Person(s) Travelling</div>

<table id="travelers-table">
  <thead>
    <tr>
      <th>SN</th>
      <th>Service No.</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody id="travelers-body">
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
  </tbody>
</table>

<!-- Add Row Button -->
<button type="button" onclick="addRow()" style="margin-bottom: 10px; background-color: #ffffffff; color: black; padding: 6px 12px; border: none; border-radius: 4px; border: 1px solid #ccc; cursor: pointer;">
  + Add Row
</button>


    <div class="section-title">7. Proposed Journey</div>
    <div class="row">
      <div class="col">
        <label>From:</label>
        <input type="text" name="from" required>
      </div>
      <div class="col">
        <label>To:</label>
        <input type="text" name="to" required>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <label>8. Date & Time of Departure:</label>
        <input type="date" name="departure_date" required>
        <input type="time" name="departure_time">
      </div>
      <div class="col">
        <label>9. Date & Time of Return (From Outstation):</label>
        <input type="date" name="return_date" required>
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
    
    <!-- Signature Preview -->
    <div class="signature-preview" style="margin-top: 10px;">
      <img id="applicantSignaturePreview" src="" alt="Signature Preview" style="max-height: 80px; display: none; border: 1px solid #ccc; padding: 4px;">
    </div>

    
    <!-- Upload Signature File -->
    <input type="file" accept="image/*" onchange="previewSignature(event)" name="applicant_signature">
      <br>
    <!-- Date -->
    <label style="margin-top: 10px;">Date:</label>
    <div class="date-input" >
      <input type="date" name="applicant_date" required>
      <button class="submit-button" type="submit" id="submitBtn">
        <span id="submitText">Submit</span>
        <span id="loadingText" style="display: none;">Submitting...</span>
      </button>
    </div>
  </div>
</div>

</form>


    

    
  </div>

          
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
    <script>
      let rowCount = 5; // You already have 5 default rows: i. to v.

      function toRoman(num) {
        const romanMap = [
          ['M', 1000], ['CM', 900], ['D', 500], ['CD', 400],
          ['C', 100], ['XC', 90], ['L', 50], ['XL', 40],
          ['X', 10], ['IX', 9], ['V', 5], ['IV', 4], ['I', 1]
        ];
        let result = '';
        for (const [roman, value] of romanMap) {
          while (num >= value) {
            result += roman;
            num -= value;
          }
        }
        return result.toLowerCase(); // i, ii, iii...
      }

      function addRow() {
        rowCount++;
        const romanSN = toRoman(rowCount); // convert to roman numeral
        const tableBody = document.getElementById("travelers-body");
        const newRow = document.createElement("tr");

        newRow.innerHTML = `
          <td>${romanSN}.</td>
          <td><input type="text" name="sn${rowCount}_service_no"></td>
          <td><input type="text" name="sn${rowCount}_name"></td>
          <td><button type="button" onclick="removeRow(this)">x</button></td>
        `;

        tableBody.appendChild(newRow);
      }

      function removeRow(button) {
        const row = button.closest("tr");
        row.remove();
        updateSN(); // Optional: Re-index Roman numbers after row removal
      }

      function updateSN() {
        const rows = document.querySelectorAll("#travelers-body tr");
        rowCount = rows.length;
        rows.forEach((row, index) => {
          const roman = toRoman(index + 1);
          row.cells[0].innerText = `${roman}.`;
          row.querySelectorAll("input")[0].name = `sn${index + 1}_service_no`;
          row.querySelectorAll("input")[1].name = `sn${index + 1}_name`;
        });
      }

      // Show/hide supporting documents upload section
      document.addEventListener('DOMContentLoaded', function() {
        const supportingDocsRadios = document.querySelectorAll('input[name="supporting_docs"]');
        const documentsSection = document.getElementById('documents-section');
        
        supportingDocsRadios.forEach(radio => {
          radio.addEventListener('change', function() {
            if (this.value === 'yes') {
              documentsSection.style.display = 'block';
            } else {
              documentsSection.style.display = 'none';
            }
          });
        });
      });

      // Initialize CSRF token for AJAX requests
      window.Laravel = {
        csrfToken: '{{ csrf_token() }}'
      };

      // API submission function
      async function submitApplication(formData) {
        try {
          const response = await fetch('/submit-application', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': window.Laravel.csrfToken,
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
          });

          const result = await response.json();
          
          if (response.ok) {
            // Show browser alert first
            alert('Form submitted successfully');
            
            showMessage('success', `Application submitted successfully! Application ID: ${result.data.id}`);
            document.getElementById('applicationForm').reset();
            document.getElementById('applicantSignaturePreview').style.display = 'none';
            
            // Show submission summary
            if (result.data.members_created > 0) {
              setTimeout(() => {
                showMessage('info', `Summary: ${result.data.members_created} members and ${result.data.visits_created} visits added.`);
              }, 2000);
            }
          } else {
            if (result.errors) {
              let errorMsg = 'Please fix the following errors:\n';
              Object.values(result.errors).forEach(errors => {
                errors.forEach(error => errorMsg += `• ${error}\n`);
              });
              throw new Error(errorMsg);
            } else {
              throw new Error(result.message || 'Submission failed');
            }
          }
        } catch (error) {
          console.error('Submission error:', error);
          showMessage('error', error.message);
        }
      }

      // Form submission handler
      document.getElementById('applicationForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingText = document.getElementById('loadingText');
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        loadingText.style.display = 'inline';
        
        try {
          const formData = new FormData(this);
          
          // Add authentication - get current user or use guest system
          // Remove hardcoded user_id as it's now handled by the controller
          
          await submitApplication(formData);
        } finally {
          // Reset button state
          submitBtn.disabled = false;
          submitText.style.display = 'inline';
          loadingText.style.display = 'none';
        }
      });

      // Message display function
      function showMessage(type, message) {
        const container = document.getElementById('message-container');
        let bgColor, textColor, borderColor;
        
        switch(type) {
          case 'success':
            bgColor = '#d4edda';
            textColor = '#155724';
            borderColor = '#c3e6cb';
            break;
          case 'error':
            bgColor = '#f8d7da';
            textColor = '#721c24';
            borderColor = '#f5c6cb';
            break;
          case 'info':
            bgColor = '#d1ecf1';
            textColor = '#0c5460';
            borderColor = '#bee5eb';
            break;
          default:
            bgColor = '#e2e3e5';
            textColor = '#383d41';
            borderColor = '#d6d8db';
        }
        
        container.style.backgroundColor = bgColor;
        container.style.color = textColor;
        container.style.border = `1px solid ${borderColor}`;
        container.innerHTML = message.replace(/\n/g, '<br>');
        container.style.display = 'block';
        
        // Auto-hide after 10 seconds for success, 15 seconds for errors
        const hideTimeout = type === 'error' ? 15000 : 10000;
        setTimeout(() => {
          container.style.display = 'none';
        }, hideTimeout);
      }
    </script>
    <script>
      function previewSignature(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("applicantSignaturePreview");
        
        if (file) {
          preview.src = URL.createObjectURL(file);
          preview.style.display = "block";
        } else {
          preview.src = "";
          preview.style.display = "none";
        }
      }
    </script>





</body></html>