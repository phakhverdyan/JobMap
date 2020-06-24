@extends('admin::layouts.app')

@section('content')
    <div class="container">
        <p class="text-center">Taxes</p>
        <form action="tax" method="POST">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-primary float-right" style="z-index: 2;position:relative; top:-42px">
                Save
            </button>

            @if($errors->any())
                <div class="alert alert-danger" role="alert" style="width: 50%;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-4">
                <div class="row">
                    <input type="hidden" name="tax_config_id"
                           value="{{ isset($tax_config) ? $tax_config->id : '' }}">
                    <div class="pt-2"><span>GST Number</span></div>
                    <div class="col-8"><input type="text" name="gst_number"
                                              value="{{ isset($tax_config) ? $tax_config->gst_number : '' }}"
                                              class="form-control"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mt-3">
                    <div class="pt-2"><span>QST Number</span></div>
                    <div class="col-8"><input type="text" name="qst_number"
                                              value="{{ isset($tax_config) ? $tax_config->qst_number : '' }}"
                                              class="form-control"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="row mt-3">
                    <div class="pt-2"><span>QC Company Number</span></div>
                    <div class="col-8"><input type="text" name="qc_company_number"
                                              value="{{ isset($tax_config) ? $tax_config->qc_company_number : '' }}"
                                              class="form-control"></div>
                </div>
            </div>

            <div class="row mt-5">
                <p class="text-center w-100">Provinces % Rates</p>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">Code</th>
                        <th class="text-center">Province FR</th>
                        <th class="text-center">Province EN</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Rate</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taxes as $tax)
                        <tr>
                            <td class="text-center">{{ $tax->code }}</td>
                            <input type="hidden" name="id[]" value="{{ $tax->id }}">
                            <td class="text-center"><input type="text" name="province_fr[]"
                                                           value="{{ $tax->province_fr }}" class="text-center"></td>
                            <td class="text-center"><input type="text" name="province_en[]"
                                                           value="{{ $tax->province_fr }}" class="text-center"></td>
                            <td class="text-center"><input type="text" name="type_1[]" value="{{ $tax->type_1 }}"
                                                           class="text-center"></td>
                            <td class="text-center"><input type="text" name="rate_1[]" value="{{ $tax->rate_1 }}"
                                                           class="text-center"> %
                            </td>
                            <td class="text-center"><input type="text" name="type_2[]" value="{{ $tax->type_2 }}"
                                                           class="text-center"></td>
                            <td class="text-center"><input type="text" name="rate_2[]" value="{{ $tax->rate_2 }}"
                                                           class="text-center"> %
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>


        </form>


    </div>
@endsection