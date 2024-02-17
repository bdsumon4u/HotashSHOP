<div class="tab-content">
    <div class="tab-pane active" id="item-1" role="tabpanel">
        <div class="row">
            <div class="col-sm-12">
                <h4><small class="border-bottom mb-1">General</small></h4>
            </div>
        </div>
        <div class="form-group">
            <x-label for="name" /><span class="text-danger">*</span>
            <x-input name="name" :value="$product->name" data-target="#slug" />
            <x-error field="name" />
        </div>
        <div class="form-group">
            <x-label for="slug" /><span class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">{{ url('/product') }}/</div>
                </div>
                <x-input name="slug" :value="$product->slug" />
                <button class="input-group-append align-items-center btn btn-secondary" type="button" onclick="window.open('{{url('/products').'/'}}'+this.previousSibling.value, '_blank')">VISIT</button>
            </div>
            <x-error field="slug" />
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <x-label for="description" /><span class="text-danger">*</span>
                    <x-textarea editor name="description" cols="30" rows="10">{!! $product->description !!}</x-textarea>
                    <x-error field="description" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <x-label for="categories" /><span class="text-danger">*</span>
                    <x-category-dropdown :categories="$categories" name="categories[]" placeholder="Select Category" id="categories" multiple="true" :selected="old('categories', $product->categories->pluck('id')->toArray())" />
                    <x-error field="categories" class="d-block" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <x-label for="brand" /><span class="text-danger">*</span>
                    <x-category-dropdown :categories="$brands" name="brand" placeholder="Select Brand" id="brand" :selected="old('brand', $product->brand_id)" />
                    <x-error field="brand" class="d-block" />
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane active" id="item-2" role="tabpanel">
        <div class="row">
            <div class="col-sm-12">
                <h4><small class="border-bottom mb-1">Price</small></h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <x-label for="price" /><span class="text-danger">*</span>
                    <x-input name="price" :value="$product->price" />
                    <x-error field="price" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <x-label for="selling_price" /><span class="text-danger">*</span>
                    <x-input name="selling_price" :value="$product->selling_price" />
                    <x-error field="selling_price" />
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane active" id="item-3" role="tabpanel">
        <div class="row">
            <div class="col-sm-12">
                <h4><small class="border-bottom mb-1">Inventory</small></h4>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="hidden" name="should_track" value="0" />
                        <x-checkbox name="should_track" value="1" :checked="!!$product->should_track" class="should_track custom-control-input" />
                        <x-label for="should_track" class="custom-control-label" />
                        <x-error field="should_track" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sku">Product Code</label><span class="text-danger">*</span>
                    <x-input name="sku" :value="$product->sku" />
                    <x-error field="sku" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group stock-count" @if(!old('should_track', $product->should_track)) style="display: none;" @endif>
                    <x-label for="stock_count" /><span class="text-danger">*</span>
                    <x-input name="stock_count" :value="$product->stock_count" />
                    <x-error field="stock_count" />
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane active" id="item-4" role="tabpanel">
        <div class="row">
            <div class="col-sm-12">
                <h4><small class="border-bottom mb-1">Product Images</small></h4>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <!-- Button to Open the Modal -->
                            <label for="base_image" class="d-block mb-0">
                                <strong>Base Image</strong>
                                <button type="button" class="btn single btn-light px-2" data-toggle="modal" data-target="#single-picker" style="background: transparent; margin-left: 5px;">
                                    <i class="fa fa-image text-secondary mr-1"></i>
                                    <span>Browse</span>
                                </button>
                            </label>
                            <div id="preview-{{optional($product->base_image)->id}}" class="base_image-preview @unless(old('base_image', optional($product->base_image)->id)) d-none @endunless" style="height: 150px; width: 150px; margin: 5px; margin-left: 0px;">
                                <img src="{{ old('base_image_src', optional($product->base_image)->src) }}" alt="Base Image" data-toggle="modal" data-target="#single-picker" id="base_image-preview" class="img-thumbnail img-responsive" style="display: {{ old('base_image_src', optional($product->base_image)->src) ? '' : 'none' }};">
                                <input type="hidden" name="base_image_src" value="{{ old('base_image_src', optional($product->base_image)->src) }}">
                                <input type="hidden" name="base_image" value="{{ old('base_image', optional($product->base_image)->id) }}" id="base-image" class="form-control">
                            </div>
                            @error('base_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="additional_images" class="d-block mb-0">
                                <strong>Additional Images</strong>
                                <button type="button" class="btn multiple btn-light px-2" data-toggle="modal" data-target="#multi-picker" style="background: transparent; margin-left: 5px;">
                                    <i class="fa fa-image text-secondary mr-1"></i>
                                    <span>Browse</span>
                                </button>
                            </label>
                            <div class="additional_images-previews d-flex" style="margin-left: -5px;">
                                @php
                                    $ids = old('additional_images', $product->additional_images->pluck('id')->toArray());
                                    $srcs = old('additional_images_srcs', $product->additional_images->pluck('src')->toArray());
                                @endphp
                                @foreach($srcs as $src)
                                    <div id="preview-{{$ids[$loop->index]}}" class="additional_images-preview position-relative" style="height: 150px; width: 150px; margin: 5px;">
                                        <i class="fa fa-times text-danger position-absolute" style="font-size: large; top: 0; right: 0; background: #ddd; padding: 2px; border-radius: 3px; cursor: pointer;" onclick="this.parentNode.remove()"></i>
                                        <img src="{{ $src }}" alt="Additional Image" data-toggle="modal" data-target="#multi-picker" id="additional_image-preview" class="img-thumbnail img-responsive">
                                        <input type="hidden" name="additional_images[]" value="{{ $ids[$loop->index] }}" style="margin: 5px;">
                                        <input type="hidden" name="additional_images_srcs[]" value="{{ $src }}" style="margin: 5px;">
                                    </div>
                                @endforeach
                            </div>
                            <div class="clearfix"></div>
                            @error('additional_images')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex" style="gap: 1rem;">
    <div class="checkbox checkbox-secondary">
        <x-checkbox name="is_active" value="1" :checked="!!$product->is_active" />
        <x-label for="is_active" />
        <x-error field="is_active" />
    </div>
    <button type="submit" class="btn btn-success">Save Product</button>
</div>