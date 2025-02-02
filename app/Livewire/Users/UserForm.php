<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserForm extends Component
{
    public $user;
    public $name;
    public $email;
    public $dni;
    public $cargo;
    public $role;
    public $is_active = true;
    public $password;
    public $password_confirmation;

    public $isEditing = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id ?? null),
            ],
            'dni' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users')->ignore($this->user->id ?? null),
            ],
            'cargo' => 'nullable|string|max:100',
            'role' => 'required|string|in:admin,user',
            'is_active' => 'boolean',
            'password' => $this->isEditing ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
        ];
    }

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.unique' => 'El correo electrónico ya está en uso.',
        'dni.required' => 'El DNI es obligatorio.',
        'dni.unique' => 'El DNI ya está en uso.',
        'role.required' => 'El rol es obligatorio.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
    ];

    public function mount($userId = null)
    {
        if ($userId) {
            $this->user = User::findOrFail($userId);
            $this->isEditing = true;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->dni = $this->user->dni;
            $this->cargo = $this->user->cargo;
            $this->role = $this->user->role;
            $this->is_active = $this->user->is_active;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'dni' => $this->dni,
            'cargo' => $this->cargo,
            'role' => $this->role,
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->isEditing) {
            $this->user->update($data);
            session()->flash('message', 'Usuario actualizado correctamente.');
        } else {
            User::create($data);
            session()->flash('message', 'Usuario creado correctamente.');
        }

        $this->dispatch('closeModal');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
    
}