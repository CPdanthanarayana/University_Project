<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Dashboard</title>
     <!-- Bootstrap 5 CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
     <style>
          .sidebar {
               min-height: 100vh;
               background-color: #212529;
          }

          .sidebar .nav-link {
               color: rgba(255, 255, 255, 0.75);
               padding: 12px 20px;
               border-radius: 5px;
               margin-bottom: 5px;
          }

          .sidebar .nav-link:hover,
          .sidebar .nav-link.active {
               background-color: #495057;
               color: white;
          }

          .sidebar .nav-link i {
               margin-right: 10px;
          }

          .stat-card {
               border-left: 4px solid #0d6efd;
               transition: transform 0.3s;
          }

          .stat-card:hover {
               transform: translateY(-5px);
          }

          .table-responsive {
               max-height: 500px;
          }

     </style>
</head>

<body>
     <div class="container-fluid">
          <div class="row">
               <!-- Sidebar -->
               <div class="col-md-3 col-lg-2 p-0 sidebar">
                    <div class="d-flex flex-column p-3">
                         <a href="#"
                              class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                              <span class="fs-4">Admin Panel</span>
                         </a>
                         <hr>
                         <div class="dropdown">
                              <a href="#"
                                   class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                   id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                   <img src="https://placehold.co/40x40"
                                        alt="Admin profile picture showing a professional headshot with grey background"
                                        class="rounded-circle me-2">
                                   <strong>Admin</strong>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                   aria-labelledby="dropdownUser1">
                                   <li><a class="dropdown-item" href="#">Profile</a></li>
                                   <li><a class="dropdown-item" href="#">Settings</a></li>
                                   <li>
                                        <hr class="dropdown-divider">
                                   </li>
                                   <li><a class="dropdown-item" href="#">Sign out</a></li>
                              </ul>
                         </div>
                         <hr>
                         <ul class="nav nav-pills flex-column mb-auto">
                              <li class="nav-item">
                                   <a href="#" class="nav-link active" aria-current="page">
                                        <i class="bi bi-speedometer2"></i>
                                        Dashboard
                                   </a>
                              </li>
                         </ul>
                    </div>
               </div>

               <!-- Main Content -->
               <div class="col-md-9 col-lg-10 ms-sm-auto p-0">
                    <div class="container-fluid p-4">
                         <div
                              class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                              <h1 class="h2">Dashboard</h1>
                              <div class="btn-toolbar mb-2 mb-md-0">
                                   <div class="btn-group me-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                                   </div>
                                   <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                        <i class="bi bi-calendar"></i> This week
                                   </button>
                              </div>
                         </div>

                         <!-- Messages Table -->
                         <div class="card shadow mb-4">
                              <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                   <h6 class="m-0 font-weight-bold text-primary">User Messages</h6>
                                   <button class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add New</button>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                             <thead>
                                                  <tr>
                                                       <th>ID</th>
                                                       <th>Name</th>
                                                       <th>Email</th>
                                                       <th>Approval</th>
                                                       <th>Form</th>
                                                       <th>Date</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <td>1</td>
                                                       <td>
                                                            <div class="d-flex align-items-center">
                                                                 <img src="https://placehold.co/30x30"
                                                                      alt="Profile picture of John Doe, male with short brown hair"
                                                                      class="rounded-circle me-2" width="30"
                                                                      height="30">
                                                                 <div>John Doe</div>
                                                            </div>
                                                       </td>
                                                       <td>john@example.com</td>
                                                       <td>
                                                            <button class="btn btn-primary Approve-btn">Approve</button>
                                                       </td>
                                                       <td><a href="#" data-bs-toggle="modal" data-bs-target="#applicationModal" data-application-id="1">Form</a></td>
                                                       <td>2023-05-12</td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                   </div>
                                   <div class="d-flex justify-content-between mt-3">
                                        <div>
                                             <select class="form-select form-select-sm" style="width: 80px;">
                                                  <option>5</option>
                                                  <option selected>10</option>
                                                  <option>25</option>
                                                  <option>50</option>
                                             </select>
                                        </div>
                                        <nav aria-label="Page navigation">
                                             <ul class="pagination pagination-sm">
                                                  <li class="page-item disabled">
                                                       <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                  </li>
                                                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                  <li class="page-item">
                                                       <a class="page-link" href="#">Next</a>
                                                  </li>
                                             </ul>
                                        </nav>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Bootstrap 5 JS Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

     <!-- Application Details Modal -->
     <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-scrollable">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="applicationModalLabel">Vehicle Requisition Form Details</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <!-- Form content will be loaded here -->
                         <div class="form-container" style="margin: 0 auto; box-shadow: none; padding: 0;">
                              <h2>VEHICLE REQUISITION FORM FOR OUTSTATION TRIP</h2>
                              <div class="note">(To be submitted to the Transport Division at least 03 working days prior to departure date)</div>

                              <div class="section-title">Applicant Details</div>
                              <div class="row">
                                   <div class="col">
                                        <label>1. Service No. and Name of Applicant:</label>
                                        <input type="text" name="service_no_name" readonly>
                                   </div>
                                   <div class="col">
                                        <label>2. Designation:</label>
                                        <input type="text" name="designation" readonly>
                                   </div>
                                   <div class="col">
                                        <label>3. Faculty:</label>
                                        <input type="text" name="faculty" readonly>
                                   </div>
                              </div>

                              <div class="row">
                                   <div class="col">
                                        <label>4. Department:</label>
                                        <input type="text" name="department" readonly>
                                   </div>
                                   <div class="col">
                                        <label>5. Contact No./s:</label>
                                        <input type="text" name="contact_no" readonly>
                                   </div>
                              </div>

                              <label>6. Purpose of Travelling:</label>
                              <textarea name="purpose" readonly></textarea>

                              <div class="checkbox-group">
                                   <label>Supporting Document(s) attached:</label>
                                   <input type="checkbox" name="supporting_docs" value="yes" disabled> Yes
                                   <input type="checkbox" name="supporting_docs" value="no" disabled> No
                              </div>

                              <div class="section-title">6. Name(s) of Person(s) Travelling</div>

                              <table id="travelers-table-modal">
                                   <thead>
                                        <tr>
                                             <th>SN</th>
                                             <th>Service No.</th>
                                             <th>Name</th>
                                        </tr>
                                   </thead>
                                   <tbody id="travelers-body-modal">
                                        <!-- Dynamic rows will be inserted here by JS -->
                                   </tbody>
                              </table>

                              <div class="section-title">7. Proposed Journey</div>
                              <div class="row">
                                   <div class="col">
                                        <label>From:</label>
                                        <input type="text" name="from_location" readonly>
                                   </div>
                                   <div class="col">
                                        <label>To:</label>
                                        <input type="text" name="to_location" readonly>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col">
                                        <label>8. Date & Time of Departure:</label>
                                        <input type="date" name="departure_date" readonly>
                                        <input type="time" name="departure_time" readonly>
                                   </div>
                                   <div class="col">
                                        <label>9. Date & Time of Return (From Outstation):</label>
                                        <input type="date" name="return_date" readonly>
                                        <input type="time" name="return_time" readonly>
                                   </div>
                              </div>
                              <label>10. Proposed Route:</label>
                              <input type="text" name="route" readonly>
                              <label>11. Name of the place to park vehicle:</label>
                              <input type="text" name="parking_place" readonly>
                              <div class="note">In Colombo, the vehicle should be parked at APC, Mt. Lavinia</div>

                              <div class="section-title">12. Tentative Programme</div>
                              <table id="program-table-modal">
                                   <thead>
                                        <tr>
                                             <th>Day</th>
                                             <th>Date</th>
                                             <th>Place(s) to be visited</th>
                                        </tr>
                                   </thead>
                                   <tbody id="program-body-modal">
                                        <!-- Dynamic rows will be inserted here by JS -->
                                   </tbody>
                              </table>

                              <div class="note">
                                   I am aware of the general instructions on the usage of University vehicles and declare that I will take full care and responsibility of the vehicle during the period of the trip.
                              </div>

                              <div class="signature-section">
                                   <div class="signature-box">
                                        <label>Signature of the Applicant</label>
                                        <div class="signature-preview" style="margin-top: 10px;">
                                             <img id="applicantSignaturePreviewModal" src="" alt="Signature Preview" style="max-height: 80px; display: none; border: 1px solid #ccc; padding: 4px;">
                                        </div>
                                        <br>
                                        <label style="margin-top: 10px;">Date:</label>
                                        <div class="date-input">
                                             <input type="date" name="applicant_date" readonly>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
               </div>
          </div>
     </div>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               var applicationModal = document.getElementById('applicationModal');
               applicationModal.addEventListener('show.bs.modal', function(event) {
                    // Button that triggered the modal
                    var button = event.relatedTarget;
                    // Extract info from data-bs-whatever attributes
                    var applicationId = button.getAttribute('data-application-id');

                    // Fetch application data
                    fetch(`/api/applications/${applicationId}`)
                         .then(response => {
                              if (!response.ok) {
                                   throw new Error('Network response was not ok');
                              }
                              return response.json();
                         })
                         .then(data => {
                              // Populate form fields
                              applicationModal.querySelector('[name="service_no_name"]').value = data.service_no_name || '';
                              applicationModal.querySelector('[name="designation"]').value = data.designation || '';
                              applicationModal.querySelector('[name="faculty"]').value = data.faculty || '';
                              applicationModal.querySelector('[name="department"]').value = data.department || '';
                              applicationModal.querySelector('[name="contact_no"]').value = data.contact_no || '';
                              applicationModal.querySelector('[name="purpose"]').value = data.purpose || '';

                              // Supporting documents checkbox
                              const supportingDocsYes = applicationModal.querySelector('[name="supporting_docs"][value="yes"]');
                              const supportingDocsNo = applicationModal.querySelector('[name="supporting_docs"][value="no"]');
                              if (data.supporting_docs) {
                                   supportingDocsYes.checked = true;
                                   supportingDocsNo.checked = false;
                              } else {
                                   supportingDocsYes.checked = false;
                                   supportingDocsNo.checked = true;
                              }

                              // Travelers table
                              const travelersBody = applicationModal.querySelector('#travelers-body-modal');
                              travelersBody.innerHTML = ''; // Clear previous rows
                              if (data.travelers && Array.isArray(data.travelers)) {
                                   data.travelers.forEach((traveler, index) => {
                                        const row = document.createElement('tr');
                                        row.innerHTML = `
                                             <td>${toRoman(index + 1)}.</td>
                                             <td><input type="text" value="${traveler.service_no || ''}" readonly></td>
                                             <td><input type="text" value="${traveler.name || ''}" readonly></td>
                                        `;
                                        travelersBody.appendChild(row);
                                   });
                              }

                              applicationModal.querySelector('[name="from_location"]').value = data.from_location || '';
                              applicationModal.querySelector('[name="to_location"]').value = data.to_location || '';
                              applicationModal.querySelector('[name="departure_date"]').value = data.departure_date || '';
                              applicationModal.querySelector('[name="departure_time"]').value = data.departure_time ? data.departure_time.substring(0, 5) : ''; // Format time
                              applicationModal.querySelector('[name="return_date"]').value = data.return_date || '';
                              applicationModal.querySelector('[name="return_time"]').value = data.return_time ? data.return_time.substring(0, 5) : ''; // Format time
                              applicationModal.querySelector('[name="route"]').value = data.route || '';
                              applicationModal.querySelector('[name="parking_place"]').value = data.parking_place || '';

                              // Program table
                              const programBody = applicationModal.querySelector('#program-body-modal');
                              programBody.innerHTML = ''; // Clear previous rows
                              if (data.program && Array.isArray(data.program)) {
                                   data.program.forEach((item, index) => {
                                        const row = document.createElement('tr');
                                        row.innerHTML = `
                                             <td>${(index + 1).toString().padStart(2, '0')}</td>
                                             <td><input type="date" value="${item.date || ''}" readonly></td>
                                             <td><input type="text" value="${item.place || ''}" readonly></td>
                                        `;
                                        programBody.appendChild(row);
                                   });
                              }

                              // Signature
                              const signaturePreview = applicationModal.querySelector('#applicantSignaturePreviewModal');
                              if (data.applicant_signature_path) {
                                   signaturePreview.src = `/storage/${data.applicant_signature_path}`; // Assuming signatures are stored in storage/app/public
                                   signaturePreview.style.display = 'block';
                              } else {
                                   signaturePreview.src = '';
                                   signaturePreview.style.display = 'none';
                              }
                              applicationModal.querySelector('[name="applicant_date"]').value = data.applicant_date || '';

                         })
                         .catch(error => {
                              console.error('Error fetching application data:', error);
                              alert('Could not load application details. Please try again.');
                         });
               });

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
                    return result.toLowerCase();
               }
          });
     </script>
</body>

</html>
