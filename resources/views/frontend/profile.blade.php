@extends('frontend/master')

@section('content')
    <div class="container my-5">
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
                <div class="d-flex justify-content-center offset-4 profile-image" style="height: 200px; width : 200px;" >
                    @if($user->image)
                        <img width="200px" class="img-thumbnail rounded-circle" src="{{ asset('public/user_image/') }}/{{ $user->image }}" alt="">
                    @else
                        <img width="200px" class="img-thumbnail rounded-circle" src="{{ asset('public/icon/avatar.svg') }}" alt="">
                    @endif
                    <button data-bs-toggle="modal" data-bs-target="#profile-image " style=""><i class="fas fa-edit"></i></button>

                </div>
                <table class="table table-striped table-secondary mt-2">
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $user->fname}} {{ $user->lname }}</td>
                        <td><i data-bs-toggle="modal" data-bs-target="#profile-full-name" class="fas fa-edit profile-edit"></i></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                        <td><i data-bs-toggle="modal" data-bs-target="#profile-username" class="fas fa-edit profile-edit"></i></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                        <td><i data-bs-toggle="modal" data-bs-target="#profile-email" class="fas fa-edit profile-edit"></i></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                        <td><i data-bs-toggle="modal" data-bs-target="#profile-phone" class="fas fa-edit profile-edit"></i></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $user->gender }}</td>
                        <td><i data-bs-toggle="modal" data-bs-target="#profile-gender" class="fas fa-edit profile-edit"></i></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                        <td><i data-bs-toggle="modal" data-bs-target="#profile-address" class="fas fa-edit profile-edit"></i></td>
                    </tr>

                </table>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#password">Change Password</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">Delete Account</button>
            </div>
        </div>
    </div>

    <!-- Edit Image Modal -->
<div class="modal fade" id="profile-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Profile picture</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/image/') }}/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="old_image" value="{{ $user->image }}">
                    <input  type="file" class="form-control mt-1" name="file">
                </div>
                <div class="mt-2">
                    <img width="200px" class="img-thumbnail" src="{{ asset('public/user_image/') }}/{{ $user->image }}" alt="">
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

<!-- Edit Full Name Modal -->
<div class="modal fade" id="profile-full-name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Full Name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/fullname/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name</label>
                    <input  type="text" class="form-control mt-1" name="fname" value="{{ $user->fname }}">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input  type="text" class="form-control mt-1" name="lname" value="{{ $user->lname }}">
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

  <!-- Edit Username Modal -->
<div class="modal fade" id="profile-username" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Username</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/username/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input  type="text" class="form-control mt-1" name="username" value="{{ $user->username }}">
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
<!-- Edit Email Modal -->
<div class="modal fade" id="profile-email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Email</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/email/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Email</label>
                    <input  type="text" class="form-control mt-1" name="email" value="{{ $user->email }}">
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

<!-- Edit Phone Modal -->
<div class="modal fade" id="profile-phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Phone Number</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/phone/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Phone/Mobile</label>
                    <input  type="text" class="form-control mt-1" name="phone" value="{{ $user->phone }}">
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

<!-- Edit Gender Modal -->
<div class="modal fade" id="profile-gender" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Gender</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/gender/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">

                    <input  type="radio" class="form-check-input mt-1" name="gender" value="Male" checked>
                    <label>Male</label><br>
                    <input  type="radio" class="form-check-input mt-1" name="gender" value="Female">
                    <label for="">Female</label>
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

<!-- Edit Address Modal -->
<div class="modal fade" id="profile-address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/change/address/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Address</label>
                    <textarea  type="text" class="form-control mt-1" name="address" >{{ $user->address }}</textarea>
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

  <!-- Delete account Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <h1 class="display-3 my-5 text-center text-danger">Are you sure?</h1>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
        </div>
      </div>
    </div>
  </div>
   <!-- Confirm Delete account Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/remove/account/') }}/{{ $user->id }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Enter Password</label>
                    <input type="hidden" name="image" value="{{ $user->image }}">
                    <input  type="password" class="form-control mt-1" name="password">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>

            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
