<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Filament\Resources\ContactInfoResource\RelationManagers;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Contact Info';

    protected static ?string $navigationGroup = 'Mange CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('onwn_name')
                    ->label('onwn_name')
                    ->required()
                    ->rules(['regex:/^[a-zA-Z\s]+$/']),
                // Forms\Components\TextInput::make('phone_code')
                // ->label('phone_code')
                // ->required(),
                Forms\Components\TextInput::make('phone_number')
                ->label('phone_number')
                ->required(),
                Forms\Components\TextInput::make('email')
                ->label('email')
                ->required(),
                Forms\Components\TextInput::make('address')
                ->label('address')
                ->required(),
                Forms\Components\TextInput::make('facebook')
                ->label('facebook')
                ->required(),
                Forms\Components\TextInput::make('instagram')
                ->label('instagram')
                ->required(),
                Forms\Components\TextInput::make('twitter')
                ->label('twitter')
                ->required(),
                Forms\Components\TextInput::make('youtube')
                ->label('youtube')
                ->required(),
                Forms\Components\TextInput::make('linkedin')
                ->label('linkedin')
                ->required(),
                Forms\Components\TextInput::make('website_name')
                ->label('website_name')
                ->required(),
        
            Forms\Components\FileUpload::make('website_logo')
            ->label('website_logo')
            ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('SR')
                // ->value(function () {
                //     $sr = 1;
                //     return $sr++;
                // }),
                Tables\Columns\TextColumn::make('onwn_name'),
                Tables\Columns\TextColumn::make('website_name'),
                Tables\Columns\ImageColumn::make('website_logo'),
                // Tables\Columns\TextColumn::make('phone_code'),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('facebook'),
                Tables\Columns\TextColumn::make('instagram'),
                Tables\Columns\TextColumn::make('twitter'),
                Tables\Columns\TextColumn::make('youtube'),
                Tables\Columns\TextColumn::make('linkedin'),
            ])
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
    
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canIndex(): bool
    {
        return false;
        // return route('view');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactInfos::route('/'),
            'create' => Pages\CreateContactInfo::route('/create'),
            'view' => Pages\ViewContactInfo::route('/{record}', ['record' => 1]),
            'edit' => Pages\EditContactInfo::route('/{record}/edit', ['record' => 1]),
        ];
    }
}
