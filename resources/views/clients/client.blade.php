@extends('../layouts.master')

@section('content')
<a href="/clients/create" class="btn btn-success mb-3">Create client</a>
{{-- message --}}
@if (Session::has('client_deleted'))
<div class="callout callout-success mt-2 mx-2">
    <p>{{ Session::get('client_deleted') }}</p>
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
<div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Clients list</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>name</th>
            <th>photo</th>
            <th>email</th>
            <th>phone</th>
            <th>address</th>
            <th style="width: 90px" colspan="2">action</th>
          </tr>
        </thead>
        <tbody>
            @if(!empty($clients) && $clients->count())
                @foreach ($clients as  $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td><img src="{{ asset('storage')}}/{{ $client->photo }}" alt="{{ $client->name }}" style="max-width: 60px"></td>
                        <td>
                            {{ $client->email }}
                        </td>
                        <td>
                            {{ $client->phone }}
                        </td>
                        <td>
                            {{ $client-> address }}
                        </td>
                        <td>
                            <a href={{ route('clients.edit', $client->id) }}><i class="fas fa-edit text-primary"></i></a>
                        </td>
                        <td>
                            <form action={{ route('clients.destroy', $client->id) }} method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">There are no data.</td>
                </tr>
            @endif
            
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {!! $clients->links() !!}
    </div>
  </div>
@endsection