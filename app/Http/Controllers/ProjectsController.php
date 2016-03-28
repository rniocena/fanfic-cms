<?php namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Project;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Webpatser\Uuid\Uuid;

class ProjectsController extends Controller {

    protected $roles = null;
    protected $super_admin = false;

    public function __construct()
    {
        // Require that the user is a guest (logged out)
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);

        // Require that the user is logged in
        $this->middleware('auth', ['only' => ['getLogout', 'getProfile']]);

        if(User::get()) {

//            $this->roles = User::get()->checkRole(Seller::get()->id, User::get()->id);

            $this->super_admin = User::get()->isSuperAdmin(User::$user->id);
        }

//        View::share('user_roles', $this->roles);

        View::share('super_admin', $this->super_admin);
    }

    public function getProjects($success_msg = null)
    {
        $projects = Project::all();

        return View::make('projects.manage-projects', [
            'success_msg' => $success_msg,
            'projects' => $projects,
        ]);
    }

    public function anyAddNewProject()
    {
        $project_status = Status::all();
        $success_msg = [];

        if(Request::method() === 'POST') {
            $rules = [
                'project_name' => 'required',
                'contact_name' => 'required',
                'status_id' => 'required',
            ];

            $validator = Validator::make(Input::all(), $rules);

            if(!$validator->fails()) {
                $project = new Project(Input::all());

                $project->uuid = Uuid::generate()->string;
                $project->user_id = 1;
                $project->save();

                if($project) {
                    $success_msg[] = 'Great! ' . $project->project_name . ' was created successfully.';
                } else {
                    $error_msg[] = 'Whoops! There was an error while processing your request. Please try again.';
                }

                return View::make('projects.manage-projects', [
                    'project' => null,
                    'success_msg' => $success_msg,
                ]);
            } else {
                return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
            }
        } else {
            return View::make('projects.new-project', [
                'project' => null,
                'project_status' => $project_status,
                'success_msg' => $success_msg,
            ]);
        }
    }

    public function anyEdit($uuid)
    {
        $success_msg = [];

        $project = Project::where('uuid', '=', $uuid)->first();

        $project_status = Status::all();

        if (Request::method() === 'POST') {
            $rules = [
                'project_name' => 'required',
                'contact_name' => 'required',
                'status_id' => 'required',
            ];

            $validator = Validator::make(Input::all(), $rules);

            if(!$validator->fails()) {
                $project->user_id = 1;
                $project->update(Input::all());
                $project->save();

                if($project) {
                    $success_msg[] = 'Great! ' . $project->project_name . ' was edited successfully.';
                } else {
                    $error_msg[] = 'Whoops! There was an error while processing your request. Please try again.';
                }

                return $this->getProjects($success_msg);
            } else {
                return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
            }
        } else {
            return View::make('projects.new-project', [
                'project' => $project,
                'project_status' => $project_status,
                'success_msg' => $success_msg
            ]);
        }
    }

    public function getProjectDetails($uuid)
    {
        $project = Project::where('uuid', '=', $uuid)->first();

        $inventory_items = Inventory::
            where('project_id', $project->id)
            ->get();

        return View::make('projects.project-details', [
            'project' => $project,
            'inventory_items' => $inventory_items,
        ]);
    }

    public function anyManageInventory($project_uuid, $inventory_uuid = null)
    {
        $project = Project::where('uuid', '=', $project_uuid)->first();

        $units = Unit::all();

        $selected_inventory = null;

        if(Request::method() === 'GET') {
            if($inventory_uuid) {
                $selected_inventory = Inventory::where('uuid', '=', $inventory_uuid)->first();
            }
        } elseif(Request::method() === 'POST') {
            if($inventory_uuid) {
                $inventory = Inventory::where('uuid', '=', $inventory_uuid)->first();
            } else {
                $inventory = new Inventory(Input::all());
            }

            $rules = [
                'item_name' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ];

            $validator = Validator::make(Input::all(), $rules);

            if(!$validator->fails()) {
                $inventory->uuid = Uuid::generate()->string;
                $inventory->user_id = 1;
                $inventory->project_id = $project->id;

                if ($inventory_uuid) {
                    $inventory->update(Input::all());
                    $success = 'Great! ' . $inventory->item_name . ' was edited successfully.';
                } else {
                    $success = 'Great! ' . $inventory->item_name . ' was added successfully.';
                }

                $inventory->save();

                if($inventory) {
                    $success_msg[] = $success;
                } else {
                    $error_msg[] = 'Whoops! There was an error while processing your request. Please try again.';
                }

                return Redirect::back();
            } else {
                return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
            }
        }

        return View::make('projects.add-inventory', [
            'project' => $project,
            'units' => $units,
            'inventory' => $selected_inventory,
        ]);
    }
}
