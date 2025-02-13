@extends('layouts.dashboard')
@section('content')
@include('components.auth.navbarComponent')
@include('components.auth.sidebarComponent')
@include('components.auth.routine.routineListComponent')
@include('components.auth.footerComponent')
@include('components.auth.routine.routineAddComponent')
@endsection