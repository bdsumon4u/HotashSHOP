<div class="tab-pane active" id="item-analytics" role="tabpanel">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="gtm-id">Google Tag Manager ID</label>
                <x-input name="gtm_id" id="gtm_id" :value="$gtm_id ?? null" />
                <x-error field="gtm_id" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="pixel-ids">Pixel IDs (space separated)</label>
                <x-input name="pixel_ids" id="pixel-ids" :value="$pixel_ids ?? null" />
                <x-error field="pixel_ids" />
            </div>
        </div>
    </div>
</div>
