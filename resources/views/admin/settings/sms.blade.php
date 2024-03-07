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
    <div class="form-row border-top border-bottom mt-2 pt-2 mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">OTP Template</label>
                <x-textarea name="SMSTemplates[otp]" id="SMSTemplates[otp]">{{$SMSTemplates->otp ?? null}}</x-textarea>
                <x-error field="SMSTemplates[otp]" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Confirmation Template</label>
                <x-textarea name="SMSTemplates[confirmation]" id="SMSTemplates[confirmation]">{{$SMSTemplates->confirmation ?? null}}</x-textarea>
                <x-error field="SMSTemplates[confirmation]" />
            </div>
        </div>
    </div>
</div>
