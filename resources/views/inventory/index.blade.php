@extends('layouts.app')

@section('content')

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Inventory <span class="float-right">Total: {{ number_format($inventory->total()) }}</span></div>

                            <div class="card-body float-right">
@if ($flag === '404')
                                <div class="alert alert-warning" role="alert">
                                    Couldn't find anything using search: "{{ $type }}"    
                                </div>
@endif
                                <form class="form-inline" method="GET" action="/inventory">
                                    <label class="sr-only" for="inlineFormInputName2">Product ID | SKU</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" name="search-query" placeholder="Product ID or SKU" value="{{ $active_query ? $active_query : '' }}">

                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    
                                    <a class="btn btn-outline-primary mb-2 ml-2" href="/inventory" role="button">Clear</a>
                                </form>
                            </div>

                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
@foreach ($inventory as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->color }}</td>
                                            <td>{{ $item->size }}</td>
                                        </tr>
@endforeach
                                    </tbody>
                                </table>

                                {{ $inventory->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection