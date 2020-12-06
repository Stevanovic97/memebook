@extends ('layouts.app')
@section('title', 'Edit Name')

@section('content')



    <div class="container" style=" border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;">
        <div style="text-align: center;">
            <h1>Edit your Name</h1>
        </div>
        <form action="{{route('user.updateName')}}" method="POST">
            {{csrf_field()}}

            <label for="name">New Name</label>
            <input type="text" id="name" name="name" placeholder="{{auth()->user()->name}}"
                   style="width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;" required>

            <button type="submit" value="Submit" class="btn btn-success">Submit Changes</button>

        </form>

    </div>

@endsection
