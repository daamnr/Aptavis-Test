<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team1_id')->label('Team 1')->relationship('team1', 'name')->required(),
                Forms\Components\Select::make('team2_id')->label('Team 2')->relationship('team2', 'name')->required(),
                Forms\Components\TextInput::make('score1')->label('Score Team 1')->required()->numeric(),
                Forms\Components\TextInput::make('score2')->label('Score Team 2')->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team1.name')->label('Team 1')->sortable(),
                Tables\Columns\TextColumn::make('team2.name')->label('Team 2')->sortable(),
                Tables\Columns\TextColumn::make('score1')->label('Score Team 1'),
                Tables\Columns\TextColumn::make('score2')->label('Score Team 2'),
                Tables\Columns\TextColumn::make('winner')->label('Winner')->getStateUsing(function ($record) {
                    if ($record->score1 > $record->score2) {
                        return $record->team1->name;
                    } elseif ($record->score1 < $record->score2) {
                        return $record->team2->name;
                    } else {
                        return 'Tie';
                    }
                }),
                Tables\Columns\TextColumn::make('won')->label('Won')->getStateUsing(function ($record) {
                    return ($record->score1 > $record->score2) ? 1 : 0;
                }),
                Tables\Columns\TextColumn::make('tied')->label('Tied')->getStateUsing(function ($record) {
                    return ($record->score1 === $record->score2) ? 1 : 0;
                }),
                Tables\Columns\TextColumn::make('lost')->label('Lost')->getStateUsing(function ($record) {
                    return ($record->score1 < $record->score2) ? 1 : 0;
                }),
                Tables\Columns\TextColumn::make('points')->label('Points')->getStateUsing(function ($record) {
                    if ($record->score1 > $record->score2) {
                        return 3; // If the team won
                    } elseif ($record->score1 === $record->score2) {
                        return 1; // If the game ended in a tie
                    } else {
                        return 0; // If the team lost
                    }
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
