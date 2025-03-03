@extends('layouts.dashboard')
@section('content')
   @include('components.auth.navbarComponent') 
   @include('components.auth.sidebarComponent')
   @include('components.auth.examShedules.examSheduleComponent')
   @include('components.auth.footerComponent')
   @include('components.auth.examShedules.examSheduleCreateComponent')
   @include('components.auth.examShedules.examSheduleEditComponent')
   @include('components.auth.examShedules.examSheduleViewComponent')
   {{-- @include('components.auth.subject.subjectCreateComponent')
   @include('components.auth.subject.subjectEditComponent') --}}
@endsection