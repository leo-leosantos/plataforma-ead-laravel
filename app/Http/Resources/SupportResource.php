<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\LessonResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
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
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status] ?? 'Not Found Status',
            'description' => $this->description,
            'user'=> new  UserResource($this->user),
            'lesson'=> new  LessonResource($this->lesson),
            'replies'=> LessonResource::collection($this->replies),
            'date_updated'=> Carbon::make($this->updated_at)->format('Y-m-d H:i:s'),

        ];
      }
}
