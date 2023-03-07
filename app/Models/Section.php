<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasAdvancedFilter;

    public const HOME_PAGE = 1;

    public const ABOUT_PAGE = 2;

    public const BRAND_PAGE = 3;

    public const BLOG_PAGE = 4;

    public const CATALOG_PAGE = 5;

    public const BRANDS_PAGE = 6;

    public const CONTACT_PAGE = 7;

    public const PRODUCT_PAGE = 8;

    public const PRIVACY_PAGE = 9;

    public $table = 'sections';

    public $orderable = [
        'id',
        'title',
        'image',
        'featured_title',
        'subtitle',
        'label',
        'link',
        'description',
        'status',
        'bg_color',
        'text_color',
        'position',
        'is_category',
        'is_product',
        'is_form',
        'page',
        'embeded_video',
        'language_id' ,
    ];

    public $filterable = [
        'id',
       'title',
        'image',
        'featured_title',
        'subtitle',
        'label',
        'link',
        'description',
        'status',
        'bg_color',
        'text_color',
        'position',
        'is_category',
        'is_product',
        'is_form',
        'page',
        'embeded_video',
        'language_id' ,
    ];

    protected $fillable = [
        'language_id',
        'title',
        'image',
        'featured_title',
        'subtitle',
        'label',
        'link',
        'description',
        'status',
        'bg_color',
        'text_color',
        'position',
        'is_category',
        'is_product',
        'is_form',
        'page',
        'embeded_video',
        'language_id' ,
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
    
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
