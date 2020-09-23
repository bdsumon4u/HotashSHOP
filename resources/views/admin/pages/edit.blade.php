@extends('layouts.light.master')
@section('title', 'Edit page')

@section('breadcrumb-title')
<h3>Edit page</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Edit page</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">Edit <strong>Page</strong></div>
            <div class="card-body p-3">
                <x-form action="{{ route('admin.pages.update', $page) }}" method="patch">
                    <div class="form-group">
                        <label for="title">Page Title</label><span class="text-danger">*</span>
                        <x-input name="title" :value="$page->title" data-target="#slug" />
                        <x-error field="title" />
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label><span class="text-danger">*</span>
                        <x-input name="slug" :value="$page->slug" />
                        <x-error field="slug" />
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content">Content</label><span class="text-danger">*</span>
                                <textarea editor name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content', $page->content) }}</textarea>
                                {!! $errors->first('content', '<span class="invalid-feedback">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/tinymce.js') }}"></script>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    $('[name="title"]').keyup(function () {
        $($(this).data('target')).val(slugify($(this).val()));
    });
});
</script>
@endpush