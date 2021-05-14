@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="fixed-row">
    <div class="app-title">
        <div class="active-wrap">
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
</div>
    @include('admin.partials.flash')
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"></script>
@endpush