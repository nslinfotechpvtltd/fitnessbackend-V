@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url(url()->previous()) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $traineruser->id }}</td>
                                </tr>
                                <tr><th> First Name </th><td> {{ $traineruser->first_name }} </td></tr>
                                <tr><th> Middle Name </th><td> {{ $traineruser->middle_name }} </td></tr>
                                <tr><th> Last Name </th><td> {{ $traineruser->last_name }} </td></tr>
                                <tr><th> email </th><td> {{ $traineruser->email }} </td></tr>
                                <tr><th> Experience </th><td> {{ $traineruser->expirence }} </td></tr>
                                <tr><th> Certifications </th><td> {{ $traineruser->certifications }} </td></tr>
                                <tr><th> Speciality  </th><td> {{ $traineruser->specialities }} </td></tr>
                                <tr><th> Birth Date	  </th><td> {{ $traineruser->birth_date	 }} </td></tr>
                                <tr><th> About	  </th><td> {{ $traineruser->about	 }} </td></tr>
                                <tr><th> Address	  </th><td> {{ $traineruser->address_house }} </td></tr>
                                <tr><th> Emergency Contact No </th><td> {{ $traineruser->emergency_contact_no }} </td></tr>
                                <?php if ($traineruser->image == ''): ?>
                                    <tr><th>Image</th><td>NAN</td></tr>
                                <?php else: ?>
                                    <tr><th>Image</th><td><img width="150" src="{{url('uploads/trainer-user/'.$traineruser->image)}}"> </td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection