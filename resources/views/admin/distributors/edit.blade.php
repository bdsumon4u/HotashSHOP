@extends('layouts.light.master')
@section('title', 'Edit distributor')

@section('breadcrumb-title')
<h3>Edit distributor</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Edit distributor</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">Edit <strong>distributor</strong></div>
            <div class="card-body p-3">
                <x-form method="patch" :action="route('admin.distributors.update', $distributor)" has-files>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-label for="full_name" /><span class="text-danger">*</span>
                                        <x-input name="full_name" :value="old('full_name', $distributor->full_name)" />
                                        <x-error field="full_name" />
                                    </div>
                                    <div class="form-group">
                                        <x-label for="shop_name" /><span class="text-danger">*</span>
                                        <x-input name="shop_name" :value="old('shop_name', $distributor->shop_name)" />
                                        <x-error field="shop_name" />
                                    </div>
                                    <div class="form-group">
                                        <x-label for="email" />
                                        <x-input name="email" :value="old('email', $distributor->email)" />
                                        <x-error field="email" />
                                    </div>
                                    <div class="form-group">
                                        <x-label for="phone" /><span class="text-danger">*</span>
                                        <x-input name="phone" :value="old('phone', $distributor->phone)" />
                                        <x-error field="phone" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-label for="type" /><span class="text-danger">*</span>
                                        <x-input name="type" :value="old('type', 'Distributor')" />
                                        <x-error field="type" />
                                    </div>
                                    <div class="form-group">
                                        <x-label for="address" /><span class="text-danger">*</span>
                                        <x-textarea name="address" rows="8">{{ old('address', $distributor->address) }}</x-textarea>
                                        <x-error field="address" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="photo" class="d-block">
                                    <div>Photo</div>
                                    <img src="{{ asset($distributor->photo ?? '') ?? '' }}" alt="Photo" class="form-control img-responsive d-block {{$errors->has('photo') ? 'is-invalid' : 'border'}}" style="@unless($distributor->photo ?? '') display:none; @endunless height: 300px; width: 300px;">
                                </label><span class="text-danger">*</span>
                                <x-input name="full_name" type="file" name="photo" class="d-none" />
                                <x-error field="photo" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
    $('input[type="file"]').change(function() {
        var $img = $(this).parent().find('img');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $img.attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
@endpush