<tr>

    <td class="text-center pt-3">{{ $args['invoice_id'] }}  @if($args['status'] ==='refund')
            {!! trans('main.status.refunded') !!} @endif  @if($args['is_canceled'] ===1) {!! trans('main.status.canceled') !!} @endif</td>

    <td class="text-center pt-3">{{ $args['created_at'] }}</td>

    <td class="text-center pt-3">
        @if($args['is_canceled'] ===0)
            {!! trans('main.label.cc') !!}
        @endif
    </td>
    <td class="text-center pt-3">
        @if($args['status'] === 'paid')
            @if($args['is_canceled'] === 0)
                <a href="billing/invoice/{{$args['charge_id']}}" target="_blank"
                   class="button pay-success-button">{!! trans('main.buttons.paid') !!}</a>
            @endif
        @elseif($args['status'] === 'unpaid')
            @if($args['is_canceled'] ===0)
                <a href="billing/invoice/{{$args['charge_id']}}" target="_blank" class="button pay-err-button">{!! trans('main.buttons.payment_error') !!}</a>
            @endif
        @else
            <a href="billing/invoice/{{$args['charge_id']}}" target="_blank" class="button pay-err-button">{!! trans('main.buttons.refund') !!}</a>
        @endif
    </td>
    <td class="text-center pt-3">${{ $args['total'] }} USD</td>
    <td class="text-center pt-3">
        @if($args['is_canceled'] ===1)

        @else
            <div class="link">
                <img class="mr-1" src="{{ url('/') }}/img/pdf.png">
                <a href="billing/invoice/{{$args['charge_id']}}/pdf">{!! trans('main.buttons.pdf') !!}</a>
            </div>
        @endif

    </td>
    <td class="pt-2 text-right">
        @if($args['status'] ==='unpaid')
            <button class="btn btn-outline-success mr-0" type="button" data-id="{{ $args['id'] }}">
                {!! trans('main.buttons.pay') !!}
            </button>
        @endif
    </td>
</tr>
