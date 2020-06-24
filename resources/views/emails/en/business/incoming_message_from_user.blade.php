It looks like you applied to {{ $business->name }}

50x50px {{ $business->picture }} {{ $business->name }}

Wishes to have you on JobMap to instant message and send you interview requests.

Please click on this link to create your Resume:

<a href="http://devx.jobmap.co?b={{ $business->id }}" target="_blank">http://devx.jobmap.co?b={{ $business->id }}</a>

If you already have an account, simply login and apply on their career page:
<a href="http://devx.jobmap.co/public/business/view/{{ $business->id }}/{{ $business->slug }}" target="_blank">http://devx.jobmap.co/public/business/view/{{ $business->id }}/{{ $business->slug }}</a>


