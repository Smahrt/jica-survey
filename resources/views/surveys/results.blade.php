@extends('layouts.master')

@section('content') 
<h2>Results for survey: {{ $survey->title }}</h2>
<button id="btnExport" class="btn btn-primary" onclick="ExportToExcel();" > Export to Excel </button>
<button id="" class="btn btn-primary" onclick ="printPdf();"> Export to PDF </button>
<div media="print" id="form" class="col-md-12">
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

<table id="txtArea1" class="table" border="1">
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
                                    Voice
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


<!--<table id="form" class="table">
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
    
</table>-->


<!--<iframe id="txtArea1" style="display:none"></iframe>-->

<script type="text/javascript">
    
function ExportToExcel(){
       var htmltable= document.getElementById('txtArea1');
       var html = htmltable.outerHTML;
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    
    }
function ExportToPdf(){
   var htmltable= document.getElementById('form');
   var html = htmltable.outerHTML;
   window.open('data:application/pdf,' + encodeURIComponent(html));

}
    
function printPdf()
{
    
var DocumentContainer = document.getElementById('form');
var WindowObject = window.open("", "PrintWindow",
"width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
    
WindowObject.document.write('<html><head><title>Survey Print Out</title><link media="print" rel="stylesheet" type="text/css" href="../../../public/assets/css/custom.css"></head><body>');
    
WindowObject.document.writeln(DocumentContainer.innerHTML);
    
WindowObject.document.write('</body></html>');

//WindowObject.document.close();
WindowObject.focus();
WindowObject.print();
WindowObject.close();
}


</script>
    
    

@stop
