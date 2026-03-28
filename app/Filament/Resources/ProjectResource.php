<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Client Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Info Project')->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()->required(),
                Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Status & Progress')->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'planning' => 'Planning',
                        'development' => 'Development',
                        'revision' => 'Revision',
                        'done' => 'Done',
                        'cancelled' => 'Cancelled',
                    ])->required(),
                Forms\Components\TextInput::make('progress')
                    ->numeric()->minValue(0)->maxValue(100)->suffix('%'),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('deadline'),
                Forms\Components\TextInput::make('budget')->numeric()->prefix('Rp'),
            ])->columns(2),

            Forms\Components\Section::make('Internal')->schema([
                Forms\Components\FileUpload::make('files')
                    ->multiple()->directory('projects')->preserveFilenames(),
                Forms\Components\Textarea::make('internal_notes')->rows(3)->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('client.name')->label('Client')->searchable(),
            Tables\Columns\TextColumn::make('status')->badge()
                ->color(fn ($state) => match($state) {
                    'planning' => 'gray',
                    'development' => 'info',
                    'revision' => 'warning',
                    'done' => 'success',
                    'cancelled' => 'danger',
                }),
            Tables\Columns\TextColumn::make('progress')->suffix('%')
                ->formatStateUsing(fn ($state) => $state . '%'),
            Tables\Columns\TextColumn::make('deadline')->date()->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options(['planning'=>'Planning','development'=>'Development','revision'=>'Revision','done'=>'Done','cancelled'=>'Cancelled']),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}