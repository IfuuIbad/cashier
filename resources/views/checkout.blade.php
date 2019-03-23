@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Checkout
                </div>
                <div class="card-body">
                    <form action="{{ route('transaction.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Price</label>

                            <div class="input-group col-sm-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="total" value="{{ $totalPrice }}"
                                    placeholder="0" readonly required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Pay</label>

                            <div class="input-group col-sm-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="pay_total" placeholder="0"
                                    min="{{ $totalPrice }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date" value="{{ date('d F Y') }}"
                                    disabled>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cart
                </div>
                <div class="card-body">

                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemCarts as $cart)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $cart->item->name }}</td>
                                <td>{{ $cart->item->category->name }}</td>
                                <td>
                                    <img src="{{ asset('images/' . $cart->item->image) }}" width="50px" height="50px">
                                </td>
                                <td>Rp {{ $cart->item->price }}</td>
                                <td>{{ $cart->item->cart->quantity }}</td>
                                <td>Rp {{ $cart->item->price * $cart->quantity }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#ubahJumlah{{ $loop->iteration }}">Ubah</button>
                                    <form action="{{ route('cart.destroy', $cart) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>

                                    <div class="modal fade" id="ubahJumlah{{ $loop->iteration }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Jumlah '{{ $cart->item->name }}'</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('cart.update', $cart) }}" method="post">
                                                        @csrf
                                                        @method('PATCH')

                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="number" min="1"
                                                                    max="{{ $cart->item->stock }}"
                                                                    value="{{ $cart->quantity }}" class="form-control"
                                                                    name="quantity" placeholder="Masukkan jumlah..."
                                                                    required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">pcs</span>
                                                                    <button type="submit"
                                                                        class="btn btn-primary float-right">Change</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
