@extends('admin.layouts.app')
@section('content')
<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3><i class="fa fa-user-plus"></i> Add an Plan</h3>
          </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Fill Plan Details <small>Fields with asterik(*) are madatory</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form action="{{ route('plans.store') }}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                    @csrf
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12"  placeholder="eg. 1 Week Plan" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lifespan">No of days<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="lifespan" name="lifespan" required="required" class="form-control col-md-7 col-xs-12" placeholder="eg. 1, 7, 30">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="charges" required>Charges<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="charges" name="charges" class="form-control col-md-7 col-xs-12" placeholder="eg. 500" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offer">Offer(Max: 10 characters)</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="offer" name="offer" class="form-control col-md-7 col-xs-12" placeholder="eg. 30% off" maxlength="10">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="description" name="description" class="form-control col-md-7 col-xs-12" placeholder="eg. Daily, Weekly, Monthly" >
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success">Add Plan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection