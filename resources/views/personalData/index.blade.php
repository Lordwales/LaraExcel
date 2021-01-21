@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Import Excel Spreadsheet </h2>
            </div>
            <div class="d-flex flex-row-reverse flex-column">
            <div class="d-flex">
                <!--<a class="btn btn-success text-light mr-5" data-toggle="modal" id="mediumButton" data-target="#mediumModal" data-attr="{{ route('personalData.create') }}" title="Create a project">
                    <i class="fas fa-plus-circle fa-2x"></i>
                </a>-->

                <form action="{{ route('importPersonalData') }}" method="POST" enctype="multipart/form-data" class="d-flex">
                    @csrf
                    <input type="file" name="file" style="height: 30px !important">

                    <button class="btn btn-info" style="margin-left: -60px" title="Import Data">
                        <i class="fas fa-cloud-upload-alt fa-2x"></i> </button>
                </form>

            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Firstname</th>
                <th scope="col" >Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Telephone</th>
                <th scope="col">Date Created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personalData as $data)
                <tr>
                    
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->firstname}}</td>
                    <td>{{ $data->lastname }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->telephone }}</td>
                    <td>{{ date_format($data->created_at, 'jS M Y') }}</td>
                    <td>
                        <form action="{{ route('personalData.destroy', $data->id) }}" method="POST">

                            <a data-toggle="modal" id="smallButton" data-target="#smallModal"
                                data-attr="{{ route('personalData.show', $data->id) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

                            <a class="text-secondary" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                data-attr="{{ route('personalData.edit', $data->id) }}">
                                <i class="fas fa-edit text-gray-300"></i>
                            </a>
                            @csrf
                            @method('DELETE')

                            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $personalData->links() !!}
    


    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

    </script>

@endsection
