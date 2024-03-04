<div class="tab-pane active" id="item-fraud" role="tabpanel">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Limit orders per IP address</label>
                <div class="row py-2">
                    <div class="col-md-6">
                        <label for="fraud[allow_per_hour]">Allow per hour orders</label>
                        <x-input name="fraud[allow_per_hour]" :value="$fraud->allow_per_hour ?? 3" />
                        <x-error field="fraud[allow_per_hour]" />
                    </div>
                    <div class="col-md-6">
                        <label for="fraud[allow_per_day]">Allow per day orders</label>
                        <x-input name="fraud[allow_per_day]" :value="$fraud->allow_per_day ?? 7" />
                        <x-error field="fraud[allow_per_day]" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="fraud[max_qty_per_product]">Max quantity each product</label>
            <x-input name="fraud[max_qty_per_product]" :value="$fraud->max_qty_per_product ?? 3" />
            <x-error field="fraud[max_qty_per_product]" />
        </div>
    </div>
</div>
