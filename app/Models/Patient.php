<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Patient
 *
 * @property int                                                              $id
 * @property string                                                           $first_name
 * @property string                                                           $last_name
 * @property string|null                                                      $known_as
 * @property string                                                           $title
 * @property string|null                                                      $birthday
 * @property string                                                           $gender
 * @property \Illuminate\Support\Carbon|null                                  $created_at
 * @property \Illuminate\Support\Carbon|null                                  $updated_at
 * @property \Illuminate\Support\Carbon|null                                  $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null                                                    $notes_count
 * @method static \Database\Factories\PatientFactory factory(...$parameters)
 * @method static Builder|Patient filter(?array $filters = null)
 * @method static Builder|Patient newModelQuery()
 * @method static Builder|Patient newQuery()
 * @method static \Illuminate\Database\Query\Builder|Patient onlyTrashed()
 * @method static Builder|Patient orderByName()
 * @method static Builder|Patient query()
 * @method static Builder|Patient whereBirthday($value)
 * @method static Builder|Patient whereCreatedAt($value)
 * @method static Builder|Patient whereDeletedAt($value)
 * @method static Builder|Patient whereFirstName($value)
 * @method static Builder|Patient whereGender($value)
 * @method static Builder|Patient whereId($value)
 * @method static Builder|Patient whereKnownAs($value)
 * @method static Builder|Patient whereLastName($value)
 * @method static Builder|Patient whereTitle($value)
 * @method static Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Patient withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Patient withoutTrashed()
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * Use timestamps on this database.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Carbon\Date fields.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'known_as',
        'last_name',
        'title',
    ];

    /**
     * Resolve the route binding to the id
     *
     * @param mixed $value
     * @param null  $field
     *
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    /**
     * 1-to-many relationshi each Patient has many notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class)->orderBy('created_at', 'desc');
    }

    /**
     * Filter to order by last_name and first_name
     *
     * @param $query
     */
    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    /**
     * I put this in here as an example of a search filter should I have time to implement searching in the alotted time
     * Filter by Search.
     *
     * @param Builder    $query
     * @param array|null $filters
     *
     * @return Builder|\Illuminate\Support\Traits\Conditionable|mixed
     */
    public function scopeFilter(Builder $query, array $filters = null)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%${search}%")
                    ->orWhere('last_name', 'like', "%${search}%")
                    ->orWhere('known_as', 'like', "%${search}%");
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
