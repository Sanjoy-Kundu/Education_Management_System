@extends('layouts.dashboard')
@section('content')
   @include('components.auth.navbarComponent') 
   @include('components.auth.sidebarComponent')
   @include('components.auth.subject.subjectComponent')
   @include('components.auth.footerComponent')
   @include('components.auth.subject.subjectCreateComponent')
   @include('components.auth.subject.subjectEditComponent')
    {{--
   @include('components.auth.classEditComponent') --}}
@endsection