<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\TeamResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Game;

class StandingGame extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $games = Game::all();

        $teamStats = $this->calculateTeamStats($games);

        return $this->defineTableColumns($table, $teamStats);
    }

    protected function calculateTeamStats($games)
    {
        $teamStats = [];

        foreach ($games as $game) {
            $winner = $this->getWinner($game);
            $loser = $this->getLoser($game);

            $this->updateTeamStats($teamStats, $game->team1_id, $game->team2_id, $winner, $loser);
            $this->updateTeamStats($teamStats, $game->team2_id, $game->team1_id, $winner, $loser);
        }

        return $teamStats;
    }

    protected function getWinner($game)
    {
        if ($game->score1 > $game->score2) {
            return $game->team1_id;
        }

        if ($game->score1 < $game->score2) {
            return $game->team2_id;
        }

        return null;
    }

    protected function getLoser($game)
    {
        if ($game->score1 < $game->score2) {
            return $game->team1_id;
        }

        if ($game->score1 > $game->score2) {
            return $game->team2_id;
        }

        return null;
    }

    protected function updateTeamStats(&$teamStats, $teamId, $opponentId, $winner, $loser)
    {
        if (!isset($teamStats[$teamId])) {
            $teamStats[$teamId] = ['won' => 0, 'tied' => 0, 'lost' => 0, 'points' => 0];
        }

        if ($winner === $teamId) {
            $teamStats[$teamId]['won']++;
            $teamStats[$teamId]['points'] += 3;
        } elseif ($loser === $teamId) {
            $teamStats[$teamId]['lost']++;
        } else {
            $teamStats[$teamId]['tied']++;
            $teamStats[$teamId]['points']++;
        }
    }

    protected function defineTableColumns($table, $teamStats)
    {
        return $table
            ->query(TeamResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Team'),
                Tables\Columns\TextColumn::make('won')->label('Won')->getStateUsing(function ($record) use ($teamStats) {
                    return $teamStats[$record->id]['won'] ?? 0;
                }),
                Tables\Columns\TextColumn::make('tied')->label('Tied')->getStateUsing(function ($record) use ($teamStats) {
                    return $teamStats[$record->id]['tied'] ?? 0;
                }),
                Tables\Columns\TextColumn::make('lost')->label('Lost')->getStateUsing(function ($record) use ($teamStats) {
                    return $teamStats[$record->id]['lost'] ?? 0;
                }),
                Tables\Columns\TextColumn::make('points')->label('Points')->getStateUsing(function ($record) use ($teamStats) {
                    return $teamStats[$record->id]['points'] ?? 0;
                }),
            ]);
    }
}
