<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;


class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel';
    
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Artikel')
                ->schema([
                    TextInput::make('title')
                        ->label('Judul Artikel') 
                        ->live(debounce: 500)
                        ->afterStateUpdated(function ($state, callable $set)
                        {
                            $set('slug', Str::slug($state));
                        }),
                    TextInput::make('excerpt')
                        ->label('Deskripsi singkat (Opsional)') ,
                    FileUpload::make('thumbnail')
                        ->image()
                        ->disk('public') // pastikan ini eksplisit
                        ->directory('articles-image')
                        ->avatar()
                        ->imagePreviewHeight('400'),  // Menampilkan preview gambar
                    DatePicker::make('created_at'),
                    RichEditor::make('body')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('article-content-image')
                        ->fileAttachmentsVisibility('public')
                        ->label('Isi Konten') 
                        ->columnSpanFull()
                        ->getStateUsing(fn ($record) => $record),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('published_at')->date('d M Y'),
                TextColumn::make('created_at')->date('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
