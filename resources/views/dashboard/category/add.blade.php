<!DOCTYPE html>
<html lang="en">

<x-adminheader />

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <x-nav />
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
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Category Management</h3>
                                    <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                            class="text-primary">3 unread alerts!</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Category form</h4>
                                    <p class="card-description">
                                        Basic form layout
                                    </p>
                                    <form method="POST" class="forms-sample"
                                    action="{{ isset($category) ? route('admin-update-catgeory', $category->id) : route('admin-insert-catgeory') }}"
                                       >
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">name</label>
                                            <input type="text" class="form-control" id="exampleInputUsername1" value="{{ isset($category) ? $category->name : '' }}"
                                                name="name" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Status</label>
                                            <select class="form-control form-control-lg" name="status"
                                                id="exampleFormControlSelect1">
                                                <option value="1" {{ (isset($category) && $category->status == 1) ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ (isset($category) && $category->status == 0) ? 'selected' : '' }}>inActive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="button" class="btn btn-light">Cancel</button>
                                    </form>
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
