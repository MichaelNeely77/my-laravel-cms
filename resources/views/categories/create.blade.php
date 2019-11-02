@extends('layouts.app')

@section('content')


<div class="card card-default">
    <div class="card-header">
        Create New Category
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <a href="" class="btn btn-success">
                    Add Category
                </a>

            </div>
        </form>
    </div>
</div>

@endsection


