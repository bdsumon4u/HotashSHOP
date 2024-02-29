<div class="tab-pane active" id="item-color" role="tabpanel">
    @foreach(['topbar' => 'Top Bar', 'header' => 'Header', 'navbar' => 'Nav Bar', 'footer' => 'Footer', 'primary' => 'Primary', 'secondary' => 'Secondary'] as $id => $title)
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">{{ $title}}</small></h4>
        </div>
        @foreach(['background_color' => 'Background Color', 'background_hover' => 'Background Hover', 'text_color' => 'Text Color', 'text_hover' => 'Text Hover'] as $key => $label)
        <div class="col-md-3">
            <div class="form-group">
                <label for="">{{ $label }}</label>
                <x-input type="color" name="color[{{ $id }}][{{ $key }}]" :value="$color->$id->$key ?? null" />
                <x-error field="color.{{ $id }}.{{ $key }}" />
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
