<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Portfolios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('client_name')
                            ->maxLength(255),

                        Forms\Components\Select::make('category')
                            ->required()
                            ->options([
                                'web'    => 'Web Development',
                                'mobile' => 'Mobile App',
                                'design' => 'UI/UX Design',
                                'other'  => 'Other',
                            ])
                            ->searchable(),

                        Forms\Components\TextInput::make('url')
                            ->label('Project URL')
                            ->url()
                            ->maxLength(255),

                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'active'   => 'Active',
                                'archived' => 'Archived',
                            ])
                            ->default('active'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Tech & Media')
                    ->schema([
                        Forms\Components\TagsInput::make('tech_stack')
                            ->label('Tech Stack')
                            ->placeholder('Add technology (e.g. Laravel, Vue.js)')
                            ->separator(',')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('images')
                            ->label('Portfolio Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->directory('portfolios')
                            ->maxFiles(10)
                            ->maxSize(10240)
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->label('Image')
                    ->stacked()
                    ->limit(3),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('client_name')
                    ->searchable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'web'    => 'info',
                        'mobile' => 'success',
                        'design' => 'warning',
                        default  => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active'   => 'success',
                        'archived' => 'danger',
                        default    => 'gray',
                    }),

                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active'   => 'Active',
                        'archived' => 'Archived',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'web'    => 'Web Development',
                        'mobile' => 'Mobile App',
                        'design' => 'UI/UX Design',
                        'other'  => 'Other',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit'   => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}