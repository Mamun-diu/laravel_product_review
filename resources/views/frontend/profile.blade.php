@extends('frontend/master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-striped table-secondary mt-2">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>

                </table>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#password">Change Password</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">Edit Info</button>
            </div>
        </div>
    </div>



<!-- Password Modal -->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/password/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Old Password</label>
                    <input  type="password" class="form-control mt-1" name="old_password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input  type="password" class="form-control mt-1" name="new_password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input  type="password" class="form-control mt-1" name="confirm_password">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>

            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Edit info Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/edit/profile/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control mt-1" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control mt-1" name="email" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input  type="text" class="form-control mt-1" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control mt-1" name="address">{{ $user->address }}</textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>

            </div>
        </form>

      </div>
    </div>
  </div>
@endsection
