@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add Banners</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Banners</li>
                            <li class="breadcrumb-item active">Add Banners</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Title">Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Title" name="title"
                                            value="{{ old('title') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="filepath">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea id="description" class="form-control" placeholder="Write som text ..." name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <label for="Condition"></label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <select name="condition" class="form-control show-tick">
                                        <option value="">-- Conditions --</option>
                                        <option value="banner" {{ old('condition') == 'banner' ? 'selected' : '' }}>Banner
                                        </option>
                                        <option value="promo" {{ old('condition') == 'promo' ? 'selected' : '' }}>Promote
                                        </option>
                                    </select>
                                </div>


                                <div class="col-lg-12 col-md-12  col-sm-12">
                                    <select name="status" class="form-control show-tick">
                                        <option value="">-- Status --</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
