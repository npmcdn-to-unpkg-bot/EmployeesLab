<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return  Employee::paginate();
    }
}
