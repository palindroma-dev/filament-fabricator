<?php

namespace Z3d0X\FilamentFabricator\Models\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int|string $id
 * @property-read string $title
 * @property-read string $slug
 * @property-read string $layout
 * @property-read array $blocks
 * @property-read int|string $parent_id
 * @property-read Collection|Page[] $children
 * @property-read Collection|Page[] $allChildren
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
interface Page
{
    public function parent(): BelongsTo;

    public function children(): HasMany;

    public function allChildren(): HasMany;

    /** @return Builder */
    public static function query();
}
