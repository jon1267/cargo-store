<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutoResource\Pages;
use App\Filament\Resources\AutoResource\RelationManagers;
use App\Models\Auto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Markdown;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AutoResource extends Resource
{
    protected static ?string $model = Auto::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make([

                        Forms\Components\Select::make('type')
                            ->options([
                                'bus' => 'Bus',
                                'truck' => 'Truck',
                                'long_vehicle' => 'Long Vehicle',
                            ])
                            ->required()
                            ->default('bus'),

                        Forms\Components\TextInput::make('car_number')
                            ->required()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('fuel_consumption')
                            ->numeric(),

                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        //Forms\Components\MarkdownEditor::make('description')->columnSpanFull(),

                        Forms\Components\KeyValue::make('data')
                            ->columnSpanFull(),

                        ])->columns(3)
                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Image')->schema([
                        Forms\Components\FileUpload::make('image')
                            ->directory('cargo')
                            ->image(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),
                    ])
                ])->columnSpan(1)

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('car_number')
                    ->label('Car Number')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): ?string => match ($state) {
                        'bus' => 'info',
                        'truck' => 'success',
                        'long_vehicle' => 'warning',
                    }),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),

                Tables\Columns\TextColumn::make('fuel_consumption')
                    ->label('Fuel')
                    ->tooltip('Fuel Consumption L / 100 km')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->height(70)
                    ->width(90),

                Tables\Columns\IconColumn::make('is_active')
                    ->sortable()
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->date() //->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date()//->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListAutos::route('/'),
            'create' => Pages\CreateAuto::route('/create'),
            'edit' => Pages\EditAuto::route('/{record}/edit'),
        ];
    }
}
