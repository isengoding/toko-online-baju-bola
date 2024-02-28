<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'brand_id',
        'team_id',
        'price',
        'type',
        'description',
        'size_guide',
        'image'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('sku', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhereHas('brand', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('team', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });

    }

    /**
     * Get the brand that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the team that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get all of the stocks for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    protected function imageBase64(): Attribute
    {
        $imagePath = public_path('storage/' . $this->image);
        return Attribute::make(
            get: fn() => base64_encode(file_get_contents($imagePath)),
        );
    }

    /**
     * Get the base64 encoded image.
     *
     * @return string
     */
    public function getImageBaseAttribute(): string
    {
        // $imagePath = storage_path('app/public/' . $this->image);
        $imagePath = public_path('storage/' . $this->image);
        return base64_encode(file_get_contents($imagePath));
    }


}
