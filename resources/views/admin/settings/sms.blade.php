<div class="tab-pane active" id="item-sms" role="tabpanel">
    <div class="form-row">
        <div class="form-group col-md-auto">
            <div class="checkbox checkbox-secondary">
                <input type="hidden" name="BDWebs[enabled]" value="0">
                <x-checkbox id="BDWebs" name="BDWebs[enabled]" value="1"
                    :checked="!!($BDWebs->enabled ?? false)" />
                <x-label for="BDWebs" />
            </div>
        </div>
        <div class="form-group col-md-auto">
            <x-input name="BDWebs[api_key]" :value="$BDWebs->api_key ?? ''" placeholder="Type API key here" />
            <x-error field="BDWebs[api_key]" />
        </div>
        <div class="form-group col-md-auto">
            <x-input name="BDWebs[sender_id]" :value="$BDWebs->sender_id ?? ''"
                placeholder="Type API sender_id here" />
            <x-error field="BDWebs[sender_id]" />
        </div>
    </div>
</div>
