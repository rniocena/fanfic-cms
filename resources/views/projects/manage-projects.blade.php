@extends('includes.layout')

@section('content')

<div id="wrapper">
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Manage Projects
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="pull-right">
                        <button class="btn btn-primary">
                            Generate a Quote
                        </button>
                        <a href="{{action('ProjectsController@anyAddNewProject')}}" class="btn btn-primary">
                            Add New Project
                        </a>
                    </div>
                </div>

                <div class="clearfix" style="padding-bottom: 15px"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">

                    @if(count($success_msg) > 0)
                        @foreach($success_msg as $success)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{$success}}</strong>
                            </div>
                        @endforeach
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Projects
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"
                                        style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Project Name</th>
                                        <th>Contact Person</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Sales Rep</th>
                                        <th>Due Date</th>
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{$project->id}}</td>
                                            <td>{{$project->project_name}}</td>
                                            <td>
                                                {{$project->contact_name}}
                                                <br>
                                                <small>
                                                    {{$project->contact_number}}
                                                </small>
                                            </td>
                                            <td>{{$project->location}}</td>
                                            <td>{{$project->status->human_name}}</td>
                                            <td>{{$project->price}}</td>
                                            <td>{{$project->user->name}}</td>
                                            <td>{{$project->due_date}}</td>
                                            <td>
                                                <a href="{{action('ProjectsController@getProjectDetails', $project->uuid)}}">
                                                    View Details
                                                </a>
                                                <br>
                                                <a href="">Generate Quote</a>
                                                <br>
                                                <a href="{{action('ProjectsController@anyEdit', $project->uuid)}}">
                                                    Edit
                                                </a>
                                                <br>
                                                <a href="">Remove</a>
                                                <br>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop