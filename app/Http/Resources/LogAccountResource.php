<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'ip_address' => $this->ip_address,
            'aktifitas' => $this->aktifitas,
            'status' => $this->status,
            'browser' => $this->browser,
            'os' => $this->os,
            'device' => $this->device,
            'tanggal' => $this->tanggal,
        ];
    }
}
