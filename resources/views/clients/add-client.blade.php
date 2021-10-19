@extends('../layouts.master')

@section('content')
<a href="/" class="btn btn-success mb-3">Home</a>
<div class="card card-secondary">
    <div class="card-header">
         <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    {{-- message --}}
    @if (Session::has('client_added'))
        <div class="callout callout-success mt-2 mx-2">
            <p>{{ Session::get('client_added') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="callout callout-danger mt-2 mx-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- form start -->
    <form method="POST" action={{ route('clients.store') }} enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" rows="3" placeholder="Enter ..."></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection