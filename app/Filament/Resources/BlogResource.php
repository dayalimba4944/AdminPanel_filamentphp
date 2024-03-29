<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    // protected static ?string $navigationLabel = 'Post Type';
    
    protected static ?string $navigationGroup = 'Mange Content';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
                // Forms\Components\Select::make('place')
                //     ->label('Place')
                //     // ->options(PostType::pluck('post_name', 'id')->toArray())
                //     ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->rules(['regex:/^[a-zA-Z\s]+$/'])
                    ->maxLength(255),
                Forms\Components\TextInput::make('header')
                    ->label('Header')
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('content')
                    ->label('Content')
                    ->toolbarButtons([
                        // 'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->required()
                    ->columnSpanFull(),

            Forms\Components\Select::make('status')
                ->options([
                    '1' => 'active',
                    '0' => 'deactive',
                ]),

            Forms\Components\Select::make('media_type')
                ->options([
                    'Image' => 'Image',
                    'Video' => 'Video',
                    
                ])->required(),
            Forms\Components\FileUpload::make('media')
                ->label('Media')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('header'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('media_type'),
                Tables\Columns\ImageColumn::make('media'),
                Tables\Columns\TextColumn::make('status'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'view' => Pages\ViewBlog::route('/{record}'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
