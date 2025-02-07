<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserForm extends Component
{
    public $user_id, $name, $email, $dni, $cargo, $role, $is_active = true;
    public $password, $password_confirmation;
    public $modalVisible = false;

    public $isEditing;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user_id),
            ],
            'dni' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users')->ignore($this->user_id),
            ],
            'cargo' => 'nullable|string|max:100',
            'role' => 'required|string|in:admin,user',
            'is_active' => 'boolean',
            'password' => $this->user_id ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
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

    protected $listeners = ['edit' => 'loadUser', 'showModal' => 'showModal', 'refreshTable' => '$refresh'];

    public function loadUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            session()->flash('error', 'El usuario no existe.');
            return;
        }

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->dni = $user->dni;
        $this->cargo = $user->cargo;
        $this->role = $user->role;
        $this->is_active = $user->is_active;
        
        $this->modalVisible = true;
    }

    public function showModal()
    {
        $this->reset(['user_id', 'name', 'email', 'dni', 'cargo', 'role', 'password', 'password_confirmation']);
        $this->resetValidation();
        $this->modalVisible = true;
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

        User::updateOrCreate(['id' => $this->user_id], $data);
        
        session()->flash('message', $this->user_id ? 'Usuario actualizado.' : 'Usuario creado.');
        
        $this->modalVisible = false;
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
}
