<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Report",
 *     description="Report model",
 *     @OA\Xml(
 *         name="Report"
 *     )
 * )
 */
class Report extends Model
{
    use HasFactory,
        HasUser;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
     private int $id;
    protected   $fillable = [
        'user_id',
        'report_reason_id',
        'reportable_id',
        'reportable_type',
        'message',
    ];
    
    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }
}
