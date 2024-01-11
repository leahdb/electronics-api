@extends('layouts.default')

@php
    $user = $user ?? null;
@endphp

@if($user)
    <h3>hello, {{$user['first_name']}}</h3>
@endif

@if(!$user)
    <form method="post" action="{{url('/auth/login')}}">
        @csrf
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
@endif
