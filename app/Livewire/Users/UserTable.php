<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserTable extends Component
{
    use WithPagination;

    public $search = ''; // Búsqueda general
    public $perPage = 10; // Número de usuarios por página

    public $showCreateModal = false; // Modal para crear usuario
    public $showEditModal = false; // Modal para editar usuario
    public $showViewModal = false; // Modal para ver usuario
    public $userId = null; // ID del usuario a editar/ver

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function openEditModal($userId)
    {
        $this->userId = $userId;
        $this->showEditModal = true;
    }

    public function openViewModal($userId)
    {
        $this->userId = $userId;
        $this->showViewModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showViewModal = false;
        $this->userId = null;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('dni', 'like', '%' . $this->search . '%')
                      ->orWhere('cargo', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        return view('livewire.users.user-table', [
            'users' => $users,
        ])->layout('layouts.app');
    }
}