<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\PostType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BadgeColumn;
// use Laravel\Nova\Fields\Text;
use Filament\Tables\Columns\Text;
use Filament\Tables\Columns\Column;
use Filament\Forms\Components\FileUpload;


class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Employees';
    protected static ?string $navigationGroup = 'Mange Employees';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('post_type_id')
                ->label('Post Type')
                ->options(PostType::where('status', '1')->pluck('post_name', 'id')->toArray())
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->rules(['regex:/^[a-zA-Z\s]+$/'])
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label('Email address')
                ->required()
                ->rules(['regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/i'])
                ->email()
                ->maxLength(255),


            Forms\Components\TextInput::make('phone_number')
                ->label('Phone number')
                ->type('tel')
                ->minLength(10)
                ->maxLength(11)
                ->required(),

            Forms\Components\TextInput::make('address')
                ->label('Address')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('status')
                ->options([
                    '1' => 'active',
                    '0' => 'deactive',
                ]),

            Forms\Components\FileUpload::make('profile_picture')
                ->label('Profile Picture')
                ->required()
                // ->maxFiles(1),
            ]);
        
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('post_type_id')->label('Post Type'),
                Tables\Columns\TextColumn::make('post_type_id')
                    ->label('Post Type')
                    ->value(function ($value, $record) {
                        $postType = PostType::where('id', $record->post_type_id)->first();
                        return $postType ? $postType->post_name : null;
                    }),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('profile_picture'),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('phone_code'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('status'),

            ])
            // ->columns([
            //     TextColumn::make('post_type_id')
            //         ->label('Post Type')
            //         ->getValueUsing(fn ($model) => $model->postType->post_name ?? ''),

            //     TextColumn::make('name'),
            //     TextColumn::make('profile_picture'),
            //     TextColumn::make('email'),
            //     TextColumn::make('phone_code'),
            //     TextColumn::make('phone_number'),
            //     TextColumn::make('address'),
            //     TextColumn::make('status'),
            // ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
