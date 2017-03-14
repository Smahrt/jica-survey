@extends('layouts.master')

@section('content') 
<h2>Results for survey: {{ $survey->title }}</h2>
<div class="col-md-12">
    <ul class="list-unstyled">
        @foreach ($responses as $response)
        <li>
            <div class="panel panel-default">
                <div class="panel-heading">
				
                    Response from: {{$response->first()->session_sid}}
                    <br/>
                    Survey type:
                    @if($response->first()->type == 'voice')
                    <span class="label label-primary">
                    @else
                    <span class="label label-success">
                    @endif
                        {{ $response->first()->type }}
                    </span>
                </div>
                <div class="panel-body">
                    @foreach ($response as $questionResponse)
                    <ol class="list-group">
                        <li class="list-group-item">Question: {{ $questionResponse->question->body }}</li>
                        <li class="list-group-item">Answer type: {{ $questionResponse->question->kind }}</li>
                        <li class="list-group-item">
                            @if($questionResponse->question->kind === 'free-answer' && $questionResponse->type === 'voice')
                            <div class="voice-response">
                                <span class="voice-response-text">Response:</span>
                                <i class="fa fa-play-circle fa-2x play-icon"></i>
                                <audio class="voice-response" src="{{ $questionResponse->response }}"></audio>
                            </div>
                            @elseif($questionResponse->question->kind === 'yes-no')
                                @if($questionResponse->response == 1)
                                YES
                                @else
                                NO
                                @endif
                            @else
                            {{ $questionResponse->response }}
                            @endif
                        </li>
                        @if(!is_null($questionResponse->transcription))
                        <li class="list-group-item">Transcribed Answer: {{ $questionResponse->transcription }}</li>
                        @endif
                    </ol>
                    @endforeach
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>


<table class="table">
    <thead>
        <tr><h2>Results for survey: {{ $survey->title }}</h2></tr>
        @foreach ($responses as $response)
        <tr><td></td></tr>
            <tr>
                <td>Response from: {{$response->first()->session_sid}}</td>
            </tr>
            <tr>
                <td>Type: {{$response->first()->type}}</td> 
            </tr>
            
    </thead>
    
    <tbody>
            @foreach ($response as $questionResponse)
                    <tr>
                        <td>Question: {{ $questionResponse->question->body }}</td>
                    </tr>
                    <tr>
                        <td>Answer type: {{ $questionResponse->question->kind }}</td>
                    </tr>
                        @if($questionResponse->question->kind === 'free-answer' && $questionResponse->type === 'voice')
                        <tr>
                            <td>
                                <div class="voice-response">
                                    <span class="voice-response-text">Response:</span>
                                    <i class="fa fa-play-circle fa-2x play-icon"></i>
                                    <audio class="voice-response" src="{{ $questionResponse->response }}"></audio>
                                </div>
                            </td>
                        </tr>
                        @elseif($questionResponse->question->kind === 'yes-no')
                            @if($questionResponse->response == 1)
                            <tr>
                                <td>Answer: YES</td>
                            </tr>
                            @else
                            <tr>
                                <td>Answer: NO</td>
                            </tr>
                            @endif
                        @else
                        <tr>
                            <td>Answer: {{ $questionResponse->response }}</td>
                        </tr>
                        @endif
                    @if(!is_null($questionResponse->transcription))
                    <li class="list-group-item">Transcribed Answer: {{ $questionResponse->transcription }}</li>
                    @endif
            @endforeach
        @endforeach
    </tbody>
    
</table>

<table class="table">
    <thead>
        <tr>
            <td></td>
                @foreach ($response as $questionResponse)
                    <td>{{ $questionResponse->question->body }}</td>
                @endforeach
        </tr>
        
            @foreach ($responses as $response)
                <tr>
                    <td>{{$response->first()->session_sid}}</td>
                        @foreach ($response as $questionResponse)
                            @if($questionResponse->question->kind === 'free-answer' && $questionResponse->type === 'voice')
                                <td>
                                    <i class="fa fa-play-circle fa-2x play-icon"></i>
                                    <audio class="voice-response" src="{{ $questionResponse->response }}"></audio>
                                </td>
                            @elseif($questionResponse->question->kind === 'yes-no')
                                @if($questionResponse->response == 1)
                                    <td>YES</td>
                                @else
                                    <td>NO</td>
                                @endif
                            @else
                                <td>{{ $questionResponse->response }}</td>
                            @endif
                        @if(!is_null($questionResponse->transcription))
                        <li class="list-group-item">Transcribed Answer: {{ $questionResponse->transcription }}</li>
                        @endif
                        @endforeach
                </tr>
            @endforeach
    </thead>

    <tbody>
    </tbody>
</table>



@stop
