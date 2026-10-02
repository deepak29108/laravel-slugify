<?php

namespace Deepphp\Slugify\Service;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class UniqueSlug
{
    private Model $model;

    private string $columnName;

    private ?string $slug;

    public function __construct(Model $model, string $column_name = 'slug', ?string $slug = null)
    {
        $this->model = $model;
        $this->columnName = $column_name;
        $this->slug = $slug;
    }

    public function slugExists(string $slug): bool
    {
        $query = $this->model->newQuery();

        if (method_exists($this->model, 'trashed')) {
            $query->withTrashed();
        }

        return $query->where($this->columnName, $slug)->exists();
    }

    public function generateUniqueSlug(): string
    {
        if ($this->slug === null || $this->slug === '') {
            throw new InvalidArgumentException('A base slug is required to generate a unique slug.');
        }

        $baseSlug = $this->slug;
        $slug = $baseSlug;
        $suffix = 1;
        while ($this->slugExists($slug)) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }
}