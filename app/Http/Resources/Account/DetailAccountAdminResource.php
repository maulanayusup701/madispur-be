<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailAccountAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nama_lengkap" => $this->nama_lengkap,
            "no_handphone" => $this->no_handphone,
            "role" => $this->role->nama,
            "status" => $this->status,
            "login_terakhir" => $this->login_terakhir,
            "email"=> $this->email,
            "username" => $this->username,
            "gender" => $this->gender,
            "alamat_lengkap" => $this-> alamat_lengkap,
        ];
    }
}
