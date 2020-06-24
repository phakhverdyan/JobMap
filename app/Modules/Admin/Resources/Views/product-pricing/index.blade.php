@extends('admin::layouts.app')

@section('content')
    <form action="product_pricing" method="POST">
        {{ csrf_field() }}
        <div>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p class="text-right"><button type="submit" class="btn btn-primary">Save</button></p>
            <div class="d-flex justify-content-around">
                <table class="table mr-5" style="width: auto;">
                    <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Price per location</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pricePerLocations as $item)
                        <tr>
                            <input type="hidden" name="location_id[]" value="{{ $item->id }}">
                            <td><input type="text" name="location_from[]" value="{{ $item->from }}"></td>
                            <td><input type="text" name="location_to[]" value="{{ $item->to }}"></td>
                            <td><input type="text" name="location_price[]" value="{{ $item->price }}"></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <table class="table ml-5" style="width: auto;">
                    <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Price per seat</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($pricePerSeats as $item)
                        <tr>
                            <input type="hidden" name="seats_id[]" value="{{ $item->id }}">
                            <td><input type="text" name="seats_from[]" value="{{ $item->from }}"></td>
                            <td><input type="text" name="seats_to[]" value="{{ $item->to }}"></td>
                            <td><input type="text" name="seats_price[]" value="{{ $item->price }}"></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </form>

@endsection