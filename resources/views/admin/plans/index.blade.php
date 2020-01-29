@extends('admin.layouts.app')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Plans <small>Subscription plans</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">


            <!-- price element -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="pricing ui-ribbon-container">
                    <div class="ui-ribbon-wrapper">
                        <div class="ui-ribbon">
                            Free
                        </div>
                    </div>
                    <div class="title">
                        <h2>Free Subscription</h2>
                        <h1>KES 0.00</h1>
                        <span>Free</span>
                    </div>
                    <div class="x_content">
                        <div class="">
                            <div class="pricing_features">
                                <ul class="list-unstyled text-left">
                                    <li><i class="fa fa-times text-danger"></i> <strong>No Access</strong> to All Our
                                        VIP Prediction
                                        tips</li>
                                    <li><i class="fa fa-check text-success"></i> Eligibility to Free Winning Tips</li>
                                    <li><i class="fa fa-check text-success"></i> 2+ & 3+ MAX Stake Genius Tips</strong>
                                    </li>
                                    <li><i class="fa fa-check text-success"></i> <strong>24/7 Support Services</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="pricing_footer">
                            <a href="javascript:void(0);" class="btn btn-primary btn-block" role="button">Not
                                <span> editable!</span></a>
                            <p>
                                <a href="javascript:void(0);">Not deletable</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- price element -->

            @foreach ($plans as $plan)
            <!-- price element -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="pricing ui-ribbon-container">
                    @if ($plan->offer != null)
                    <div class="ui-ribbon-wrapper">
                        <div class="ui-ribbon">
                            {{ $plan->offer }}
                        </div>
                    </div>
                    @endif

                    <div class="title">
                        <h2>{{ $plan->title }}</h2>
                        <h1>KES {{ $plan->charges }}</h1>
                        <span>{{ $plan->description == ''? 'plan': $plan->description }}</span>
                    </div>
                    <div class="x_content">
                        <div class="">
                            <div class="pricing_features">
                                <ul class="list-unstyled text-left">
                                    <li><i class="fa fa-check text-success"></i> Full Access to All Our Prediction
                                        Categories
                                        for<strong> {{ $plan->lifespan }} days</strong></li>
                                    <li><i class="fa fa-check text-success"></i> Eligibility to Free Winning Tips</li>
                                    <li><i class="fa fa-check text-success"></i> 2+ & 3+ MAX Stake Genius Tips</strong>
                                    </li>
                                    <li><i class="fa fa-check text-success"></i> <strong>24/7 Support Services</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="pricing_footer">

                            <a href="javascript:void(0);" class="btn btn-primary btn-block" role="button"
                                data-toggle="modal" data-target=".edit{{ $plan->id }}">Edit
                                <span> now!</span></a>
                            <p>
                                <a href="javascript:void(0);" data-toggle="modal"
                                    data-target=".delete{{ $plan->id }}"><i class="fa fa-trash" style="color: red"></i>
                                    Delete</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- price element -->

            {{-- Modals --}}
            {{-- Edit Modal --}}

            <div class="modal fade bs-example-modal-md edit{{ $plan->id }}" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel2">Edit Plan </h4>
                        </div>
                        <div class="modal-body">
                            <div class="x_cjontent">
                                <br />
                                {!! Form::open(['action' => ['PlanController@update', 'id' =>
                                $plan->id],
                                'method' => 'PUT', 'class' => 'form-horizontal form-label-left',
                                'data-parsley-validate', 'id' => 'demo-form2']) !!}

                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="title" name="title" required="required"
                                            class="form-control col-md-7 col-xs-12" placeholder="eg. 1 Week Plan"
                                            value="{{ $plan->title }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lifespan">No of
                                        days<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="lifespan" name="lifespan" required="required"
                                            class="form-control col-md-7 col-xs-12" placeholder="eg. 1, 7, 30"
                                            value="{{ $plan->lifespan }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="charges"
                                        required>Charges<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="charges" name="charges"
                                            class="form-control col-md-7 col-xs-12" placeholder="eg. 500"
                                            value="{{ $plan->charges }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offer">Offer(Max: 10
                                        characters)</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="offer" name="offer"
                                            class="form-control col-md-7 col-xs-12" placeholder="eg. 30% off"
                                            maxlength="10" value="{{ $plan->offer }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="description">Tag(Max: 10 characters)</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="description" name="description" maxlength="10" class="form-control col-md-7 col-xs-12"
                                            placeholder="eg. Daily, Weekly, Monthly" value="{{ $plan->description }}">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="button" class="btn btn-sm btn-default"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-sm btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Edit Modal --}}

            {{-- Delete Modal --}}
            <div class="modal fade bs-example-modal-sm delete{{ $plan->id }}" tabindex="-1"
                    role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel2">Remove Plan</h4>
                            </div>
                            <div class="modal-body">
                                <h4>Confirmation</h4>
                                <p>Are you sure you want to remove {{ $plan->title }}?</p>

                            </div>
                            {!! Form::open(['action' => ['PlanController@destroy', $plan->id], 'method' => 'DELETE']) !!}
                                @csrf
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-xs btn-default"
                                        data-dismiss="modal">Cancel</button>
                                    @csrf
                                    <button class="btn btn-xs btn-danger" type="submit">Remove</button>

                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            {{-- End Delete Modal --}}
            {{-- End Modals --}}

            @endforeach

        </div>
    </div>
</div>
@endsection