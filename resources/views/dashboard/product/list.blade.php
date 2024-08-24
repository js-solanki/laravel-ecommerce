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
                                <div class="col-10 col-xl-6 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Product Management</h3>
                                    <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
                                </div>
                                <div class="col-2 col-xl-2 mb-4 mb-xl-0">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        onclick="window.location='{{ route('admin-add-product') }}'">Add</button>
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
                                    <p class="card-title mb-0">Products</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>image</th>
                                                    <th>name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($products->isEmpty())
                                                <tr>
                                                    <td colspan="5">No content</td>
                                                </tr>
                                                @else
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>

                                                        @if ($product->images)
                                                        @foreach (json_decode($product->images) as $image)

                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            alt="{{ $product->product_name }}" style="width: 100px;">
                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->status ? ' active ' : ' inactive ' }}</td>
                                                    <td class="font-weight-medium">
                                                        <a class="badge badge-info"
                                                            href="{{ route('admin-product-edit', $product->id) }}">edit</a>
                                                        <a class="badge badge-danger"
                                                            href="{{ route('admin-product-delete', $product->id) }}">delete</a>
                                                        <a class="btn btn-link btn-fw"
                                                            href="{{ route('admin-product-detail', $product->id) }}">Description</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <div>{{ $products->links() }}</div>
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