@extends('layouts.light.master')

@section('title', 'Couriers')

@section('breadcrumb-title')
    <h3>Couriers</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Couriers</li>
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="orders-table">
                <div class="card rounded-0 shadow-sm">
                    <div class="card-header p-3"><strong>Configuration</strong></div>
                    <div class="card-body p-3">
                        <x-form :action="route('admin.couriers.store')" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-auto">
                                    <div class="checkbox checkbox-secondary">
                                        <input type="hidden" name="Pathao[enabled]" value="0">
                                        <x-checkbox id="Pathao" name="Pathao[enabled]" value="1"
                                            :checked="$Pathao->enabled" />
                                        <x-label for="Pathao" />
                                    </div>
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input name="Pathao[username]" :value="$Pathao->username" placeholder="Type Pathao username here" />
                                    <x-error field="Pathao[username]" />
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input type="password" name="Pathao[password]" placeholder="Type Pathao password here" />
                                    <x-error field="Pathao[password]" />
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input name="Pathao[client_id]" :value="$Pathao->client_id" placeholder="Type API client_id here" />
                                    <x-error field="Pathao[client_id]" />
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input name="Pathao[client_secret]" :value="$Pathao->client_secret" placeholder="Type API client_secret here" />
                                    <x-error field="Pathao[client_secret]" />
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input name="Pathao[store_id]" :value="$Pathao->store_id" placeholder="Type store_id here" />
                                    <x-error field="Pathao[store_id]" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-auto">
                                    <div class="checkbox checkbox-secondary">
                                        <input type="hidden" name="SteadFast[enabled]" value="0">
                                        <x-checkbox id="SteadFast" name="SteadFast[enabled]" value="1"
                                            :checked="$SteadFast->enabled" />
                                        <x-label for="SteadFast" />
                                    </div>
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input name="SteadFast[key]" :value="$SteadFast->key" placeholder="Type API key here" />
                                    <x-error field="SteadFast[key]" />
                                </div>
                                <div class="form-group col-md-auto">
                                    <x-input name="SteadFast[secret]" :value="$SteadFast->secret"
                                        placeholder="Type API secret here" />
                                    <x-error field="SteadFast[secret]" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
