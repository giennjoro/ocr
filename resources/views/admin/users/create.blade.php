@extends('admin.layouts.app')
@section('content')
<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3><i class="fa fa-user-plus"></i> Add an User</h3>
          </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Fill User Details <small>Fields with asterik(*) are madatory | Note that Password defaults to '@doublequick'</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form action="{{ route('users.store') }}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                    @csrf
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="phone" name="phone" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success">Add User</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
