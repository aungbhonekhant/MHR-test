@extends('../layouts.master')

@section('content')
<a href="/" class="btn btn-success mb-3">Home</a>
<div class="card card-secondary">
    <div class="card-header">
         <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    {{-- message --}}
    @if (Session::has('billing_updated'))
        <div class="callout callout-success mt-2 mx-2">
            <p>{{ Session::get('billing_updated') }}</p>
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
    <form method="POST" action={{ route('billings.update', $billing->id) }} enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" value={{ $billing->amount }} class="form-control" id="amount" placeholder="Enter amount">
            </div>
            <div class="form-group">
                <label>Due Date </label>
                <input type="date" name="due_date" value={{ $billing->due_date }} class="form-control">
            </div>
            <div class="form-group">
                <label>Select Client</label>
                <select class="form-control" name="client_id" value={{ $billing->client_id }}>
                  <option>{{ $billing->client->name }}</option>

                  @foreach ($clients as $client)
                  <option value="{{ $client->id }}">{{ $client->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ $billing->description }}</textarea>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection