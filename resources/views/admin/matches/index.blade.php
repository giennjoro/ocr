@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Matches | <small>The result column is editable for all played matches.</small></h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $param }} Matches <small>Details</small></h2>
                    @if ($param == 'Recent')
                    <ul class="nav navbar-nav navbar-right">
                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                                aria-expanded="false" style="width: auto">
                                <span class="fa fa-chevron-down">
                                    Select Time range ({{ $days }} days)
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a href="{{ route('matches.recent', ['days' => 1]) }}">
                                        <h5>Yesterday</h5>
                                        <span class="message">
                                            See matches played since yesterday.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('matches.recent', ['days' => 2]) }}">
                                        <h5>Last 2 days</h5>
                                        <span class="message">
                                            See matches played since the day before yesterday.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('matches.recent', ['days' => 7]) }}">
                                        <h5>Since last week</h5>
                                        <span class="message">
                                            See matches played for the last 7 days.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('matches.recent', ['days' => 30]) }}">
                                        <h5>Since last month</h5>
                                        <span class="message">
                                            See matches played for the last 30 days.
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Leag</th>
                                <th>Date</th>
                                <th>Match</th>
                                <th>Tip</th>
                                <th>Pro</th>
                                <th>Result</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matches as $match)
                            <tr>
                                <td>{{ $match->league }}</td>
                                <td>{{ date('l jS, M Y  h:i a', strtotime($match->time)) }}</td>
                                <td>{{ $match->home }} vs {{ $match->away }}</td>
                                <td>{{ $match->tip }}</td>
                                <td><i class="fa fa-check" style="display:{{ $match->pro? ' ' :'none'}}"></i></td>
                                <td style="color: {{ $match->won? 'green' : 'red' }}">
                                    @if ($match->time >= date('Y-m-d H:i:s', strtotime($current_time)))
                                    {{ $match->outcome }}
                                    @else
                                    <div contenteditable id="contenteditable{{ $match->id }}">{{ $match->outcome }}
                                    </div>
                                    @endif

                                </td>
                                <td>
                                    {{-- <a href="{{ route('matches.show', ['slug' => $match->slug]) }}"
                                        class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> --}}
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target=".{{ $match->slug }}"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                        data-target=".{{ $match->slug.'large' }}"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $matches->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Larger Modal #Edit--}}
@foreach ($matches as $match)
<div class="modal fade bs-example-modal-lg {{ $match->slug.'large' }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['action' => ['MatchController@update', 'slug' =>
            $match->slug],
            'method' => 'PUT', 'class' => 'form-horizontal form-label-left',
            'data-parsley-validate', 'id' => 'demo-form2']) !!}
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Match</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Fill Match Details <small>Fields with asterik(*) are madatory</small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="col-xs-12" for="league">League <span class="required">*</span>
                                            </label>
                                            <div class="col-xs-12">
                                                <input type="text" id="league" name="league" required="required"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{ $match->league }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="home">Home Team <span
                                                    class="required">*</span>
                                            </label>
                                            <div class=" col-xs-12">
                                                <input type="text" id="home" name="home" required="required"
                                                    class="form-control col-md-7 col-xs-12" value="{{ $match->home }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="away">Away Team <span
                                                    class="required">*</span>
                                            </label>
                                            <div class=" col-xs-12">
                                                <input type="text" id="away" name="away" required="required"
                                                    class="form-control col-md-7 col-xs-12" value="{{ $match->away }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="tip">Tip <span class="required">*</span>
                                            </label>
                                            <div class=" col-xs-12">
                                                <input type="text" id="tip" name="tip" required="required"
                                                    class="form-control col-md-7 col-xs-12" value="{{ $match->tip }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label class="col-xs-12" for="time">Date & Time<span
                                                    class="required">*</span>
                                            </label>
                                            <div class=" col-xs-12">
                                                <div class='input-group date' id='datetimepicker{{ $match->id }}'>
                                                    <input type='text' id="time" name="time" required="required"
                                                        class="form-control col-md-7 col-xs-12"
                                                        placeholder="mm/dd/yyyy hh:mm AM"
                                                        value="{{ date('m/d/Y H:i:s', strtotime($match->time)) }}" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                      $('#datetimepicker{{ $match->id }}').datetimepicker({
                                                          useCurrent: false, //Important! See issue #1075
                                                      });
                                                  });
                                        </script>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="odd">Odd<span class="required">*</span>
                                            </label>
                                            <div class=" col-xs-12">
                                                <input type="text" id="odd" name="odd" required="required"
                                                    class="form-control col-md-7 col-xs-12" value="{{ $match->odd }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="pro" {{ $match->pro == true? 'checked': '' }}
                                                value='true'>
                                            {{ Form::label('pro', 'Mark as a Pro Tip') }}
                                            <input type="radio" name="pro" {{ $match->pro == false? 'checked': '' }}
                                                style="margin-left: 10%;" value='false'>
                                            {{ Form::label('pro', 'Mark as a Free Tip') }}
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="outcome">Result
                                            </label>
                                            <div class=" col-xs-12">
                                                <input type="text" id="outcome_edit{{ $match->id }}" name="outcome"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{ $match->outcome }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('message', 'Was the outcome as predicted?') }}
                                            <input type="radio" id="won_edit{{ $match->id }}" name="won"
                                                {{ $match->won == true? 'checked': ''}} value='true'>
                                            {{ Form::label('won', 'Yes') }}
                                            <input type="radio" id="lost_edit{{ $match->id }}" name="won"
                                                {{ $match->won == false? 'checked': ''}} style="margin-left: 5%;"
                                                value='false'>
                                            {{ Form::label('won', 'Nope') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <h4>Note:</h4>
                                <ul>
                                    <li>If you mark outcome field as 'yes', then the result field is required.</li>
                                    <li>You don't have to fill the result field after marking the outcome field as
                                        'nope'.</li>
                                    <li>If you fill the result field, you must state whether the outcome was as
                                        predicted or not.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="reset"><i class="fa fa-undo"></i>
                    Reset</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i>Edit Match</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Small modal -->


<div class="modal fade bs-example-modal-sm {{ $match->slug }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete Match</h4>
            </div>
            <div class="modal-body">
                <h4>Confirmation</h4>
                <p>Are you sure you want to delete this match? This action cannot be
                    undone once confirmed.</p>

            </div>
            {!! Form::open(['action' => ['MatchController@destroy',
            $match->slug], 'method' => 'DELETE']) !!}
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Cancel</button>
                @csrf
                <button class="btn btn-xs btn-danger" type="submit" id="delete-{{ $match->id }}">Remove</button>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@if($match->time < date('Y-m-d H:i:s', strtotime(now()))) {{-- Store changes --}} <script>
    var contents{{ $match->id }} = $('#contenteditable{{ $match->id }}').html();
    $('#contenteditable{{ $match->id }}').on('keypress',function(e) {
    if(e.which == 13) {
    $('#contenteditable{{ $match->id }}').blur();
    }
    });
    $('#contenteditable{{ $match->id }}').blur(function() {
    if (contents{{ $match->id }}!=$(this).html()){
    $('#button{{ $match->slug }}').click();
    $('#outcome{{ $match->id }}').text('{{ $match->home }} vs {{ $match->away }}: ' + $(this).text());
    $('#outcome_field{{ $match->id }}').val($(this).text());
    }
    $str1 = $(this).text();
    var myString = $str1.replace(/^\s+|\s+$/g, '');
    if (myString.length == 0)
    {
    $('#result-body{{ $match->id }}').css('display', 'none');
    $('#result-body_2{{ $match->id }}').css('display', 'inline-block');
    $('#outcome_field{{ $match->id }}').val(null);
    }
    else{
    $('#result-body{{ $match->id }}').css('display', 'inline-block');
    $('#result-body_2{{ $match->id }}').css('display', 'none');
    }
    });
    </script>

    <!-- Change Results modal -->

    <button type="button" class="btn btn-xs btn-danger" id="button{{ $match->slug }}" data-toggle="modal"
        data-target=".changes{{ $match->slug }}" style="display: none"><i class="fa fa-trash"></i></button>
    <div class="modal fade bs-example-modal-sm changes{{ $match->slug }}" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('match.results', ['slug' => $match->slug]) }}" method="post"
                    id="result-form{{ $match->id }}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Save Changes</h4>
                    </div>
                    <div class="modal-body" id="result-body{{ $match->id }}">
                        <h4 id="outcome{{ $match->id }}"></h4>
                        <p>Was the outcome as predicted?</p>
                        <input type="radio" name="won" value="true" {{ $match->won? 'checked': '' }} required>
                        {{ Form::label('won', 'Yes') }}
                        <input type="radio" name="won" value="false" {{ !$match->won? 'checked': '' }} required>
                        {{ Form::label('won', 'Nope') }}
                    </div>
                    <div class="modal-body" id="result-body_2{{ $match->id }}" style="display:none">
                        <h4>{{ $match->home }} vs {{ $match->away }}</h4>
                        <p>You have removed the match results. This match will be marked as pending. <br>Are you sure
                            want to perform this task?</p>
                    </div>
                    <input type="text" name="outcome" id="outcome_field{{ $match->id }}" style="display:none">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-default" id="cancel{{ $match->id }}"
                            data-dismiss="modal">Cancel</button>
                        <button class="btn btn-xs save-result btn-success" type="submit"
                            id="save-result{{ $match->id }}">Save</button>

                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>

    {{-- submit ajax form --}}
    <script type="text/javascript">
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $("#save-result{{ $match->id }}").click(function(e){
            e.preventDefault();
            var result_form = $('#result-form{{ $match->id }}');
            won = $('input[name=won]:checked', result_form).val();
            outcome = $('input[name=outcome]', result_form).val();
            _token = $('input[name=_token]', result_form).val();
            $(this).removeClass('btn-success');
            $(this).addClass('btn-default disabled');
            $(this).text('Saving...');
            $.ajax({
                type:'POST',
                url:'{{ route('match.results', ['slug' => $match->slug]) }}',
                data:{won:won, outcome:outcome, _token:_token},
                success:function(data){
                    $('.changes{{ $match->slug }}').modal('toggle');
                    toastr.success(data.success, "Success Here!");
                    if(data.won == true){
                        var color = 'green';
                        $('#won_edit{{ $match->id }}').prop("checked", true);
                    }
                    
                    else if(data.won == false){
                        var color = 'red';
                        $('#lost_edit{{ $match->id }}').prop("checked", true);
                    }
                    else{
                        var color = 'black';
                        $('#won_edit{{ $match->id }}').prop("checked", false);
                        $('#lost_edit{{ $match->id }}').prop("checked", false);
                    }
                        
                    
                    $('#contenteditable{{ $match->id }}').css('color', color);
                    $('#outcome_edit{{ $match->id }}').prop("value", data.outcome);

                    $("#save-result{{ $match->id }}").addClass('btn-success');
                    $("#save-result{{ $match->id }}").removeClass('btn-default disabled');
                    $("#save-result{{ $match->id }}").text('Save');
                },
                // fail:function($error){
                //     $("#save-result{{ $match->id }}").addClass('btn-success');
                //     $("#save-result{{ $match->id }}").removeClass('btn-default disabled');
                //     $("#save-result{{ $match->id }}").text('Save');
                // }
                error: function(){
                    $('.changes{{ $match->slug }}').modal('toggle');
                    toastr.error('Could not save changes.', "Task Failed!");
                    $("#save-result{{ $match->id }}").addClass('btn-success');
                    $("#save-result{{ $match->id }}").removeClass('btn-default disabled');
                    $("#save-result{{ $match->id }}").text('Save');
                }
            });
        });

    </script>
    @endif
    @endforeach
    <script>
        $(document).ready(function() {
                $('#datatable').DataTable( {
                    "order": [[ 1, "desc" ]]
                } );
            } );
    </script>
    @endsection