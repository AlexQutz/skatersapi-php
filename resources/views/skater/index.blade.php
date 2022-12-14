@extends('layouts.app')

@section('content')

<!-- Add SkaterModal -->
<div class="modal fade" id="AddSkaterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Skater</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <ul id="saveform_errList"></ul>

          <div class="form-group mb-3">
            <label for="">Skater First Name</label>
            <input type="text" class="firstname form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Skater Last Name</label>
            <input type="text" class="lastname form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Country</label>
            <input type="text" class="country form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Sponsors</label>
            <input type="text" class="sponsors form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Board Width</label>
            <input type="text" class="boardwidth form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_skater">Save</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Skater Modal -->

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            <div id="success_message"></div>

            <div class="card">
                <div class="card-header">
                    <h4>
                        Skaters Data
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddSkaterModal" class="btn btn-primary float-end btn-sm">Add Skater</a>
                    </h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).ready(function (){
        $(document).on('click','.add_skater' , function (e) {
                e.preventDefault();
                var data = {
                    'firstname': $('.firstname').val(),
                    'lastname': $('.lastname').val(),
                    'country': $('.country').val(),
                    'sponsors': $('.sponsors').val(),
                    'boardwidth': $('.boardwidth').val(),
                }

               // console.log(data);

               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


               $.ajax({
                type: "POST",
                url: "/skaters",
                data: data,
                dataType: "json",
                success: function (response) {

                    if(response.status == 400){
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) {
                           $('#saveform_errList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else
                    {
                        $('#saveform_errList').html("");
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)
                        $('#AddSkaterModal').modal('hide');
                        $('#AddSkaterModal').find('input').val("");
                    }

                }
               });
        });
    });
</script>
@endsection
