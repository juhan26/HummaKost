<!-- resources/views/financials/index.blade.php -->

@extends('app')

@section('content')
    <div class="container">
        {{-- Store Modal --}}

        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Add User</button>

        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password:</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- Store Modal --}}
        <h1>Financial Data</h1>


        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Payment Proof</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Types</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Financial Date</th>
                        <th>Has Paid Until</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($financials as $index => $financial)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $financial->payment_proof }}</td>
                            <td>{{ $financial->users->name }}</td>
                            <td>{{ $financial->amount }}</td>
                            <td>{{ $financial->types }}</td>
                            <td>{{ $financial->nominal }}</td>
                            <td>{{ $financial->status }}</td>
                            <td>{{ $financial->financial_date }}</td>
                            <td>{{ $financial->has_paid_until }}</td>
                            <td>
                                {{--  --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                Data is Empty
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $financials->links() }}
    </div>
@endsection
