@extends('layouts.dashboard')
@section('content')
   @include('components.auth.navbarComponent') 
   @include('components.auth.sidebarComponent')
   @include('components.auth.teacher.teacherListsComponent')
   @include('components.auth.footerComponent')
   @include('components.auth.teacher.teacherCreateComponent')
@endsection