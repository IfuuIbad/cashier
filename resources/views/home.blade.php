@extends('layouts.app')

@section('nav-right')
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
aria-expanded="false" href="#">Cart @if (count($itemCarts) > 0) {{count($itemCarts)}} @endif </a>
    <div class="dropdown-menu dropdown-menu-right" style="background-color: grey; width: 300px;">
        <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
            <div class="card mx-auto" style="width: 18rem;">
                <div class="card-body" style="width: 286px;
                    height: 216px;
                    overflow: auto;
                ">

                    @if (count($itemCarts) == 0)
                    <h4>Cart Empty</h4>
                    @else

                    @foreach ($itemCarts as $cart)
                    <form action="{{ route('cart.destroy', $cart) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger float-right">remove</button>
                    </form>
                    <h5 class="card-title">{{ $cart->item->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $categories[$cart->item->item_category_id-1]->name }}</h6>
                    <img src="{{asset('images/'. $cart->item->image)}}" style="width: 50px; height: 50px;"
                        class="rounded float-right">
                    <br>
                    <p class="card-text">Qty : {{ $cart->quantity }}</p>
                    <p class="card-text">Price : {{ number_format($cart->item->price, 0, ",", ".") }}</p>
                    <p class="card-text">SubPrice : {{ number_format($cart->item->price * $cart->quantity, 0, ",", ".") }}</p>
                    <div class="dropdown-divider"></div>
                    @endforeach
                    @endif


                </div>
            </div>
        </div>
        <div class="card mx-auto" style="width: 18rem;">
            <div class="card-body">
            <a href="{{ route('cart.index') }}" class="btn btn-sm btn-primary float-right">Checkout</a>
            <p class="card-text">Total Price : {{ number_format($totalPrice, 0, ",", ".") }}</p>
            </div>
        </div>
    </div>
</li>
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 center">
            <div class="card">
                <center>
                    <h1>Item</h1>
                </center>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <img src="{{ asset('images/'.$item->image) }}" width="50px" height="50px">
                                </td>
                                <td>Rp {{ number_format($item->price, 0, ",", ".") }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>
                                    <form action="{{route('cart.store')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                        qty : <input type="number" min="1" max="{{ $item->stock }}" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Add To Cart
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="mx-auto" style="width: 200px;">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
