<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class UsersExport implements FromView
{
    use Exportable;

    public function __construct($roles=null)
    {
        $this->roles = $roles;
    }

    public function view() :View
    {
        $query = User::query();
        if (empty($this->roles)) {
            $query->select(['id','name','email','roles','total_transaksi'])->orderBy('total_transaksi','desc');
            $user = $query->get();
            return view("exports.user",compact("user"));
        }
        
        $query->when($this->roles,function($q,$roles)
        {
            return $q->where("roles",strtoupper($roles));
        });

        $query->select(['id','name','email','roles','total_transaksi'])->orderBy('total_transaksi','desc');
        $user = $query->get();
        return view("exports.user",compact("user"));
    }
}
