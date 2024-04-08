<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();
        View::share('title', ucfirst($this->table));
    }

    public function index(Request $request)
    {
        /*$query = $this->model;
        if ($request->has('role')) {
            $query = $query->where('role', $request->role);
        }
        $query->with('company:id,name')->latest()->paginate();*/
        // khong can parameter $request neu dung cach nay
        /*  $users = $this->model
            ->when($request->has('role'), function ($q) {
                return $q->where('role', request('role'));
            })
            ->with('company:id,name')
            ->latest()
            ->paginate();*/
        /*$users = $this->model->clone()
            ->when($request->has('role'), function ($q) use ($request) {
                return $q->where('role', $request->role);
            })
            ->with('company:id,name')
            ->latest()
            ->paginate();*/
        $selectedRole = $request->get('role');
        $selectedCity = $request->get('city');
        $selectedCompany = $request->get('company');

        $query = $this->model->clone();
        if ($request->has('role') && $selectedRole !== 'All') {
            $query->where('role', $selectedRole);
        }
        if ($request->has('company') && $selectedCompany !== 'All') {
            $query->where('company_id', $selectedCompany);
        }
        if ($request->has('city')&& $selectedCity !== 'All') {
            $query->where('city', $selectedCity);
        }
        $users = $query->with('company:id,name')->latest()->paginate();

        $cities = $this->model->clone()
            ->where('city', '<>', '')
            ->distinct()
            ->pluck('city');
        $companies = Company::query()->pluck('name', 'id',);
        $roles = UserRoleEnum::asArray();
        return view("admin.$this->table.index", [
            'users' => $users,
            'roles' => $roles,
            'companies' => $companies,
            'cities' => $cities,
            'selectedRole' => $selectedRole,
            'selectedCity' => $selectedCity,
            'selectedCompany' => $selectedCompany,
        ]);
    }

    public function show()
    {

    }

    public function destroy($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        $user->delete();
        return redirect()->back();
    }

}
