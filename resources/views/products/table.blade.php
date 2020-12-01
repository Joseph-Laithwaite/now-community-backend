<div class="table-responsive">
    <table class="table" id="products-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Slug</th>
        <th>Price</th>
        <th>Vat</th>
        <th>Deposit</th>
        <th>Is Packaging</th>
        <th>Wholesale</th>
        <th>Public Purchase</th>
        <th>Brand Id</th>
        <th>Location Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
            <td>{{ $product->slug }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->vat }}</td>
            <td>{{ $product->deposit }}</td>
            <td>{{ $product->is_packaging }}</td>
            <td>{{ $product->wholesale }}</td>
            <td>{{ $product->public_purchase }}</td>
            <td>{{ $product->brand_id }}</td>
            <td>{{ $product->location_id }}</td>
                <td>
                    {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('products.show', [$product->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('products.edit', [$product->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
