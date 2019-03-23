@extends('layouts.app')

@section('content')
<div class="container">
    <center><h1>Transaksi</h1></center>

    <table class="table table-striped mt-3">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Total Price</th>
                <th scope="col">Total Pay</th>
                <th scope="col">Total Change</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr onclick="window.location='{{ route('transaction.show', $transaction) }}'" style="cursor: pointer">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $transaction->user->name }}</td>
                    <td>Rp {{ number_format($transaction->total, 0, ",", ".") }}</td>
                    <td>Rp {{ number_format($transaction->pay_total, 0, ",", ".") }}</td>
                    <td>Rp {{ number_format($transaction->change_total, 0, ",", ".") }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
