@extends('backend/master')
@section('content')
    <div class="p-2 rounded bg-light m-2 mb-4">
        <h2 class=" text-muted text-center">Main Category</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach($main as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->main_category }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="#">Edit</a>
                    <a class="btn btn-sm btn-danger" href="#">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            {{ $main->links() }}
        </div>
    </div>
    <div class="p-2 rounded bg-light m-2 mb-4">
        <h2 class=" text-muted text-center">Sub Category</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Main</th>
                <th>Sub</th>
                <th>Action</th>
            </tr>
            @foreach($sub as $data)

            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->mainCategory->main_category }}</td>
                <td>{{ $data->sub_category }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="#">Edit</a>
                    <a class="btn btn-sm btn-danger" href="#">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            {{ $sub->links() }}
        </div>
    </div>
    <div style="position:relative" class="p-2 rounded bg-light m-2 mb-4">
        <h2 class=" text-muted text-center">Tiny Category</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Main</th>
                <th>Sub</th>
                <th>Tiny</th>
                <th>Action</th>
            </tr>
            @foreach($tiny as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->mainCategory->main_category }}</td>
                <td>{{ $data->subCategory->sub_category }}</td>
                <td>{{ $data->tiny_category }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="#">Edit</a>
                    <a class="btn btn-sm btn-danger" href="#">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>

            {{ $tiny->links() }}

    </div>

@endsection
