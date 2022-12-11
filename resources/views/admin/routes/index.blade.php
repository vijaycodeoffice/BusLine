@extends('admin.admin_master')

@section('admin')





<div class="content">

<div class="breadcrumb-wrapper">

    <h1>Routes List</h1>

    

<nav aria-label="breadcrumb">

<ol class="breadcrumb p-0">

<li class="breadcrumb-item">

<a href="{{ route('dashboard')}}">

<span class="mdi mdi-home"></span>                

</a>

</li>

<li class="breadcrumb-item">

components

</li>

<li class="breadcrumb-item" aria-current="page">Route List</li>

</ol>

</nav>



</div>





<div class="row">

    <div class="col-lg-12">

        <div class="card card-default">

            <div class="card-header card-header-border-bottom">

                <h2>

                    <button type="button" class="btn bg-primary text-white btn-pill mb-3 mb-md-0" data-toggle="modal" data-target="#exampleModalForm" style="float: right;">

                      Add Route <i class="mdi mdi-library-plus"></i></button>

                </h2>

            </div>

            <div class="card-body">

              

                <table id="example" class="display nowrap dataTable dtr-inline" style="width: 100%; position: relative;" aria-describedby="example_info">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Soource</th>
                            <th>Destination</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                            @php

                                $sno = 1;

                            @endphp

                          

                        @foreach ($data as $item)

                

                        <tr>

                

                            <td>{{ $sno++ }}</td>

                            <td>{{ $item->name ?? '' }}</td>

                            <td>{{ $item->source ?? '' }}</td>

                            <td>{{ $item->destination ?? '' }}</td>

                

                            <td>

                            @if ($item->is_active == 'Active')

                                <span class="badge badge-pill badge-success" style="background-color: green;">Active</span>

                            @else

                            <span class="badge badge-pill badge-danger" style="background-color: red;">Inactive</span>

                            @endif

                

                            </td>

                            <td>
                            @if ($item->is_active == 'Active')

                            <a href="{{ route('route.inactive',$item->id) }}" class="btn btn-danger" title="inactive now">

                                <i class="fa fa-arrow-down"></i></a>

                        @else

                        <a href="{{ route('route.active',$item->id) }}" class="btn btn-success" title="active now">

                            <i class="fa fa-arrow-up"></i></a>

                        @endif

                        <button class="btn btn-danger editroutes" value="{{ $item->id }}" title="Edit Subcategory" data-toggle="modal" data-target="#exampleModalFormedit">

                            <i class="fa fa-pencil"></i></button>

                            </td>

                        </tr>

                

                        @endforeach

                

                        </tbody>

                </table>

                

            </div>

        </div>

    </div>

</div>

  



						

</div>







{{-- add model --}}



<div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalFormTitle">Add Route</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

        <form method="POST" action="{{ route('store.route') }}" name="submitform" id="submitform">

                    @csrf

                    <div class="form-group">

                        <label for="exampleInputPassword1"><span class="text-danger">* &nbsp</span>Route Name:</label>

                        <input type="test" class="form-control" id="exampleInputPassword1" placeholder="Route Name" name="name" required>

                    </div>



                    <div class="form-group">

                        <label for="exampleInputPassword1"><span class="text-danger">* &nbsp</span>Source :</label>

                        <input type="test" class="form-control" id="exampleInputPassword1" placeholder="Source Name" name="source" required>

                    </div>

                    <div class="form-group">

                        <label for="exampleInputPassword1"><span class="text-danger">* &nbsp</span>Destination :</label>

                        <input type="test" class="form-control" id="exampleInputPassword1" placeholder="Destination Name" name="destination" required>

                    </div>
                    <input type="hidden" name="action1" id="action" value="{{ $action1 }}">

                        </div>

            <div class="modal-footer">

			<div class="modal-title" style="margin-left: 0; width: 294px;"><span class="text-danger">*</span> indicates mandatory fields</div>

                <button type="submit" class="btn btn-primary">Submit</button>

        </form>

                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>

                

            </div>

        </div>

    </div>

</div>



{{-- edit model --}}



<div class="modal fade" id="exampleModalFormedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormedit" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalFormedit">Edit Routes</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('update.route') }}" name="submitform" id="submit_edit_form">

                    @csrf

                    <input type="hidden" name="route_id" id="route_id">  



                    <div class="form-group">

                        <label for="exampleInputPassword1">Name :</label>

                        <input type="test" class="form-control" id="name"  name="name">

                    </div>



                    <div class="form-group">

                        <label for="exampleInputPassword1"><span class="text-danger">* &nbsp</span>Source :</label>

                        <input type="test" class="form-control" id="source"  name="source" required>

                    </div>

                    <div class="form-group">

                        <label for="exampleInputPassword1"><span class="text-danger">* &nbsp</span>Destination :</label>

                        <input type="test" class="form-control" id="destination"  name="destination" required>

                    </div>
                    <input type="hidden" name="action2" id="action" value="{{ $action2 }}">


            </div>

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Update</button>

        </form>



                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

$.ajaxSetup({ 

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});

$(document).ready(function () {

$(document).on('click', '.editroutes', function(e){

    e.preventDefault();

  var id = $(this).val();

    $.ajax({

    type: "GET",

    url: "edit/route"+id,

    dataType: "json",

    success: function (response) {

    console.log(response.route);

      $("#route_id").val(id);

      $("#name").val(response.route.name);

      $("#source").val(response.route.source);

      $("#destination").val(response.route.destination);

    }

  });

  });

});

</script>



@endsection