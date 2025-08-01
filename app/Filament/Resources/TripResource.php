<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers;
use App\Models\Auto;
use App\Models\Driver;
use App\Models\Trip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([

                        Forms\Components\Select::make('driver_id')
                            ->label('Driver')
                            ->options(Driver::all()->pluck('full_name', 'id'))
                            ->required()
                            ->searchable(),

                        Forms\Components\Select::make('auto_id')
                            ->label('Auto')
                            ->options(Auto::all()->pluck('trip_auto', 'id'))
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\KeyValue::make('data')
                            ->columnSpanFull(),

                    ])->columns(2),



                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([

                        Forms\Components\TextInput::make('place_from')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('place_to')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('distance')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\DateTimePicker::make('trip_start'),
                        Forms\Components\DateTimePicker::make('trip_end'),
                    ])->columns(1),
                ])->columnSpan(1)


            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('driver.last_name')
                //    ->sortable(),
                Tables\Columns\TextColumn::make('auto.type')
                    ->label('Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('auto.car_number')
                    ->label('Auto Number')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Trip Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('place_from')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('place_to')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('auto.image')
                    ->height(50)
                    ->width(70),
                Tables\Columns\TextColumn::make('distance')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('trip_start')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('trip_end')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('driver.first_name')
                    ->label('Name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('driver.last_name')
                    ->label('Last Name')
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TripResource\Widgets\TripStats::class,
        ];
    }
}
