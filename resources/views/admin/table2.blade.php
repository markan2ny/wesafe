@extends('admin.layout')
@section('page-title', 'Request User')
@push('datatable-style')
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('main')
    
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pending User's</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID#</th>
                  <th>Full Name</th>
                  <th>Email Address</th>
                  <th>Address</th>
                  <th>Mobile#</th>
                  <th>Date Created</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @forelse ($users as $user)
                       <tr>
                           <td>{{ $user->id }}</td>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ $user->address }}</td>
                           <td>{{ $user->phone }}</td>
                           <td>
                            {{ Carbon\Carbon::parse($user->created_at)->format('m/d/Y') }}
                            </td>
                           <td>
                              <span class="badge badge-warning right">Pending</span>
                           </td>
                           <td>
                            @if ( $user->isBlock == 0)
                              <a href="{{ route('approve', ['id' => $user->id, 'status' => 1]) }}" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                            @endif
                              <a href="{{ route('profile', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                           </td>
                       </tr>
                   @empty
                       
                   @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>



@endsection

@push('datatable-script')
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
      </script>
@endpush