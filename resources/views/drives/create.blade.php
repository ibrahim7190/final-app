@extends('layouts.app')

@section('content')
    <div class="container col-6">
        <h1 class="text-center text-info">Upload File</h1>

        @if (Session::has('done'))
        <div class="alert alert-success mx-auto text-center">
            {{ Session::get('done') }}
        </div>
            
        @endif
        <div class="card">
            <div class="card-body">

                <form action="{{ route('drive.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>File Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>File Description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>File Upload</label>
                        <input type="file" name="inputFile" class="form-control">
                    </div>
                    <button class="mt-2 btn btn-info">Send Data</button>
                </form>

            </div>
        </div>
    </div>
@endsection
