@extends('layouts.master')

@section('title', 'Create New Survey')

@section('content')

    <?php 
    /*if(isset($sucess)){
        echo '<div class="alert alert-success">
                    <button type="button" aria-hidden="true" class="close">×</button>
                    <span>'.$sucess.'</span>
                </div>';
    }else if(isset($error)){
        echo '<div class="alert alert-danger">
                    <button type="button" aria-hidden="true" class="close">×</button>
                    <span>'.$error.'</span>
                </div>';

    }*/
    ?>
    <div class="row">
        
                            @if(isset($info))
                                <div class="alert alert-success">
                                    {{ $info }}
                                </div>
                            @endif
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <!-- Toggle Button -->
            <div id="bd" class="align-center">
                <table>
                    <tr>
                        <td><span id="tts-label">Text-to-Speech (TTS)</span></td>
                        <td>
                            <div class="material-switch">
                                <input id="toggle-survey" type="checkbox" name="survey_toggle"/>
                                <label for="toggle-survey" class="label-default"></label>
                            </div>
                        </td>
                        <td>
                            <span id="vr-label" class="pull-right">Voice Recording</span>
                        </td>
                    </tr>
                
                </table>
                
            </div>
            
            <div class="card">
                <div id="surveyHead" class="card-header" data-background-color="dark">
                    <h4 class="title">Create New Survey <span class="sub-title"> - Text-to-Speech (TTS)</span></h4>
                    <p class="category">Create a new survey form by adding questions and forms of answers</p>
                </div>
                <div class="card-content">
                    <div id="#card">
                        <!-- FRONT:: TTS pane -->
                        <div class="front">
                            
                            <form action="{{ url('/save-survey') }}" method="post">
                                <div class="survey_hidden">
                                    <input id="survey_type" name="survey_type" value="TTS" />
                                    <input id="last_id" name="last_survey_id" value="1" />
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Survey Title</label>
                                            <input type="text" class="form-control" name="surveyTitle" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Introduction</label>
                                            <textarea class="form-control" name="surveyIntro" placeholder="Write a brief introduction for this survey" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="thequestion">
                                    <div class="title">
                                        <h4>Survey Questions</h4>
                                    </div>
                                    <div id="question-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">1. Question</label>
                                                    <textarea class="form-control" name="question_1" placeholder="Enter your question" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Response Type</label>
                                                    <select type="text" class="form-control" name="response_type_1">
                                                        <option disabled selected>Select Response Type</option>
                                                        <option value="free-answer">Free Response</option>
                                                        <option value="yes-no">Yes/No</option>
                                                        <option value="numeric">Numeric</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-success pull-right add-question">
                                                    Add Question
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning">Save Survey</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        
                        <!-- BACK:: Voice Recording pane -->
                        <div class="back hidden">
                            <form id="record-form" method="post" action="{{ url('/save-survey') }}">
                                <div class="survey_hidden">
                                    <input id="survey_type" name="survey_type" value="record" />
                                    <input id="last_id" name="last_survey_id" value="" />
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Survey Title</label>
                                            <input type="text" class="form-control" name="surveyTitle" id="surveyTitle" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="record-0">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Record Introduction</label>
                                            <div id="record-ctrl-0">
                                                <button id="start-btn-0" type="button" class="btn btn-simple btn-success start_btn"><i class="material-icons">play_arrow</i> Start Recording</button>
                                                <button id="stop-btn-0" type="button" class="btn btn-simple btn-danger stop_btn" disabled><i class="material-icons">stop</i> Stop Recording</button>
                                                <span id="recordLog-0"></span>
                                                <div class="output"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="therecord">
                                    <div class="title">
                                        <h4>Record Survey Questions</h4>
                                    </div>
                                    <div id="record-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-success pull-right add-record">
                                                    Add Question
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning">Save Survey</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        <!-- !END BACK:: Voice Recording pane -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        
        var audio_context;
        var recorder;
        
        /** Switch Forms on Button Toggle **/
        var back = $('.back');
        var front = $('.front');
        
        $('.material-switch :checkbox').click(function(){
            
            if(back.hasClass('hidden')){
                /** If Voice Recording is selected **/
                
                back.removeClass('hidden');
                
                $('.sub-title').html(' - Voice Recording');
                $('#surveyHead').attr('data-background-color', 'orange');
                
                front.addClass('hidden');
                
                //Check for recording capabilities on browser
                init();
                
            }else{
                /** If TTS is selected **/
                
                back.addClass('hidden');
                
                $('.sub-title').html(' - Text-to-Speech (TTS)');
                $('#surveyHead').attr('data-background-color', 'dark');
                
                front.removeClass('hidden');
                
            }
        });
        
        /** Survey Questions Add **/
        var id = 2;
        var i = 1;
        /** Add TTS **/
        $('.front #thequestion').on("click", '.add-question', function(){
                    var nextquestion = `<div id="question-`+ id +`">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label class="control-label">`+ id +`. Question</label>
                            <textarea class="form-control" name="question_`+ id +`" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Response Type</label>
                            <select type="text" class="form-control" name="response_type_`+ id +`">
                                <option disabled selected>Select Response Type</option>
                                <option value="free-answer">Free Response</option>
                                <option value="yes-no">Yes/No</option>
                                <option value="numeric">Numeric</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-success pull-right add-question">
                            Add Question
                        </button>
                    </div>
                </div>
            </div>`;
            $('#thequestion').append(nextquestion);
            
            $(this).removeClass("add-question").hide();
            
            $('.front #last_id').attr('value', id); //Update the last question id in the form
            
            id++;
            
        });
        
        /** ADD Record **/
        $('.back #therecord').on("click", '.add-record', function(){
            var pn = i-1;
            var getCtrl = $("#record-ctrl-"+pn+" > .output");
            var getText = $("#recordLog-"+pn);
            if (getCtrl.hasClass('empty')){
                getText.text("Please record the previous question.");
            }else{
                var next = `<div id="record-`+ i +`">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">`+ i +`. Question</label>
                                    <div id="record-ctrl-`+ i +`">
                                        <button type="button" id="start-btn-`+i+`" class="btn btn-simple btn-success start_btn"><i class="material-icons">play_arrow</i> Start Recording</button>
                                        <button type="button" id="stop-btn-`+i+`" class="btn btn-simple btn-danger stop_btn" disabled><i class="material-icons">stop</i> Stop Recording</button>
                                        <span id="recordLog-`+ i +`"></span>
                                        <div class="output"></div>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="record-type-`+ i +`">
                        <div class="form-group">
                            <label class="control-label">Response Type</label>
                            <select type="text" class="form-control" name="response_type_`+i+`" id="response_type_`+i+`" required>
                                <option disabled selected>Select Response Type</option>
                                <option value="free-answer">Free Response</option>
                                <option value="yes-no">Yes/No</option>
                                <option value="numeric">Numeric</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-success pull-right add-record">
                            Add Question
                        </button>
                    </div>
                </div>`;

                $('#therecord').append(next);

                $(this).removeClass("add-record").hide();

                /** Disable Further Receording on previous Field **/
                $('#stop-btn-'+pn).removeClass('stop_btn');
                $('#start-btn-'+pn).removeClass('start_btn');
                $('#record-ctrl-'+pn+' > .output button.del').remove();
                
                /** Save Recording **/
                var audioData = $("#record-ctrl-"+pn + " > .output > span > audio").attr("id");
                
                //Sending the audio file to the upload.php script
                $.post('/upload', {
                    rawAudioData: audioData,
                    audio_id: pn
                }, function(a){
                   console.log(a.res); 
                });
                
                $("#recordLog-"+pn).text("Saved Recording");
                /** END:: Save recording **/
                
                
                $('.back #last_id').attr('value', i); //Update the last record id in the form

                i++;
                
            }
        });
        
        /** Create New Survey::Functions(); **/
        
    function __log(e, data) {
        var logInfo;
        logInfo += "\n" + e + " " + (data || '');
        console.log(logInfo);
    }
    
        
    function init() {
        try {
          // webkit shim
          window.AudioContext = window.AudioContext || window.webkitAudioContext;
            //added support for firefox
          navigator.getUserMedia = ( navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

          window.URL = window.URL || window.webkitURL;

          audio_context = new AudioContext;
          __log('Audio context set up.');
          __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
} catch (e) {
          alert('No web audio support in this browser!');
        }

        navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
                      __log('No live audio input: ' + e);
                    });
    }
        
        
    function startUserMedia(stream) {
        var input = audio_context.createMediaStreamSource(stream);
        __log('Media stream created.');

        // Uncomment if you want the audio to feedback directly
        //input.connect(audio_context.destination);
        //__log('Input connected to audio context destination.');

        recorder = new Recorder(input);
        __log('Recorder initialised.');
    }
        
    function startRecording(btn, id) {
        var logid = "#recordLog-"+id;

        recorder && recorder.record();

        btn.disabled = true;
        btn.nextElementSibling.disabled = false;
        $(logid).text('Recording...');

    }

    function stopRecording(btn, id) {
        var logid = "#recordLog-" + id;

        recorder && recorder.stop();

        btn.disabled = true;
        btn.previousElementSibling.disabled = false;
        $(logid).text('Stopped Recording...');

        // create WAV download link using audio data blob
        createDownloadLink(id);

        recorder.clear();
    }

    function createDownloadLink(id) {
        var logctrl = "#record-ctrl-"+id + " > .output";
        
            recorder && recorder.exportWAV(function(blob) {
                
                var url = URL.createObjectURL(blob);
                //var dataURL = blobToDataURL(blob, function(url);
                var span = document.createElement('span');
                var audio = document.createElement('audio');
                var hf = document.createElement('a');
                var delBtn = '<button id="del-'+id+'" class="btn btn-simple btn-xs btn-danger pull-right del" type="button"><i class="material-icons">close</i></button>';

                audio.controls = true;
                audio.src = url;
                hf.href = url;
                hf.download = new Date().toISOString() + '.wav';
                //hf.innerHTML = hf.download;
                span.appendChild(audio);
                span.appendChild(hf);
                
                //Test this
                var reader = new window.FileReader();
                reader.readAsDataURL(blob); 
                reader.onloadend = function() {
                            dataURL = reader.result; // Base64 data
                            
                            $(logctrl+ " > span > audio").attr("id", dataURL);
                }
                //--END test 
                
                $(logctrl).wrapInner(span);
                $(logctrl+ " > span").append(delBtn);
                
            });
    } 
        
        /** Add Click functions to buttons:: START RECORD :: STOP RECORD :: DELETE RECORD **/
        
        $('body').on('click', '.start_btn', function(){
            var btn_id = $('.start_btn').attr('id'); //start-btn-(num) - 10
            var num = btn_id.slice(10).trim();
            
            startRecording(this, num);
            
        });
        
        $('body').on('click', '.stop_btn', function(){
            var btn_id = $('.stop_btn').attr('id'); //stop-btn-(num) - 9
            var num = btn_id.slice(9).trim();
            var nextnum = parseInt(num)+1;

            var record_id = "#record-ctrl-"+num;
            
            stopRecording(this, num);
            $(record_id + " > .output").removeClass('empty');
            
        });
        
        $('body').on('click', '.del', function(){
            var del_id = $('.del').attr('id'); //del-(num) - 4
            var num = del_id.slice(4).trim();
            var record_id = "#record-ctrl-"+num;
            
            $(record_id + " > .output").empty().addClass('empty');
            $("#recordLog-"+num).text("");
            
        });
        
        /** HERE::Sending Data to server **/
        $(".back #record-form").submit(function () {
            event.preventDefault();
            
            //post record form data
            $.post('/save-survey', {
                last_id: $('#last_id').val(),
                survey_type: $('#survey_type').val(),
                survey_title: $('#survey_title').val()
                
            }, function(res){
               alert(res); 
            });
        });
        
});
</script>
{!! HTML::script('assets/js/libs/RecorderJS/recorder.js') !!}
@endsection
