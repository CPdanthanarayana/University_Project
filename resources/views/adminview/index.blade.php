@extends('adminview.layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
                                <img src="https://placehold.co/30x30" alt="Profile picture of John Doe"
                                     class="rounded-circle me-2" width="30" height="30">
                                <div>John Doe</div>
                            </div>
                        </td>
                        <td>john@example.com</td>
                        <td>
                            <button class="btn btn-primary Approve-btn">Approve</button>
                        </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#applicationModal" data-application-id="1">Form</a>
                        </td>
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

<!-- Application Details Modal -->
@include('adminview.application-modal')

@endsection
