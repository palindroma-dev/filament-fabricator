<?php

namespace Z3d0X\FilamentFabricator\Resources\PageResource\Pages;

use Filament\Core\Actions\Forms\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Z3d0X\FilamentFabricator\Concerns\EnablesDataMutation;
use Z3d0X\FilamentFabricator\Resources\PageResource;
use Filament\Core\Concerns\CreateRecord\Translatable;

class CreatePage extends CreateRecord
{
  use Concerns\HasPreviewModal, Translatable, EnablesDataMutation;

  protected static string $resource = PageResource::class;

  public static function getResource(): string
  {
    return config('filament-fabricator.page-resource') ?? static::$resource;
  }

  protected function getActions(): array
  {
    return [
      LocaleSwitcher::make(),
      PreviewAction::make(),
    ];
  }
}
