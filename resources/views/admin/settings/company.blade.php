<div class="tab-pane active" id="item-1" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Logo</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="desktop-logo" class="d-block">
                    <div>Desktop Logo ({{ config('services.logo.desktop.width', 260) }}x{{ config('services.logo.desktop.height', 54) }})</div>
                    <img src="{{ asset($logo->desktop ?? '') ?? '' }}" alt="desktop Logo" class="img-responsive d-block" width="{{ config('services.logo.desktop.width', 260) }}" height="{{ config('services.logo.desktop.height', 54) }}" style="@unless($logo->desktop ?? '') display:none; @endunless">
                </label>
                <input type="file" name="logo[desktop]" id="desktop-logo" class="form-control mb-1 @if($logo->desktop ?? '') d-none @endif">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mobile-logo" class="d-block">
                    <div>Mobile Logo ({{ config('services.logo.mobile.width', 192) }}x{{ config('services.logo.mobile.height', 40) }})</div>
                    <img src="{{ asset($logo->mobile ?? '') ?? '' }}" alt="mobile Logo" class="img-responsiv d-blocke" width="{{ config('services.logo.mobile.width', 192) }}" height="{{ config('services.logo.mobile.height', 40) }}" style="@unless($logo->mobile ?? '') display:none; @endunless">
                </label>
                <input type="file" name="logo[mobile]" id="mobile-logo" class="form-control mb-1 @if($logo->mobile ?? '') d-none @endif">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="favicon-logo" class="d-block">
                    <div>Favicon ({{ config('services.logo.favicon.width', 56) }}x{{ config('services.logo.favicon.height', 56) }})</div>
                    <img src="{{ asset($logo->favicon ?? '') ?? '' }}" alt="Favicon" class="img-responsive d-block" width="{{ config('services.logo.favicon.width', 56) }}" height="{{ config('services.logo.favicon.height', 56) }}" style="@unless($logo->favicon ?? '') display:none; @endunless">
                </label>
                <input type="file" name="logo[favicon]" id="favicon-logo" class="form-control mb-1 @if($logo->favicon ?? '') d-none @endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Info</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="company-name">Company Name</label>
                <x-input name="company[name]" id="company-name" :value="$company->name ?? ''" />
                <x-error field="company.name" />
            </div>
            <div class="form-group">
                <label for="company-email">Company Email</label>
                <x-input name="company[email]" id="company-email" :value="$company->email ?? ''" />
                <x-error field="company.email" />
            </div>
            <div class="form-group">
                <label for="company-phone">Company Phone</label>
                <x-input type="tel" name="company[phone]" id="company-phone" :value="$company->phone ?? ''" />
                <x-error field="company.phone" />
            </div>
            <div class="form-group">
                <label for="whatsapp-number">Whatsapp No.</label>
                <x-input type="tel" name="company[whatsapp]" id="whatsapp-number" :value="$company->whatsapp ?? ''" />
                <x-error field="company.whatsapp" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="company-tagline">Company Tagline</label>
                <x-textarea name="company[tagline]" id="company-tagline">{{ $company->tagline ?? '' }}</x-textarea>
                <x-error field="company.tagline" />
            </div>
            <div class="form-group">
                <label for="company-address">Company Address</label>
                <x-textarea name="company[address]" id="company-address">{{ $company->address ?? '' }}</x-textarea>
                <x-error field="company.address" />
            </div>
            <div class="form-group">
                <label for="">Call For Order (space separated)</label>
                <x-input type="tel" name="call_for_order" id="call_for_order" :value="$call_for_order ?? null" />
                <x-error field="call_for_order" />
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
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