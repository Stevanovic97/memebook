@extends('layouts.app')

@section('title', 'Delete Account');

@section('navbar')
    @include('partials.main-navbar')
@endsection

@section('content')
    <div class="container" style=" border-radius: 5px;
  background-color: #f2f2f2;
  padding-top: 60px;">
        <div style="text-align: center;">
            <h1>Edit your Password</h1>
        </div>
        <form action="{{route('user.deleteAccount')}}" method="POST">
            {{csrf_field()}}
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   style="width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px; " required>

            <label for="password">Confirm Password</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm"
                   style="width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;" required>

            <button type="submit" value="Submit" class="btn btn-danger">Confirm</button>
        </form>

    </div>
@endsection
