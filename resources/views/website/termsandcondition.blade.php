@extends('layouts.master')
@section('title','Terms and Condition')
@section('content')

<section class="white-section">
    <div class="container">
        <h2 class="page-heading">Terms and Condition</h2>
        <div class="faq-place">
            @if($data->terms_and_condition)
                {!! $data->terms_and_condition->description !!}
            @endif
        </div>
    </div>
</section>

@section('script')
<script type="text/javascript"></script>
@stop
@endsection