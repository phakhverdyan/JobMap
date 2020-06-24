<tr style="background-color: rgba(6,70,166,0.05);">

    <td class="text-center">{{ $args['card_brand'] }}</td>

    <td class="text-center">{{ $args['owner'] }}</td>

    <td class="text-center">
        <img src="/img/{{ strtolower($args['card_brand']) }}.png" style="height: 20px; margin-top: -3px;" class="mr-1">
        XXXX XXXX XXXX {{ $args['card_last_four'] }}
    </td>
    <td class="text-center"> {{ $args['expire_month'] }} - {{ $args['expire_year'] }}</td>
    <td class="text-center">
        @if($args['is_default'] === 1)
            <span>{!! trans('main.status.default') !!}</span>
        @else
            <button type="button" class="btn btn-warning px-3 js-set-primary"
                    style="padding: .15rem .5rem; font-size: 13px; margin-top: -3px;"
                    data-toggle="tooltip" data-placement="top" data-id="{{$args['id']}}"
                    title="Set as the default payment method">{!! trans('main.buttons.set') !!}
            </button>
        @endif
    </td>
    <td class="text-center">
        @if($args['is_default'] !== 1)
            <img src="/img/sidebar/not-active.png" class="js-removeCard c-pointer" data-id="{{$args['id']}}"
                 style="margin-top: -3px;"/>
        @endif
    </td>
</tr>