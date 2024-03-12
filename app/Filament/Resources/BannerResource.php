<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\WithFileUploads;

class BannerResource extends Resource
{
    use WithFileUploads;

    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    // protected static ?string $navigationIcon = 'heroicon-o-photo-square';

    // protected static ?string $navigationLabel = 'Post Type';
    
    protected static ?string $navigationGroup = 'Mange Content';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Forms\Components\Select::make('banner_place')
            // ->label('banner_place')
            // // ->options(PostType::where('status', '1')->pluck('post_name', 'id')->toArray())
            // ->required(),
            // Forms\Components\TextInput::make('banner_place')
            //     ->label('Banner Place')
            //     ->required()
            //     ->maxLength(255),
            Forms\Components\Select::make('banner_place')
            ->label('Banner Place')
            ->required()
            ->options([
                'Home' => 'Home',
                'About_us' => 'About Us',
            ]),
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255),


            Forms\Components\TextInput::make('description')
                ->label('Description')
                ->type('tel')
                ->maxLength(255)
                ->required(),

            // Forms\Components\TextInput::make('media_types')
            //     ->label('Media Types')
            //     ->required()
            //     ->maxLength(255),
            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    '0' => 'active',
                    '1' => 'deactive',
                ]),
            // Forms\Components\Select::make('media_types')
            //     ->required()
            //     ->options([
            //         'image' => 'image',
            //         'video' => 'video',
            //     ]),
            // Forms\Components\FileUpload::make('media')
            //     ->label('Media')
            //     ->required()
            //     ->placeholder('Select either an image or a video file')
                // ->customValidationRules(function ($value, $attribute) {
                //     $mediaType = request('media_types');

                //     if ($mediaType == 'image') {
                //         return ['image', 'mimes:jpeg,png,jpg,gif'];
                //     } elseif ($mediaType == 'video') {
                //         return ['mimes:mp4,mov,avi'];
                //     }

                //     return [];
                // }),
                // ->rules(function ($value, $attribute) {
                //     // Additional validation rules based on the selected media type
                //     $mediaType = request('media_types');
            
                //     $commonRules = ['file']; // Common file rules
            
                //     if ($mediaType == 'image') {
                //         $imageRules = ['mimes:jpeg,png,jpg,gif'];
                //         return array_merge($commonRules, $imageRules);
                //     } elseif ($mediaType == 'video') {
                //         $videoRules = ['mimes:mp4,mov,avi'];
                //         return array_merge($commonRules, $videoRules);
                //     }
            
                //     return $commonRules; // Default rules if media type is not specified
                // }),
                Forms\Components\Select::make('media_types')
                    ->required()
                    ->options([
                        'image' => 'image',
                        'video' => 'video',
                    ]),

                Forms\Components\FileUpload::make('media')
                    ->label('Media')
                    ->downloadable()
                    ->removeUploadedFileButtonPosition('right')
                    ->required(),
        ]);
    }
    public function updatedMediaTypes($value)
    {
        $this->validateOnly('media', $this->getMediaValidationRules($value));
    }

    private function getMediaValidationRules($mediaType)
    {
        $commonRules = ['file']; // Common file rules

        if ($mediaType === 'image') {
            $imageRules = ['mimes:jpeg,png,jpg,gif'];
            return array_merge($commonRules, $imageRules);
        } elseif ($mediaType === 'video') {
            $videoRules = ['mimes:mp4,mov,avi'];
            return array_merge($commonRules, $videoRules);
        }

        return $commonRules; // Default rules if media type is not specified
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('banner_place'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('media_types'),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'view' => Pages\ViewBanner::route('/{record}'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
