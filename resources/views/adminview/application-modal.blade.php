@push('styles')
<link rel="stylesheet" href="{{ asset('admincss/css/application-modal.css') }}">
@endpush
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
                         <div class="form-container">
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
