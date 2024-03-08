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
    </div>
</div>
