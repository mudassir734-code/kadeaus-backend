<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    private array $modules = ['Dashboard','Appointment','Chat','Hospital','Doctors','Patients','Admins','Setting'];

    public function index()
    {
        $users = User::with('roles')
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['Admin','Doctor','Nurse','Patient']);
            })
            ->latest()
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Only these roles for now
        $roles = Role::whereIn('name', ['Admin','Doctor','Nurse','Patient'])
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->pluck('name');

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => ['required','string','max:255'],
            'email'  => ['required','email','max:255','unique:users,email'],
            'phone'  => ['nullable','string','max:30'],
            'dob'    => ['nullable','date'],
            'gender' => ['nullable','in:Male,Female,Other'],
            'role'   => ['required','string','in:Admin,Doctor,Nurse,Patient'],
            'perm'   => ['array'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'dob'      => $data['dob'] ?? null,
            'gender'   => $data['gender'] ?? null,
            'password' => Hash::make(Str::random(12)),
        ]);

        // Ensure the role exists
        $role = Role::firstOrCreate([
            'name'       => $data['role'],
            'guard_name' => 'web',
        ]);

        // Assign role
        $user->syncRoles([$role]);

        // === ADMIN: always full access via role ===
        if ($data['role'] === 'Admin') {
            // Make sure Admin role truly has ALL *_FullAccess permissions
            $fullPerms = $this->ensureAllFullAccessExistAndReturnNames();
            $role->syncPermissions($fullPerms);
            // Clear any direct user permissions (not needed for Admin)
            $user->syncPermissions([]);
            return redirect()->route('admin.users')->with('success', 'Admin created with full access.');
        }

        // === NON-ADMIN: apply radios to user directly ===
        $selected = [];
        foreach ($this->modules as $module) {
            $level = $data['perm'][$module] ?? 'ViewOnly';
            $level = in_array($level, ['FullAccess','ViewOnly']) ? $level : 'ViewOnly';
            $selected[] = "{$module}_{$level}";
        }

        // Ensure all selected permissions exist in 'web' guard
        foreach ($selected as $name) {
            Permission::findOrCreate($name, 'web');
        }

        $user->syncPermissions($selected);

        return redirect()->route('admin.users')->with('success', "{$data['role']} created with selected permissions.");
    }

    public function view(Request $request)
    {
        $userId = $request->query('id');
        $user = User::with('roles', 'permissions')->findOrFail($userId);

        return view('admin.users.view', compact('user'));
    }

    /**
     * Ensure all *_FullAccess permissions exist and return their names.
     * This keeps Admin truly "full" even if seeder missed some.
     */
    private function ensureAllFullAccessExistAndReturnNames(): array
    {
        $names = [];
        foreach ($this->modules as $m) {
            $name = "{$m}_FullAccess";
            Permission::findOrCreate($name, 'web');
            $names[] = $name;
        }
        return $names;
    }

   
}
