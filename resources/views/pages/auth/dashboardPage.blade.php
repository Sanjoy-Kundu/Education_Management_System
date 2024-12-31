@extends('layouts.dashboard')
@section('content')
   @include('components.auth.navbarComponent') 
   @include('components.auth.sidebarComponent')
   @include('components.auth.mainComponent')
   @include('components.auth.footerComponent')
@endsection