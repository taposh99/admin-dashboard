@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>


<body>
    <div class="text-center">
        <h4 class="mt-2 mb-2">Parent Services List</h4>
        <!-- message -->
        @if(session()->has('message'))
        <p class="alert alert-success text-center mt-4">{{ session()->get('message') }}</p>
        @elseif(session()->has('error'))
        <p class="alert alert-danger text-center mt-4">{{ session()->get('error') }}</p>
        @endif
        <!-- end-message -->

    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <span>
            </span>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Customer">Add Parent Services</button>
            <!-- Modal -->
            <div class="modal fade" id="Customer" tabindex="-1" aria-labelledby="CustomerLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CustomerLabel">Add Parent Services</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- add form -->
                        <form action="{{ route('parentService.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="message">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>

                                <div class="border p-3 rounded">
                                    <div class="row">

                                        <div class="col-6">
                                            <label class="form-label">Service Name <span class="text-danger">*</span></label>
                                            <select class="form-control" name="service_id">
                                                <option value="">Select a Service Name</option>
                                                @foreach($parentService as $parentServiceData)
                                                <option value="{{$parentServiceData->id}}">{{$parentServiceData->service_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label">Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="parent_description" cols="30" rows="4" placeholder="e.g. description" required></textarea>
                                        </div>


                                    </div>



                                    <div class="my-3"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr class="text-capitalize">
                        <th>SL</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allParentServices as $key => $allParentData)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $allParentData->service->service_name }}</td>
                        <td>{{ $allParentData->parent_description }}</td>

                        <td>
                            <img src="{{ asset('storage/images/' . $allParentData->image) }}" alt="Icon" style="width: 90px; height: 50px;">
                        </td>

                        <td>
                            <a class="btn btn-success" href="" style="font-size: 13px">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-danger" href="" onclick="return confirm('are you sure !!!')" style="font-size:13px"><i class="fa fa-trash" aria-hidden="true"></i></a>


                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-danger">No data available</td>
                    </tr>
                    @endforelse
                </tbody>




            </table>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
@endsection