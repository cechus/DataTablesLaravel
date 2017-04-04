<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Yajra\Datatables\Datatables;

class TaskController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    /**
     * @return mixed
     */
    public function getTasks()
    {
        $tasks = Task::select(['id','name','category','state']); //atributos de la tabla

        return Datatables::of($tasks)
        	->addColumn('action', function ($task)
        	{	

        		return view('datatables.button', ['st'=>$task->state])->render();
        	})
        	->make(true);
    }

}
