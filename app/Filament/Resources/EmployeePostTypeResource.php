<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeePostTypeResource\Pages;
use App\Filament\Resources\EmployeePostTypeResource\RelationManagers;
use App\Models\PostType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\KeyValueEntry;

class EmployeePostTypeResource extends Resource
{
    protected static ?string $model = PostType::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Post Type';

    protected static ?string $navigationGroup = 'Mange Employees';

    // protected static ?string $slug = 'Mange Employees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('post_name')
                    ->label('Post Name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('status')
                    ->options([
                        '1' => 'active',
                        '0' => 'deactive',
                    ]),
                // Forms\Components\TextInput::make('media_type')
                //     ->label('Media Type')
                //     ->default('Image')
                //     ->required()
                //     ->maxLength(255)
                //     ->disabled(),
                // Forms\Components\FileUpload::make('media')
                //     ->label('media')
                //     ->required()
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('post_name'),
                // Tables\Columns\TextColumn::make('media_type'),
                // Tables\Columns\TextColumn::make('media'),
                Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(fn ($record) => ($record->status == 1) ?  "active" : "deactive")
                ->color(fn (string $state): string => match ($state) {
                    "active" => 'success',
                    "deactive" => 'danger',
                }),
            ])
            ->filters([
                //
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
            'index' => Pages\ListEmployeePostTypes::route('/'),
            // 'create' => Pages\CreateEmployeePostType::route('/create'),
            // 'edit' => Pages\EditEmployeePostType::route('/{record}/edit'),
        ];
    }
}
