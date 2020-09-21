<div class="tab-pane" id="item-others" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Others</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Related Products</label>
                <div class="row border py-2">
                    <div class="col-md-6">
                        <label for="related_products-rows">Rows</label>
                        <x-input name="related_products[rows]" id="related_products-rows" :value="$related_products->rows ?? 1" />
                        <x-error field="related_products.rows" />
                    </div>
                    <div class="col-md-6">
                        <label for="related_products-cols">Cols (4 or 5)</label>
                        <x-input name="related_products[cols]" id="related_products-cols" :value="$related_products->cols ?? 1" />
                        <x-error field="related_products.cols" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>