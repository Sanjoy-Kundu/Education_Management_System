@extends('layouts.dashboard')
@section('content')
   @include('components.auth.navbarComponent') 
   @include('components.auth.sidebarComponent')
   @include('components.auth.classComponent')
   @include('components.auth.footerComponent')
   @include('components.auth.classCreateComponent')
@endsection