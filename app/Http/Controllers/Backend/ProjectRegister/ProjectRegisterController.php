<?php

namespace App\Http\Controllers\Backend\ProjectRegister;

use App\Models\EventRegister;
use App\Models\News;
use App\Models\Project;
use App\Models\ProjectRegister;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectRegisterController extends Controller
{
    //
    public function getAll()
    {
        try {
            $projects = Project::with('project_register')->where('is_sale', 1)->orderByDesc('updated_at')
                ->get();
            return view('backend.project_register.index', [
                'project' => $projects
            ]);
        } catch (\Exception $e) {
            dd($e);
            return redirect('error');
        }
    }

    public function getClient($id)
    {
        try {
            $projects = Project::find($id);
            $clients = ProjectRegister::where('project_id', $id)->orderByDesc('updated_at')
                ->get();
            return view('backend.project_register.list_client', [
                'project' => $projects,
                'clients' => $clients
            ]);
        } catch (\Exception $e) {
            dd($e);
            return redirect('error');
        }
    }
}
