@extends('products.layout')

@section('content')
<body>
    <nav class="navbar navbar-dark bg-light">
      <a class="navbar-brand text-dark" href="#"><b>Product CRUD Laravel 10</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
       </button>
    </nav>


        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-black">Products </h3>
                    <hr>
                    <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addProductModal">
                    <i class="fas fa-user-plus"></i> Add product </button>

                    <table class="table table-bordered">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th> Images</th>
                                <th> Name</th>
                                <th> Description</th>
                                <th> Quantity</th>
                                <th> Price</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                             <tr>
                                <td><img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"></td>
                                <td>{{$product->name}} </td>
                                <td>{{$product->description}} </td>
                                <td>{{$product->quantity}} </td>
                                <td>{{$product->price}} </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editProductModal{{$product->id}}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" action="{{ route('products.delete', ['id' => $product->id])}}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Product Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('products.store')}} " enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel"> Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name"> Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <input type="text" name="description" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="quantity"> Quantity</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price"> Price</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        @foreach($products as $product)
        <div class="modal fade" id="editProductModal{{$product->id}}" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel{{$product->id}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('products.update', ['id' => $product->id]) }}">
                        @method('PUT')
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel{{$product->id}} "><i class="fas fa-edit"></i> Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{$product->name}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <input type="text" name="description" value="{{$product->description}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="quantity"> Quantity</label>
                                <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control"
                                    >
                            </div>
                            <div class="form-group">
                                <label for="price"> Price</label>
                                <input type="number" name="price" value="{{$product->price}}" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
@endsection
