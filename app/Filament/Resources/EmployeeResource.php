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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;

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
                ->required()
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
    // protected static int $index = 0;
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('index')
                //     ->label('Index')
                //     ->getStateUsing(fn ($record) => self::$index +=1 ),

                // TextColumn::make('Index')
                // ->label('SR. NO. ')
                // ->getStateUsing(function ($record, $column) {
                //     static $index = 1;
                //     return $index++;
                // }),
                // TextColumn::make('serial_number')
                //     ->label('SR. NO.')
                //     ->getStateUsing(function ($record) use ($table) {
                //         return $table->getPaginator()->firstItem() + $table->getPaginator()->perPage() * ($table->getPaginator()->currentPage() - 1) + $table->getPaginator()->currentPage();
                //     }),
                TextColumn::make('serial_number')
                ->label('SR. NO.')
                ->getStateUsing(function ($record) {
                    $position = $record->newQuery()->where('id', '<=', $record->id)->count();
                    return $position;
                }),

                Tables\Columns\TextColumn::make('post_type_id')->label('Post Type'),
                TextColumn::make('post_type_id')
                ->label('Post Type')
                ->getStateUsing(fn ($record) => $record->postType->post_name),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('profile_picture'),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('phone_code'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('status'),
                TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(fn ($record) => ($record->status == 1) ?  "active" : "deactive")
                ->color(fn (string $state): string => match ($state) {
                    "active" => 'success',
                    "deactive" => 'danger',
                }),

            ])
            ->filters([
                SelectFilter::make('status')
                ->options([
                    '1' => 'active',
                    '0' => 'deactive',
                ])
                ->attribute('status')
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
