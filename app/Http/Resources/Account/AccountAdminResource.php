<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountAdminResource extends JsonResource
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
            "email"=> $this->email,
            "email_verified_at" => $this->email_verified_at,
            "username" => $this->username,
            "nama_lengkap" => $this->nama_lengkap,
            "no_handphone" => $this->no_handphone,
            "gender" => $this->gender,
            "alamat_lengkap" => $this-> alamat_lengkap,
            "NIK" => $this->NIK,
            "status" => $this->status,
            "role" => $this->role->nama,
            "login_terakhir" => $this->login_terakhir,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
