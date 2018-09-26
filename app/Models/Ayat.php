<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ayat extends Model
{


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends=['juz_name_en','juz_name_ar'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ayat';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['edition_id'];

    /**
     *  Surah relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surah()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('edition', function (Builder $builder) {
            $builder->where('edition_id', '=', 77);
        });
    }


    /**
     * @return string
     */
    public function getTextAttribute()
    {
        if ($this->attributes['numberinsurat'] != 1) {
            return $this->attributes['text'];
        }
        return str_replace_first("بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ", "", $this->attributes['text']);
    }

    /**
     * @return mixed
     */
    public function getJuzNameEnAttribute()
    {
        return juz_name($this->attributes['juz_id'], 'en');
    }


    /**
     * @return mixed
     */
    public function getJuzNameArAttribute()
    {
        return juz_name($this->attributes['juz_id'], 'ar');
    }

}
