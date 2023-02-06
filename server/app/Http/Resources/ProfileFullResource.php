<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'login' => $this->login,
          'firstname' => $this->firstname,
          'lastname' => $this->lastname,
          'fullname' => $this->fullname,
          'phone' => $this->phone,
          'photo' => $this->photo? url($this->photo): null,
          'email' => $this->email,
          'communication' => $this->extras['communication'] ?? null,
          'communication_number' => $this->extras['communication_number'] ?? null,
          'referrer_id' => $this->referrer_id,
          'referrer_code' => $this->referrer_code,
          'addresses' => $this->addresses,
          'extras' => $this->extras,
          'balance' => $this->balanceData,
          'created_at' => $this->created_at->format('d.m.Y'),
        ];
    }
}
