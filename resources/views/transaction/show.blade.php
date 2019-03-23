@extends('layouts.app')

@section('content')
<div class="container">
    <center><h1>Detail Transaksi</h1></center>
    <div class="float-right"><b>{{ date('d F Y', strtotime($transaction->created_at)) }}</b></div>

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
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $detail->item->name }}</td>
                    <td>{{ $detail->item->category->name }}</td>
                    <td>
                        <img src="{{ asset('images/' . $detail->item->image) }}" width="50px" height="50px">
                    </td>
                    <td>Rp {{ number_format($detail->item->price, 0, ",", ".") }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ",", ".") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
