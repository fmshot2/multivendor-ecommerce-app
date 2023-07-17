@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> Products
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('product.create') }}"><i
                                    class="icon-plus"></i>Create Product</a>
                        </h2>
                        <ul class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ul>
                        <p class="float-right">Total Products{{ \App\Models\Product::count() }}</p>
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
                            <h2><strong>Product</strong> List</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Size</th>
                                            <th>Condition</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>
                                                    <img src="{{ $item->photo }}" alt="banner image"
                                                        style="max-height: 90px; max-width: 200px;">
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->discount }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>
                                                @if ($item->conditions == 'new')
                                                    <span class="badge badge-success">{{ $item->conditions }}</span>
                                                @elseif ($item->conditions == 'popular')
                                                    <span class="badge badge-warning">{{ $item->conditions }}</span>
                                                @else
                                                    <span class="badge badge-primary">{{ $item->conditions }}</span>
                                                @endif
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="toogle" value="{{ $item->id }}"
                                                        data-toggle="switchbutton"
                                                        {{ $item->status == 'active' ? 'checked' : '' }}
                                                        data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.show', $item->id) }}"
                                                        class="float-left btn btn-sm btn-outline-secondary"
                                                        data-toggle="tooltip" title="view" data-placement="bottom"><i
                                                            class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('product.edit', $item->id) }}"
                                                        class="float-left btn btn-sm btn-outline-warning"
                                                        data-toggle="tooltip" title="edit" data-placement="bottom"><i
                                                            class="fas fa-edit"></i>
                                                    </a>
                                                    <form class="float-left ml-1"
                                                        action="{{ route('banner.destroy', $item->id) }}" method="post">
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

