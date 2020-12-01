<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $product->slug }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $product->price }}</p>
</div>

<!-- Vat Field -->
<div class="form-group">
    {!! Form::label('vat', 'Vat:') !!}
    <p>{{ $product->vat }}</p>
</div>

<!-- Deposit Field -->
<div class="form-group">
    {!! Form::label('deposit', 'Deposit:') !!}
    <p>{{ $product->deposit }}</p>
</div>

<!-- Is Packaging Field -->
<div class="form-group">
    {!! Form::label('is_packaging', 'Is Packaging:') !!}
    <p>{{ $product->is_packaging }}</p>
</div>

<!-- Wholesale Field -->
<div class="form-group">
    {!! Form::label('wholesale', 'Wholesale:') !!}
    <p>{{ $product->wholesale }}</p>
</div>

<!-- Public Purchase Field -->
<div class="form-group">
    {!! Form::label('public_purchase', 'Public Purchase:') !!}
    <p>{{ $product->public_purchase }}</p>
</div>

<!-- Brand Id Field -->
<div class="form-group">
    {!! Form::label('brand_id', 'Brand Id:') !!}
    <p>{{ $product->brand_id }}</p>
</div>

<!-- Location Id Field -->
<div class="form-group">
    {!! Form::label('location_id', 'Location Id:') !!}
    <p>{{ $product->location_id }}</p>
</div>

