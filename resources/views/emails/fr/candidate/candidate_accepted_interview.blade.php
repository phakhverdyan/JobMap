@extends('emails.fr.layouts.main')

@section('body')
	{{ $user->full_name }} a accepté votre demande d'entrevue.

	Interview details:
	Interviewer name: {{ $interview_request->interviewer_name }}
	Interview date: {{ \Carbon\Carbon::parse($interview_request->date)->format('Y-m-d H:i:s') }}
    @if ($interview_request->type == 'via_phone')
        Via phone: { $interview_request->phone_number }}
    @elseif ($interview_request->type == 'in_person')
        In person, address: {{ $interview_request->address }}
    @elseif ($interview_request->type == 'via_skype_voice')
        Via skype voice: {{ $interview_request->messenger_identifier }}
    @elseif ($interview_request->type == 'via_skype_video')
        Via skype video: {{ $interview_request->messenger_identifier }}
    @elseif ($interview_request->type == 'via_im')
        Via IM {{ $interview_request->messenger_identifier }}
    @endif

	Vous pouvez changer les conditions d'entrevue dans la section "Entrevue" du Tableau de bord.

@endsection
