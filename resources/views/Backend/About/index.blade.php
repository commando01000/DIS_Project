@extends('Backend.Shared.layout')

@section('title', 'About')
@section('css')
<style>
    .input-group-text{
        width: 100px;
    }
</style>
@endsection
@section('content')
<div class="input-group">
    <span class="input-group-text">Description</span>
    <input type="text" aria-label="description_en" class="form-control">
    <input type="text" aria-label="description_ar" class="form-control">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
  </div>
@endsection