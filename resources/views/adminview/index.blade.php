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
                                                       <td><a href="">Form</a></td>
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
</body>

</html>