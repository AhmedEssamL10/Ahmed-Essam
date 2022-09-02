@extends('layouts.parent')
@section('title', 'all products')
@section('content')
<div class="col-12">
    <table class="table" id="example1">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Update Date</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th>{{$product->id}}</th>
                    <td>{{$product->code}}</td>
                    <td>{{$product->en_name}} - {{$product->ar_name}}</td>
                    <td>{{$product->price}} EGP</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->status == 1 ? 'Active' : 'Not Active'}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('products.edit',$product->id) }}"> Edit </a><!--$product->id passing id to url-->
                        <a class="btn btn-outline-danger" href=""> Delete </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection


