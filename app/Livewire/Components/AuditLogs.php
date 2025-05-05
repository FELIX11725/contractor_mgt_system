<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use App\Models\Auditlog;
use Livewire\WithPagination;
use App\Exports\AuditLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class AuditLogs extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $search = '';
    public $actionFilter = '';
    public $userFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    public function render()
    {
        $logs = AuditLog::with('user')
        ->when($this->search, function ($query) {
            $query->where('description', 'like', '%'.$this->search.'%')
                ->orWhere('action', 'like', '%'.$this->search.'%');
        })
        ->when($this->actionFilter, function ($query) {
            $query->where('action', $this->actionFilter);
        })
        ->when($this->userFilter, function ($query) {
            $query->where('user_id', $this->userFilter);
        })
        ->when($this->dateFrom, function ($query) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        })
        ->when($this->dateTo, function ($query) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.components.audit-logs',[
            'logs' => $logs,
            'actions' => Auditlog::distinct('action')->pluck('action'),
            'users' => User::whereHas('auditLogs')->get(),
        ]);
    }

    public function export(array $filters = [])
    {
        $query = AuditLog::query()
            ->with('user')
            ->latest();

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('description', 'like', '%'.$filters['search'].'%')
                  ->orWhere('action', 'like', '%'.$filters['search'].'%')
                  ->orWhereHas('user', function($q) use ($filters) {
                      $q->where('name', 'like', '%'.$filters['search'].'%');
                  });
            });
        }

        if (!empty($filters['actionFilter'])) {
            $query->where('action', $filters['actionFilter']);
        }

        if (!empty($filters['userFilter'])) {
            $query->where('user_id', $filters['userFilter']);
        }

        if (!empty($filters['dateFrom'])) {
            $query->whereDate('created_at', '>=', $filters['dateFrom']);
        }

        if (!empty($filters['dateTo'])) {
            $query->whereDate('created_at', '<=', $filters['dateTo']);
        }

        return Excel::download(new AuditLogsExport($query), 'audit-logs-'.now()->format('Y-m-d').'.xlsx');
    }
}
