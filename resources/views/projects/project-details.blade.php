@extends('includes.layout')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Manage {{$project->project_name}}
                        <span class="pull-right">
                            {{$project->status->human_name}}
                        </span>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="pull-right">
                        <button class="btn btn-primary">
                            Create a Quote
                        </button>
                    </div>
                    <div class="pull-left">
                        <h4>Project Location: <strong>{{$project->location}}</strong></h4>
                        <h4>Quoted Price: <strong>{{$project->price}}</strong></h4>
                        <h4>Sales Rep: <strong>{{$project->user->name}}</strong></h4>
                        <h4>Due Date: <strong>{{$project->user->due_date}}</strong></h4>
                        <h4>Updated on: <strong>{{$project->updated_at}}</strong></h4>
                    </div>
                </div>

                <div class="clearfix" style="padding-bottom: 15px"></div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#quote" data-toggle="tab">Quote Details</a>
                                </li>
                                <li class=""><a href="#inventory" data-toggle="tab">Inventory</a>
                                </li>
                                <li class=""><a href="#hours" data-toggle="tab">Hours Spent</a>
                                </li>
                                <li class=""><a href="#history" data-toggle="tab">History</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="quote">
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Created On</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>dfkmd</td>
                                                    <td>
                                                        <a href="">View</a>
                                                        <br>
                                                        <a href="">Edit</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="inventory">
                                    <br>
                                    <a data-href="{{action('ProjectsController@anyManageInventory', $project->uuid)}}"
                                       class="btn btn-info btn-sm pull-right manageInventory">
                                        <i class="fa fa-plus "></i> Add Item
                                    </a>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Individual Price</th>
                                                <th>Total Price</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($inventory_items as $item)
                                                <tr>
                                                    <td>{{$item->item_name}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td>${{$item->price}}</td>
                                                    <td>${{$item->quantity * $item->price}}</td>
                                                    <td>
                                                        <a data-href="{{action
                                                        ('ProjectsController@anyManageInventory', [
                                                            $project->uuid, $item->uuid
                                                        ])}}" class="manageInventory">
                                                            Edit
                                                        </a>
                                                        <br>
                                                        <a href="">Remove</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="hours">
                                    <br>
                                    <a href="#" class="btn btn-info btn-sm pull-right">
                                        <i class="fa fa-plus "></i> Log Hour Spent
                                    </a>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Staff Name</th>
                                                <th>Hours</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>20/03/2016</td>
                                                <td>Installation</td>
                                                <td>Felix Niocena</td>
                                                <td>2.5</td>
                                                <td>
                                                    <a href="">Edit</a>
                                                    <br>
                                                    <a href="">Remove</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="history">
                                    <br><br>
                                    <span>
                                        Felix Niocena confirmed on 21/03/2016
                                    </span>
                                    <br>
                                    <span>
                                        Felix Niocena created on 20/03/2016
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.modal_generic')

@stop