# Deepphp Slugify

Slug generation and uniqueness helpers for Laravel applications.

## Requirements

- PHP 8.3 or later
- Laravel 13 or compatible `illuminate/database` and `illuminate/support` components

## Installation

Install the package with Composer:

```sh
composer require deepphp/slugify
```

Laravel discovers the service provider automatically. No manual provider registration is required.

## Usage

Generate a slug with the `Slugify` facade:

```php
use Deepphp\Slugify\Slugify;

$slug = Slugify::slug('A New Blog Post');
// a-new-blog-post
```

Pass a custom separator as the second argument:

```php
$slug = Slugify::slug('A New Blog Post', '_');
// a_new_blog_post
```

## Checking and Generating Unique Slugs

Pass an Eloquent model instance and the candidate slug to check whether the slug is already used:

```php
use Deepphp\Slugify\Slugify;
use App\Models\Post;

$post = new Post();
$slug = Slugify::slug('A New Blog Post');

if (Slugify::slugExists($post, $slug)) {
    // The slug is already in use.
}
```

Generate an available slug by appending `-1`, `-2`, and so on when needed:

```php
$slug = Slugify::generateUniqueSlug($post, $slug);
$post->slug = $slug;
$post->save();
```

Both methods accept an optional third argument to use a different database column:

```php
$slug = Slugify::generateUniqueSlug($post, $slug, 'permalink');
```

For models using Laravel's `SoftDeletes` trait, soft-deleted records are also considered when checking whether a slug exists.

For applications that may generate the same slug concurrently, add a unique index to the slug column and handle database uniqueness violations. A check followed by an insert alone cannot guarantee uniqueness under concurrent requests.
