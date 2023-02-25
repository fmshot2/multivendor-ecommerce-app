@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> Categories
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('category.create') }}"><i
                                    class="icon-plus"></i>Create Category</a>
                        </h2>
                        <ul class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ul>
                        <p class="float-right">Total Categories :{{ \App\Models\Category::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Category</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Photo</th>
                                            <th>Is parent</th>
                                            <th>Parents</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                {{-- <td>{!! html_entity_decode($item->summary) !!}</td> --}}
                                                <td><img src="{{ $item->photo }}" alt="banner image"
                                                        style="max-height: 90px; max-width: 200px;"></td>
                                                <td>{{ $item->is_parent == 1 ? 'Yes' : 'No' }}</td>
                                                <td>{{ $item->parent_id }}</td>
                                                <td>
                                                    <input type="checkbox" name="toogle" value="{{ $item->id }}"
                                                        data-toggle="switchbutton"
                                                        {{ $item->status == 'active' ? 'checked' : '' }}
                                                        data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </td>
                                                <td>
                                                    <a href="{{ route('category.edit', $item->id) }}"
                                                        class="float-left btn btn-sm btn-outline-warning"
                                                        data-toggle="tooltip" title="edit" data-placement="bottom"><i
                                                            class="fas fa-edit"></i>
                                                    </a>
                                                    <form class="float-left ml-1"
                                                        action="{{ route('category.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" data-toggle="tooltip" title="delete"
                                                            data-id="{{ $item->id }}" data-placement="bottom"
                                                            class="dltBtn btn btn-sm btn-outline-danger"><i
                                                                class="fas fa-trash-alt"></i> </a>
                                                    </form>
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

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        })
    </script>
    <script>
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url: "{{ route('category.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.msg);
                    } else {

                        alert('try again');
                    }
                    console.log(response.status);
                }
            })
        });
    </script>
@endsection
