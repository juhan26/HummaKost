<!-- resources/views/financials/index.blade.php -->

@extends('app')

@section('content')
    <div class="container">

        @hasrole('member|admin')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add
                Financial</button>

            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add Add
                                Financial</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('financial.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id" class="col-form-label">Name:</label>
                                    <input type="hidden" class="form-control" name="user_id" id="user_id"
                                        value="{{ Auth::user()->id }}">
                                    <input type="text" class="form-control" disabled value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="types" class="col-form-label">Type:</label>
                                    <select class="form-select" aria-label="Default select example" name="types"
                                        id="types">
                                        <option selected>Open this select menu</option>
                                        <option value="Income">Income</option>
                                        <option value="Expense">Expense</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nominal" class="col-form-label">Nominal:</label>
                                    <input type="number" class="form-control" name="nominal" id="nominal">
                                </div>
                                <div class="form-group">
                                    <label for="payment_proof" class="col-form-label">Payment Proof:</label>
                                    <input type="file" class="form-control" name="payment_proof" id="payment_proof">
                                </div>
                                <div class="form-group">
                                    <label for="financial_date" class="col-form-label">Financial Date:</label>
                                    <input type="date" class="form-control" name="financial_date" id="financial_date">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole
        {{-- Store Modal --}}

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
                            <td>
                                <img style="width: 200px" src="{{ asset('storage/' . $financial->payment_proof) }}"
                                    alt="Error">
                            </td>
                            <td>{{ $financial->users->name }}</td>
                            <td>{{ $financial->amount }}</td>
                            <td>{{ $financial->types }}</td>
                            <td>{{ $financial->nominal }}</td>
                            <td>{{ $financial->status }}</td>
                            <td>{{ $financial->financial_date }}</td>
                            <td>{{ $financial->has_paid_until }}</td>
                            <td>
                                @if ($financial->status === 'Pending')
                                    <form action="{{ route('financial.accept', $financial->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                @endif
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
