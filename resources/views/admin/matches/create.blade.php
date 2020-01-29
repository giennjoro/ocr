@extends('admin.layouts.app')
@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3><i class="fa fa-soccer-ball-o"></i><i class="fa fa-plus"></i> Add Match</h3>
    </div>

  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <form action="{{ route('matches.store') }}" id="demo-form2" data-parsley-validate
        class="form-horizontal form-label-left" method="post">
        @csrf
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
                      class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-12" for="home">Home Team <span class="required">*</span>
                  </label>
                  <div class=" col-xs-12">
                    <input type="text" id="home" name="home" required="required"
                      class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-12" for="away">Away Team <span class="required">*</span>
                  </label>
                  <div class=" col-xs-12">
                    <input type="text" id="away" name="away" required="required"
                      class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                  <label class="col-xs-12" for="tip">Tip <span class="required">*</span>
                  </label>
                  <div class=" col-xs-12">
                    <input type="text" id="tip" name="tip" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-12" for="time">Date & Time<span class="required">*</span>
                  </label>
                  <div class=" col-xs-12">
                    <div class='input-group date' id='datetimepicker7'>
                      <input type='text' id="time" name="time" required="required"
                        class="form-control col-md-7 col-xs-12" placeholder="mm/dd/yyyy hh:mm AM"/>
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  $(function () {
                      // $('#datetimepicker6').datetimepicker();
                      $('#datetimepicker7').datetimepicker({
                          useCurrent: false, //Important! See issue #1075
                          // format: 'dd/M/Y h:m:s Z'
                      });
                  });
                </script>
                <div class="form-group">
                  <label class="col-xs-12" for="odd">Odd<span class="required">*</span>
                  </label>
                  <div class=" col-xs-12">
                    <input type="text" id="odd" name="odd" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12">
                  <div class="form-group text-center">
                      <input type="radio" name="pro" value="true" required>
                      {{ Form::label('pro', 'Mark as a Pro Tip') }}
                      <input type="radio" name="pro" value="false" style="margin-left: 10%;" required>
                      {{ Form::label('pro', 'Mark as a Free Tip') }}
                  </div>
                  <p></p>
              </div>
              .
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class=" col-xs-12 col-md-offset-0">
                  <button class="btn btn-primary" type="reset"><i class="fa fa-undo"></i> Reset</button>
                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add match</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection