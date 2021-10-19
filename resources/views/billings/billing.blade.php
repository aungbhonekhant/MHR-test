@extends('../layouts.master')

@section('content')
<a href="/billings/create" class="btn btn-success mb-3">Create client</a>
{{-- message --}}
@if (Session::has('billing_deleted'))
<div class="callout callout-success mt-2 mx-2">
    <p>{{ Session::get('billing_deleted') }}</p>
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
      <h3 class="card-title">Billing list</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Amount</th>
            <th>Due Date</th>
            <th>Client</th>
            <th>Description</th>
            <th style="width: 90px" colspan="2">action</th>
          </tr>
        </thead>
        <tbody>
            @if(!empty($billings) && $billings->count())
                @foreach ($billings as  $billing)
                    <tr>
                        <td>{{ $billing->amount }}</td>
                        <td>{{ $billing->due_date }}</td>
                        <td>
                            {{ $billing->client->name }}
                        </td>
                        <td>
                            {{ $billing->description }}
                        </td>
                        <td>
                            <a href={{ route('billings.edit', $billing->id) }}><i class="fas fa-edit text-primary"></i></a>
                        </td>
                        <td>
                            <form action={{ route('billings.destroy', $billing->id) }} method="POST">
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
        {!! $billings->links() !!}
    </div>
  </div>
@endsection