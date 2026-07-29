<?php

namespace Z3d0X\FilamentFabricator\Forms\Components;

use Filament\Forms\Components\Builder;
use Z3d0X\FilamentFabricator\Enums\BlockPickerStyle;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;
use Z3d0X\FilamentFabricator\FilamentFabricatorPlugin;

class PageBuilder extends Builder
{
    /**
     * The view is Filament's own Builder view. This class used to override it
     * with a fork of Filament 3's markup, purely to offer a modal block picker
     * next to the dropdown one; that fork was built on v3 internals
     * (`mountFormComponentAction`, `x-filament::grid`) that no longer exist.
     * Filament's stock builder renders the dropdown picker natively, so
     * `BlockPickerStyle::Modal` now falls back to the dropdown.
     */
    protected BlockPickerStyle $blockPickerStyle = BlockPickerStyle::Dropdown;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blocks(FilamentFabricator::getPageBlocks());

        $this->mutateDehydratedStateUsing(static function (?array $state): array {
            if (! is_array($state)) {
                return array_values([]);
            }

            $registerPageBlockNames = array_keys(FilamentFabricator::getPageBlocksRaw());

            return collect($state)
                ->filter(fn (array $block) => in_array($block['type'], $registerPageBlockNames, true))
                ->values()
                ->toArray();
        });

        $blockPickerStyle = FilamentFabricatorPlugin::get()->getBlockPickerStyle();

        if (! is_null($blockPickerStyle)) {
            $this->blockPickerStyle($blockPickerStyle);
        }
    }

    public function blockPickerStyle(BlockPickerStyle $style): static
    {
        if ($style === BlockPickerStyle::Modal) {
            $this->blockPickerColumns(3);
        }

        $this->blockPickerStyle = $style;

        return $this;
    }

    public function getBlockPickerStyle(): BlockPickerStyle
    {
        return $this->blockPickerStyle;
    }
}
