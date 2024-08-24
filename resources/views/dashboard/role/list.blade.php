<!DOCTYPE html>
<html lang="en">

<x-adminheader />

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
      
        <x-nav/>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <x-adminheadersetting />
            <x-adminrightment />
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <x-adminsidebar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-10 col-xl-6 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Role Management</h3>
                                    <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                                </div>
                                <div class="col-2 col-xl-2 mb-4 mb-xl-0">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn" onclick="window.location='{{ route('admin-add-role') }}'">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-0">Role</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($roles->isEmpty())
                                                <tr>
                                                    <td colspan="4">No content</td>
                                                </tr>
                                            @else
                                                @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{$role->id}}</td>
                                                    <td>{{$role->name}}</td>
                                                    <td>{{$role->status ? ' active ': ' inactive '}}</td>
                                                    <td class="font-weight-medium">
                                                        <a class="badge badge-info" href="{{ route('admin-role-edit', $role->id) }}" >edit</a>
                                                        <a class="badge badge-danger"  href="{{ route('admin-role-delete', $role->id) }}" >delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <div>{{ $roles->links() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <x-adminfooter />
</body>

</html>