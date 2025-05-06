<?php

namespace App\Filament\Resources\HomepageSettingResource\Pages;

use App\Filament\Resources\HomepageSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Redirect;

class EditHomepageSetting extends EditRecord
{
    protected static string $resource = HomepageSettingResource::class;

    // Override afterSave untuk mengalihkan setelah data disimpan
    protected function afterSave()
    {
        // Redirect ke halaman index (tabel)
        $this->redirectRoute('filament.admin.resources.homepage-settings.index');

    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
