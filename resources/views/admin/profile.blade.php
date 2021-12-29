@extends('admin.layout')
@section('page-title', 'User Profile')
@push('toast-style')
      <!-- Toastr -->
      <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endpush
@section('main')
    
<section class="content">
    <div class="container-fluid">
      @if ( session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="../../dist/img/user4-128x128.jpg"
                     alt="User profile picture">
              </div>
              <h3 class="profile-username text-center">{{ $profile->name }}</h3>
              @if (Cache::has('user-is-online-'. $profile->id))
                <p class="text-center text-success">Online</p>
              @else
                <p class="text-center text-muted">Offline</p>
              @endif
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Address:</b> <a class="float-right">{{ $profile->address }}</a>
                </li>
                <li class="list-group-item">
                  <b>Mobile #:</b> <a class="float-right">{{ $profile->phone }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email:</b> <a class="float-right">{{ $profile->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Join Date:</b> <a class="float-right">{{ Carbon\Carbon::parse($profile->created_at)->format('m-d-Y') }}</a>
                </li>
                
              </ul>
              @if ($profile->isBlock == 1) 
                <a href="{{ route('isBlockFromProfile', ['id' => $profile->id, 'status' => 0]) }}" class="btn btn-success btn-block"><b>Unblock</b></a>
              @else
                <a href="{{ route('isBlockFromProfile', ['id' => $profile->id, 'status' => 1]) }}" class="btn btn-warning btn-block"><b>Block</b></a>
              @endif
                <a href="#" class="btn btn-danger btn-block"><b>Delete</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          {{-- <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.card-body -->
          </div> --}}
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                {{-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update</a></li> --}}
                <li class="nav-link">Update - {{$profile->name}}</li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="settings">
                  <form action="{{ route('update-profile', $profile->id )}}" class="form-horizontal" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $profile->name }}" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{ $profile->email }}" id="inputEmail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName2" name="address" value="{{ $profile->address }}" name="address" placeholder="Address">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Mobile #</label>
                      <div class="col-sm-10">
                        <input type="text" name="phone" value="{{ $profile->phone }}" class="form-control" id="inputSkills" placeholder="Mobile #">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


@endsection

@push('toast-script')
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <script src="../../plugins/toastr/toastr.min.js"></script>
  <script>
    $(function() {
      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
    })
  </script>

@endpush