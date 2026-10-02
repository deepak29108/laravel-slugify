<?php

namespace Deepphp\Slugify\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugifyService
{
    public function slug(string $value, string $separator = '-'): string
    {
        return Str::slug($value, $separator);
    }

    public function slugExists(Model $model, string $slug, string $columnName = 'slug'): bool
    {
        return (new UniqueSlug($model, $columnName))->slugExists($slug);
    }

    public function generateUniqueSlug(Model $model, string $slug, string $columnName = 'slug'): string
    {
        return (new UniqueSlug($model, $columnName, $slug))->generateUniqueSlug();
    }
}