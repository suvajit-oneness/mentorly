@extends('admin.app')
@section('title') {{ ('Transaction') }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ ('Transaction Log') }}</h1>
            <p>{{ ('List of all Transaction') }}</p>
        </div>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Description</th>
                                <th>Purpose of the Payment</th>
                                <th>Slot Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $dat)
                                <tr>
                                    <td>{{$dat->transactionId}}</td>
                                    <td>$ {{$dat->amount / 100}}</td>
                                    <td>{{$dat->card_type}}</td>
                                    <td>{{$dat->description}}</td>
                                    <td>
                                        @if($dat->slot)
                                            {{('Slot Booking')}}
                                        @else
                                            {{('Other')}}
                                        @endif
                                    </td>
                                    <td>{{ !empty($dat->slot) ? $dat->slot->id:'' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});</script>
@endpush
