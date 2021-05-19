@extends('layouts.master')
@section('title','Privacy Policy')
@section('content')

<section class="white-section">
    <div class="container">
        <h2 class="page-heading">Policy</h2>
        <div class="faq-place">
            @if($data->policy)
                {!! $data->policy->description !!}
            @endif
        </div>
    </div>
</section>

@section('script')
<script type="text/javascript"></script>
@stop
@endsection