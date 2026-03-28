<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use FilamentTiptapEditor\TiptapEditor;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Konten Blog')->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                        $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('excerpt')->rows(2),
                TiptapEditor::make('content')->required()->columnSpanFull(),
                Forms\Components\FileUpload::make('thumbnail')->image()->directory('blogs'),
            ])->columns(2),

            Forms\Components\Section::make('Kategori & Tag')->schema([
                Forms\Components\TextInput::make('category'),
                Forms\Components\TagsInput::make('tags'),
            ])->columns(2),

            Forms\Components\Section::make('SEO')->schema([
                Forms\Components\TextInput::make('seo_title'),
                Forms\Components\Textarea::make('seo_description')->rows(2),
            ])->columns(2),

            Forms\Components\Section::make('Publish')->schema([
                Forms\Components\Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'scheduled' => 'Scheduled'])
                    ->default('draft')->required(),
                Forms\Components\DateTimePicker::make('published_at'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('thumbnail'),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category')->badge(),
            Tables\Columns\TextColumn::make('status')->badge()
                ->color(fn ($state) => match($state) {
                    'published' => 'success',
                    'draft' => 'gray',
                    'scheduled' => 'warning',
                }),
            Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options(['draft' => 'Draft', 'published' => 'Published', 'scheduled' => 'Scheduled']),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}