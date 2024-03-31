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
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Product Management</h3>
                                    <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session('success'))
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
                    <div class="row card">
                        <div class="card-body">
                            <h4 class="card-title">Product form</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="POST" class="forms-sample" action="{{ route('admin-insert-role') }}">
                                   @csrf
                                   <!-- <p class="card-description">
                                    
                                   </p> -->
                                   <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Status</label>
                                                <select class="form-control form-control-lg" name="status" id="exampleFormControlSelect1">
                                                    <option value="1">Active</option>
                                                    <option value="0">inActive</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <select class="js-example-basic-multiple w-100" multiple="multiple">
                                            
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="file" name="images[]" multiple><br>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                           
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity_available">Quantity Available</label>
                                                <input type="text" class="form-control" id="quantity_available"  name="quantity_available" placeholder="Quantity Available" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="weight">Weight</label>
                                                <input type="text" class="form-control" id="weight"  name="weight" placeholder="Weight" >
                                            </div>
                                            <div class="form-group">
                                                <label for="brand">Brand</label>
                                                <input type="text" class="form-control" id="brand"  name="brand" placeholder="Brand" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="brand">Manufacturer</label>
                                                <input type="text" class="form-control" id="manufacturer"  name="manufacturer" placeholder="Manufacturer" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="SKU">SKU</label>
                                                <input type="text" class="form-control" id="SKU"  name="sku" placeholder="SKU">
                                            </div>   
                                        </div>
                                    </div>
                                </form>
                                 
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                    
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