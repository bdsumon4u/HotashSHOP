<div class="tab-pane active" id="item-others" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Others</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Products Page</label>
                <div class="row borderr py-2">
                    <div class="col-md-6">
                        <label for="products_page-rows">Rows</label>
                        <x-input name="products_page[rows]" id="products_page-rows" :value="$products_page->rows ?? 3" />
                        <x-error field="products_page.rows" />
                    </div>
                    <div class="col-md-6">
                        <label for="products_page-cols">Cols (4 or 5)</label>
                        <x-input name="products_page[cols]" id="products_page-cols" :value="$products_page->cols ?? 5" />
                        <x-error field="products_page.cols" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Related Products</label>
                <div class="row borderr py-2">
                    <div class="col-md-6">
                        <label for="related_products-rows">Rows</label>
                        <x-input name="related_products[rows]" id="related_products-rows" :value="$related_products->rows ?? 1" />
                        <x-error field="related_products.rows" />
                    </div>
                    <div class="col-md-6">
                        <label for="related_products-cols">Cols (4 or 5)</label>
                        <x-input name="related_products[cols]" id="related_products-cols" :value="$related_products->cols ?? 5" />
                        <x-error field="related_products.cols" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Scroll Text</label>
                <x-textarea name="scroll_text" id="scroll_text">{{$scroll_text ?? null}}</x-textarea>
                <x-error field="scroll_text" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex form-group">
                <div class="checkbox checkbox-secondary mr-md-2">
                    <input type="hidden" name="show_option[track_order]" value="0">
                    <x-checkbox id="show-track-order" name="show_option[track_order]" value="1"
                        :checked="!!($show_option->track_order ?? false)" />
                    <label for="show-track-order">Show `Track Order` Option</label>
                </div>
                <div class="checkbox checkbox-secondary mx-md-2">
                    <input type="hidden" name="show_option[customer_login]" value="0">
                    <x-checkbox id="show-customer-login" name="show_option[customer_login]" value="1"
                        :checked="!!($show_option->customer_login ?? false)" />
                    <label for="show-customer-login">Show `Customer Login` Option</label>
                </div>
                <div class="checkbox checkbox-secondary ml-md-2">
                    <input type="hidden" name="services[enabled]" value="0">
                    <x-checkbox id="services" name="services[enabled]" value="1"
                        :checked="!!($services->enabled ?? false)" />
                    <label for="services">Show `Services` Section</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach(config('services.services', []) as $num => $icon)
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend mr-1">
                    <span class="input-group-text">
                        <svg width="24px" height="24px"><use xlink:href="{{ asset($icon) }}"></use></svg>
                    </span>
                </div>
                <div class="" style="flex: 1;">
                    <div class="form-group mb-1">
                        <label for="" class="ml-1">Title</label>
                        <x-input name="services[{{ $num }}][title]" :value="$services->$num->title ?? ''" />
                    </div>
                    <div class="form-group mt-2 mb-0">
                        <label for="" class="ml-1">Detail</label>
                        <x-input name="services[{{ $num }}][detail]" :value="$services->$num->detail ?? ''" />
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
