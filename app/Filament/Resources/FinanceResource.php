<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinanceResource\Pages;
use App\Models\Finance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FinanceResource extends Resource
{
    protected static ?string $model = Finance::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Finance';

    // Hanya management yang bisa akses
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['admin', 'management']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options(['income'=>'Income','expense'=>'Expense','reimbursement'=>'Reimbursement'])
                ->required(),
            Forms\Components\TextInput::make('description')->required(),
            Forms\Components\TextInput::make('amount')->numeric()->prefix('Rp')->required(),
            Forms\Components\DatePicker::make('date')->required()->default(now()),
            Forms\Components\TextInput::make('category'),
            Forms\Components\Select::make('project_id')
                ->relationship('project', 'name')->searchable()->nullable(),
            Forms\Components\FileUpload::make('proof')->directory('finance-proofs'),
            Forms\Components\Select::make('status')
                ->options(['pending'=>'Pending','approved'=>'Approved','rejected'=>'Rejected'])
                ->default('approved'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('date')->date()->sortable(),
            Tables\Columns\TextColumn::make('description')->searchable(),
            Tables\Columns\TextColumn::make('type')->badge()
                ->color(fn ($state) => match($state) {
                    'income' => 'success',
                    'expense' => 'danger',
                    'reimbursement' => 'warning',
                }),
            Tables\Columns\TextColumn::make('amount')
                ->money('IDR')->sortable(),
            Tables\Columns\TextColumn::make('status')->badge(),
        ])
        ->defaultSort('date', 'desc')
        ->filters([
            Tables\Filters\SelectFilter::make('type')
                ->options(['income'=>'Income','expense'=>'Expense','reimbursement'=>'Reimbursement']),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinances::route('/'),
            'create' => Pages\CreateFinance::route('/create'),
            'edit' => Pages\EditFinance::route('/{record}/edit'),
        ];
    }
}