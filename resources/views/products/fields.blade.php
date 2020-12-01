<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Vat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vat', 'Vat:') !!}
    {!! Form::number('vat', null, ['class' => 'form-control']) !!}
</div>

<!-- Deposit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deposit', 'Deposit:') !!}
    {!! Form::number('deposit', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Packaging Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_packaging', 'Is Packaging:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_packaging', 0) !!}
        {!! Form::checkbox('is_packaging', '1', null) !!}
    </label>
</div>


<!-- Wholesale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wholesale', 'Wholesale:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('wholesale', 0) !!}
        {!! Form::checkbox('wholesale', '1', null) !!}
    </label>
</div>


<!-- Public Purchase Field -->
<div class="form-group col-sm-6">
    {!! Form::label('public_purchase', 'Public Purchase:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('public_purchase', 0) !!}
        {!! Form::checkbox('public_purchase', '1', null) !!}
    </label>
</div>


<!-- Brand Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand_id', 'Brand Id:') !!}
    {!! Form::number('brand_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Location Id:') !!}
    {!! Form::number('location_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
</div>
