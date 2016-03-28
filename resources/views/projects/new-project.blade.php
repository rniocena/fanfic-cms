@extends('includes.layout')

@section('content')

    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            @if(! $project)
                                Add New Project
                            @else
                                Edit {{$project->project_name}}
                            @endif
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(!$project)
                            <form method="POST" action="{{action('ProjectsController@anyAddNewProject')}}">
                        @else
                            <form method="POST" action="{{action('ProjectsController@anyEdit', $project->uuid)}}">
                        @endif
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label" for="project-name">Project Name</label>
                                    <input type="text" class="form-control" id="project-name" name="project_name"
                                            value="{{$project ? $project->project_name : ''}}">
                                    @if($errors->first('project_name'))
                                        <span class="text-danger">{{$errors->first('project_name')}}</span>
                                    @endif
                                </div>

                                <div class="col-md-12" style="padding-bottom: 15px"></div>

                                <div class="col-md-12">
                                    <label class="control-label" for="location">Location</label>
                                    <br>
                                    <div class="textwrapper">
                                        <textarea cols="2" rows="5" id="location" name="location">
                                            {{$project ? nl2br($project->location) : ''}}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding-bottom: 15px"></div>

                                <div class="col-md-6">
                                    <label class="control-label" for="contact-person">Contact Person</label>
                                    <input type="text" class="form-control" id="contact-person" name="contact_name"
                                           value="{{$project ? $project->contact_name : ''}}">
                                    @if($errors->first('contact_name'))
                                        <span class="text-danger">{{$errors->first('contact_name')}}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label" for="contact-number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact-number" name="contact_number"
                                           value="{{$project ? $project->contact_number : ''}}">
                                </div>

                                <div class="col-md-12" style="padding-bottom: 15px"></div>

                                <div class="col-md-6">
                                    <label class="control-label" for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                           value="{{$project ? $project->price : ''}}">
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label" for="due-date">Due Date</label>
                                    <input type="text" class="form-control" id="due-date" name="due_date"
                                           value="{{$project ? $project->due_date : ''}}">
                                </div>

                                <div class="col-md-12" style="padding-bottom: 15px"></div>

                                <div class="col-md-12">
                                    <label class="control-label" for="status">Status</label>
                                    <select class="form-control" id="status" name="status_id">
                                        @foreach($project_status as $status)
                                            <option value="{{$status->id}}"
                                                    <? $project ? ($status->id === $project->status_id ? 'selected' :
                                                            '') : ''?>>
                                                {{$status->human_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('status_id'))
                                        <span class="text-danger">{{$errors->first('status_id')}}</span>
                                    @endif
                                </div>

                                <div class="col-md-12" style="padding-bottom: 15px"></div>

                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <a class="btn btn-link">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop