<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="Post",
 *   type="object",
 *   required={"id", "user_id", "title", "content"},
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="user_id", type="integer", example=1),
 *   @OA\Property(property="title", type="string", example="Meu post"),
 *   @OA\Property(property="content", type="string", example="Conteúdo do post"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-06-14T12:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-06-14T12:00:00Z")
 * )
 */
class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];
}
