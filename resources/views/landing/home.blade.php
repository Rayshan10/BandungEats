@extends('layouts.app')

@section('title','Beranda')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
@endpush

@section('content')

@include('landing.sections.hero')

@include('landing.sections.popular')

@include('landing.sections.about')

@include('landing.sections.search')

@include('landing.sections.categories')

@include('landing.sections.faq')

@include('landing.sections.contact')

@endsection

@push('scripts')
<script src="{{ asset('assets/js/landing.js') }}"></script>
@endpush