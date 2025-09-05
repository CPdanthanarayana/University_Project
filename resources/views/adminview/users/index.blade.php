@extends('adminview.layout')

@push('styles')
<style>
    .user-table {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .badge-user {
        background-color: #17a2b8;
        color: white;
    }
    
    .badge-admin {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-change-type {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endpush

@section('content')
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">User Management</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">User Management</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card user-table">
                                <div class="card-header">
                                    <h4 class="header-title">All Users</h4>
                                    <p class="text-muted mb-0">Manage user types and permissions</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Faculty</th>
                                                    <th>Department</th>
                                                    <th>User Type</th>
                                                    <th>Joined</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>
                                                        <h5 class="mb-0">{{ $user->name }}</h5>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->contactNo ?? 'N/A' }}</td>
                                                    <td>{{ $user->faculty ?? 'N/A' }}</td>
                                                    <td>{{ $user->department ?? 'N/A' }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $user->user_type == 'admin' ? 'admin' : 'user' }} rounded-pill">
                                                            {{ ucfirst($user->user_type) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary btn-change-type" 
                                                                data-user-id="{{ $user->id }}" 
                                                                data-current-type="{{ $user->user_type }}"
                                                                data-user-name="{{ $user->name }}">
                                                            Change Type
                                                        </button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">No users found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="mt-3">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@push('scripts')

    <!-- Change User Type Modal -->
    <div class="modal fade" id="changeUserTypeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change User Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Change user type for: <strong id="userName"></strong></p>
                    <form id="changeUserTypeForm">
                        <div class="mb-3">
                            <label for="userType" class="form-label">User Type</label>
                            <select class="form-select" id="userType" name="user_type" required>
                                <option value="user">Regular User</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveUserType">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Required JS -->
    <script src="{{ asset('admincss/js/vendor.min.js') }}"></script>
    <script src="{{ asset('admincss/js/app.min.js') }}"></script>

    <script>
        let currentUserId = null;

        // Open modal to change user type
        document.querySelectorAll('.btn-change-type').forEach(button => {
            button.addEventListener('click', function() {
                currentUserId = this.dataset.userId;
                const currentType = this.dataset.currentType;
                const userName = this.dataset.userName;
                
                document.getElementById('userName').textContent = userName;
                document.getElementById('userType').value = currentType;
                
                new bootstrap.Modal(document.getElementById('changeUserTypeModal')).show();
            });
        });

        // Save user type changes
        document.getElementById('saveUserType').addEventListener('click', function() {
            const newUserType = document.getElementById('userType').value;
            
            fetch(`/admin/users/${currentUserId}/update-type`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_type: newUserType
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message and reload page
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error updating user type');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating user type');
            });
        });
    </script>
@endpush
