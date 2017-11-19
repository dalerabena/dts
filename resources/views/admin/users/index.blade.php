@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Office Accounts List
                    </div>
                    <div class="panel-body">
                        @include('partials.message')
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col" width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $value)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->admin ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <form class="" method="POST" action="{{ route('offices.destroy', [ Hashids::encode($value->id) ]) }}" onsubmit="return confirm('Are you sure?');">
                                                {{ csrf_field() }}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                <a href="{{ route('offices.edit', [ Hashids::encode($value->id) ]) }}" class="btn btn-info btn-sm">Edit</a>
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
