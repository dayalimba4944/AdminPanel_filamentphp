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
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Tabs;
// use Filament\Forms\Components;


class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    // protected static ?string $navigationLabel = 'Post Type';
    
    protected static ?string $navigationGroup = 'Manage Content';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //     ->schema([
    //             // Forms\Components\Select::make('place')
    //             //     ->label('Place')
    //             //     // ->options(PostType::pluck('post_name', 'id')->toArray())
    //             //     ->required(),

    //             Forms\Components\TextInput::make('title')
    //                 ->label('Title')
    //                 ->required()
    //                 ->rules(['regex:/^[a-zA-Z\s]+$/'])
    //                 ->maxLength(255),
    //             Forms\Components\TextInput::make('header')
    //                 ->label('Header')
    //                 ->required()
    //                 ->maxLength(255),

    //             Forms\Components\RichEditor::make('content')
    //                 ->label('Content')
    //                 ->toolbarButtons([
    //                     // 'attachFiles',
    //                     'blockquote',
    //                     'bold',
    //                     'bulletList',
    //                     'codeBlock',
    //                     'h2',
    //                     'h3',
    //                     'italic',
    //                     'link',
    //                     'orderedList',
    //                     'redo',
    //                     'strike',
    //                     'underline',
    //                     'undo',
    //                 ])
    //                 ->required()
    //                 ->columnSpanFull(),

    //         Forms\Components\Select::make('status')
    //             ->options([
    //                 '1' => 'active',
    //                 '0' => 'deactive',
    //             ]),

    //         Forms\Components\Select::make('media_type')
    //             ->options([
    //                 'Image' => 'Image',
    //                 'Video' => 'Video',
                    
    //             ])->required(),
    //         Forms\Components\FileUpload::make('media')
    //             ->label('Media')
    //             ->required(),
    //     ]);
    // }
    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Tab 1')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->rules(['regex:/^[a-zA-Z\s]+$/'])
                                ->maxLength(255),
                            // Add more form fields for Tab 1 if needed
                        ]),
                    Tabs\Tab::make('Tab 2')
                        ->schema([
                            Forms\Components\TextInput::make('header')
                                ->label('Header')
                                ->required()
                                ->maxLength(255),
                            // Add more form fields for Tab 2 if needed
                        ]),
                    Tabs\Tab::make('Tab 3')
                        ->schema([
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
                            // Add more form fields for Tab 3 if needed
                        ]),
                ])
                ->activeTab(2),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                ->label('SR. NO.')
                ->getStateUsing(function ($record) {
                    $position = $record->newQuery()->where('id', '<=', $record->id)->count();
                    return $position;
                }),

                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('header'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('media_type'),
                Tables\Columns\ImageColumn::make('media'),
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
