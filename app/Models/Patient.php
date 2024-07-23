<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birthDate',
        'group_id',
        'consultation_date',
        'active',
    ];
    public $timestamps =false;

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @param $groupId
     * @param string|null $dateRange
     * @return Collection
     */
    public function getFilterPatients($groupId=null, string $dateRange=null): Collection
    {
        $query =  self::query();
        if($groupId){
            $query->whereHas('group', function($q) use ($groupId) {
                $q->where('category', $groupId);
            });
        }
        if($dateRange){
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $query->whereBetween('consultation_date', [$startDate, $endDate]);
        }
        return $query->get();
    }
}
