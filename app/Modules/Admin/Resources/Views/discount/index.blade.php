@extends('admin::layouts.app')

@section('content')
    <div>
        <form action="discount/add" method="POST">
            {{ csrf_field() }}
            <div>
                <p class="text-center">New discount</p>
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="d-flex justify-content-around">
                    <div class="mx-2" style="width: 150px;">
                        <p class="text-center">Discount name</p>
                        <p><input type="text" name="name" class="form-control"></p>
                    </div>
                    <div class="mx-2" style="width: 150px;">
                        <p class="text-center">Discount code</p>
                        <p><input type="text" name="code" class="form-control"></p>
                    </div>
                    <div class="mx-2" style="width: 150px;">
                        <p class="text-center">Off an plans</p>
                        <div class="d-flex">
                            <input type="text" name="off_an_plans_value" class="form-control" style="width: 50%;">
                            <select name="off_an_plans_type" class="form-control" style="width: 50%;">
                                <option value="$">$</option>
                                <option value="%">%</option>
                            </select>
                        </div>
                    </div>
                    {{--<div class="mx-2" style="width: 150px;">--}}
                    {{--<p class="text-center">Off on seats</p>--}}
                    {{--<div class="d-flex">--}}
                    {{--<input type="text" name="off_on_seats_value" class="form-control" style="width: 50%;">--}}
                    {{--<select name="off_on_seats_type" class="form-control" style="width: 50%;">--}}
                    {{--<option value="$">$</option>--}}
                    {{--<option value="%">%</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <div class="mx-2" style="width: 150px;">
                        <p class="text-center">Off on month</p>
                        <div class="d-flex">
                            <input type="text" name="off_on_month_value" class="form-control" style="width: 50%;">
                            <select name="off_on_month_type" class="form-control" style="width: 50%;">
                                <option value="$">$</option>
                                <option value="%">%</option>
                            </select>
                        </div>
                    </div>
                    <div class="mx-2" style="width: 150px;">
                        <p class="text-center">Duration</p>
                        <div class="d-flex">
                            <input type="text" name="duration_value" class="form-control" style="width: 50%;">
                            <div class="text-center align-self-center" style="width: 50%; "> Month</div>
                        </div>
                    </div>
                    <div class="mx-2" style="width: 150px;">
                        <p class="text-center">Status</p>
                        <div class="d-flex">
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Paused</option>
                            </select>
                        </div>
                    </div>
                    <div class="mx-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Create</button>
                    </div>
                </div>
            </div>
        </form>


        <div>
            <p class="text-left"><span class="pl-3"><strong>Discounts</strong></span> <span
                        style="float: right; margin-right: 90px;"><strong>Users</strong></span></p>

            @foreach($discounts as $discount)

                <form action="discount/update/{{ $discount->id }}" method="POST">
                    <div class="d-flex justify-content-around">
                        {{ csrf_field() }}
                        <div class="mx-2" style="width: 150px;">
                            <p><input type="text" name="name" value="{{ $discount->name }}" class="form-control"></p>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <p><input type="text" name="code" value="{{ $discount->code }}" class="form-control"></p>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <div class="d-flex">
                                <input type="text" name="off_an_plans_value" value="{{ $discount->off_an_plans_value }}"
                                       class="form-control" style="width: 50%;">
                                <select name="off_an_plans_type" class="form-control" style="width: 50%;">
                                    <option value="$" {{ $discount->off_an_plans_type == '$'? 'selected': '' }}>$
                                    </option>
                                    <option value="%" {{ $discount->off_an_plans_type == '%'? 'selected': '' }}>%
                                    </option>
                                </select>
                            </div>
                        </div>
                        {{--<div class="mx-2" style="width: 150px;">--}}
                        {{--<div class="d-flex">--}}
                        {{--<input type="text" name="off_on_seats_value" value="{{ $discount->off_on_seats_value }}" class="form-control" style="width: 50%;">--}}
                        {{--<select name="off_on_seats_type" class="form-control" style="width: 50%;">--}}
                        {{--<option value="$" {{ $discount->off_on_seats_type == '$'? 'selected': '' }}>$</option>--}}
                        {{--<option value="%" {{ $discount->off_on_seats_type == '%'? 'selected': '' }}>%</option>--}}
                        {{--</select>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="mx-2" style="width: 150px;">
                            <div class="d-flex">
                                <input type="text" name="off_on_month_value" value="{{ $discount->off_on_month_value }}"
                                       class="form-control" style="width: 50%;">
                                <select name="off_on_month_type" class="form-control" style="width: 50%;">
                                    <option value="$" {{ $discount->off_on_month_type == '$'? 'selected': '' }}>$
                                    </option>
                                    <option value="%" {{ $discount->off_on_month_type == '%'? 'selected': '' }}>%
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <div class="d-flex">
                                <input type="text" name="duration_value" value="{{ $discount->duration_value }}"
                                       class="form-control" style="width: 50%;">
                                <div class="text-center align-self-center" style="width: 50%; "> Month</div>
                            </div>
                        </div>
                        <div class="mx-2" style="width: 150px;">
                            <div class="d-flex">
                                <select name="status" class="form-control" >
                                    <option value="1" {{ $discount->status == 1? 'selected': '' }}>Active</option>
                                    <option value="0" {{ $discount->status == 0? 'selected': '' }}>Paused</option>
                                </select>
                            </div>
                        </div>
                        <div class="mx-2">
                            <p class="mb-0 pt-1"><a href="">43</a></p>
                        </div>
                        <div class="mx-2">
                            <button type="submit" class="btn btn-primary">Modify</button>
                        </div>
                    </div>
                </form>




            @endforeach
        </div>

    </div>

    </div>
@endsection