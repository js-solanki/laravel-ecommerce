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
                                <div class="col-2">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        onclick="window.location='{{ route('admin-product-list') }}'">back</button>
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
                            <div class="row card pt-25">
                                <div class="col-md-6 grid-margin">
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <span
                                                class="badge badge-success">{{ $product->status ? ' active ' : ' inactive ' }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Name :</strong>
                                            {{ $product->product_name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Description :</strong>
                                            {{ $product->description }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Price:</strong>
                                            ${{ $product->price }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Quantity Available:</strong>
                                            {{ $product->quantity_available }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Weight:</strong>
                                            {{ $product->weight }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Brand:</strong>
                                            {{ $product->brand }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>Manufacturer:</strong>
                                            {{ $product->manufacturer }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin">
                                            <strong>SKU:</strong>
                                            {{ $product->sku }}
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 grid-margin">
                                    @if ($product->images)
                                    @foreach (json_decode($product->images) as $image)

                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->product_name }}"
                                        style="width: 100px;">
                                    @endforeach
                                    @endif
                                </div>
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