<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'Sales';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\TextInput::make('phone')->required(),
            Forms\Components\Textarea::make('needs')->rows(3),
            Forms\Components\Select::make('status')
                ->options(['new'=>'New','contacted'=>'Contacted','closed_won'=>'Closed Won','closed_lost'=>'Closed Lost'])
                ->default('new'),
            Forms\Components\TextInput::make('source')->default('website'),
            Forms\Components\Textarea::make('notes')->rows(2),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('status')->badge()
                ->color(fn ($state) => match($state) {
                    'new' => 'info',
                    'contacted' => 'warning',
                    'closed_won' => 'success',
                    'closed_lost' => 'danger',
                }),
            Tables\Columns\TextColumn::make('source')->badge(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('Masuk'),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options(['new'=>'New','contacted'=>'Contacted','closed_won'=>'Closed Won','closed_lost'=>'Closed Lost']),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}