@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end">
        <a href="{{route('categories.create')}}" class="btn btn-success float-right mb-2">Add Category</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
                <th></th>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>
                            {{ $category->name }}
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                                Edit    
                            </a>                    
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </thead>
        </table>
    </div>
</div>

@endsection


