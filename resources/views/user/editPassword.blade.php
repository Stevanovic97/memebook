@extends ('layouts.app')
@section('title', 'Edit Password')

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
        <form action="{{url(route('user.updatePassword'))}}" method="POST">
            {{csrf_field()}}

            <label for="password">Old Password</label>
            <input type="password" id="OldPassword" name="OldPassword"
                   style="width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;">

            <label for="password">New Password</label>
            <input type="password" id="NewPassword" name="NewPassword"
                   style="width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;">

            <label for="password">Confirm New Password</label>
            <input type="password" id="NewPassworConfirm" name="NewPasswordConfirm"
                   style="width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;">


            <button type="submit" value="Submit" class="btn btn-success">Submit Changes</button>

        </form>

    </div>

@endsection
