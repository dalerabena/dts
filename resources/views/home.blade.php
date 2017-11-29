@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.message')
        <div class="col-md-12">
            {{-- <div class="jumbotron">
                <h1 class="display-3">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Click here to download the Users's Manual</a>
                </p>
            </div> --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Open documents
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="20%">Reference Number</th>
                                <th>Subject</th>
                                <th>Date Created</th>
                                <th>Priority</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($documents->count() > 0)
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->reference_number }}</td>
                                        <td>{{ $document->subject }}</td>
                                        <td>{{ $document->created_at }}</td>
                                        <td>{{ $document->priority }}</td>
                                        <td>
                                            <a href="{{ route('documents.show', [ Hashids::encode($document->id) ]) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
