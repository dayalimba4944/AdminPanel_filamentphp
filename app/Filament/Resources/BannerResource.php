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

    // private function getMediaValidationRules($mediaType)
    // {
    //     // Common file rules
    //     $commonRules = ['file'];
    
    //     if ($mediaType === 'image') {
    //         $imageRules = ['mimes:jpeg,png,jpg,gif'];
    //         return array_merge($commonRules, $imageRules);
    //     } elseif ($mediaType === 'video') {
    //         $videoRules = ['mimes:mp4,mov,avi'];
    //         return array_merge($commonRules, $videoRules);
    //     }
    
    //     // If media type is not specified, return an empty array to disable the button
    //     return [];
    // }
    

    public static function form(Form $form): Form
    {
    //    return $allowedFileTypes = ($state->media_types == 'image') ? ['jpg', 'jpeg', 'png'] : ['video/mp4'] ;
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
            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    '0' => 'active',
                    '1' => 'deactive',
                ]),
                Forms\Components\Select::make('media_types')
                ->label('Media Type')
                ->required()
                ->options([
                    'image' => 'Image',
                    'video' => 'Video',
                ]),
            Forms\Components\FileUpload::make('media')
                ->label('Media')
                ->downloadable()
                ->imageEditor()
                ->disabled(fn ($record) => empty(optional($record)->media_types)) // Disable button if media_types is empty
                ->required()
                ->acceptedFileTypes(function ($record) {
                    $mediaTypes = optional($record)['media_types'];
    
                    if ($mediaTypes == 'image') {
                        return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['image/*'];
                    } elseif ($mediaTypes == 'video') {
                        return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['video/*'];
                    } 
                }),

    //! ///////////////////////
            // Forms\Components\FileUpload::make('media')
            //     ->label('Media')
            //     ->downloadable()
            //     ->imageEditor()
            //     ->required()
                // ->acceptedFileTypes(function ($state) {
                //     return $state['media_types'] === 'image' ? ['jpg', 'jpeg', 'png'] : ['video/mp4'];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     return $record['media_types'] === 'image' ? ['jpg', 'jpeg', 'png'] : ['video/mp4'];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     return isset($record['media_types']) && $record['media_types'] === 'image' ? ['video/mp4'] : ['image/jpg', 'image/jpeg', 'image/png'] ;
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = $record->getState('media_types');
                //     return isset($mediaTypes) && $mediaTypes === 'image' ? ['image/jpg', 'image/jpeg', 'image/png'] : ['video/mp4'] ;
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     if ($record && isset($record['media_types'])) {
                //         return $record['media_types'] === 'image' ? ['jpg', 'jpeg', 'png'] : ['video/mp4'];
                //     }
                //     return [];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     if ($record && isset($record['media_types'])) {

                //         dd($record['media_types']);
                //         // if ($record['media_types'] === 'image') {
                //         //     return ['jpg', 'jpeg', 'png'];
                //         // }else 
                //         // // ($record['media_types'] === 'video')
                //         //  {
                //         //     return ['mp4', 'mov', 'avi'];
                //         // }
                //         // else{
                //         //     return 'xyz';
                //         // }
                //         // return $record['media_types'] === 'image' ? ['jpg', 'jpeg', 'png'] : ['mp4', 'mov', 'avi'];
                //     }
                //     // Handle the case where $record is null or 'media_types' is not set.
                //     return [];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     if ($record['media_types'] === 'image') {
                //         return ['jpg', 'jpeg', 'png'];
                //     } elseif ($record['media_types'] === 'video') {
                //         return ['mp4', 'mov', 'avi'];
                //     }

                //     // Handle the case where 'media_types' is not set or has an unexpected value.
                //     return [];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];

                //     if ($mediaTypes === 'image') {
                //         return ['jpg', 'jpeg', 'png'];
                //     } elseif ($mediaTypes === 'video') {
                //         return ['mp4', 'mov', 'avi'];
                //     }

                //     return [];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];
            
                //     return $mediaTypes ? $this->getMediaValidationRules($mediaTypes) : ['image/jpg', 'image/jpeg', 'image/png', 'video/mp4'];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];
            
                //     return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['image/jpg', 'image/jpeg', 'image/png', 'video/mp4'];
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];
                    
                //     if ($mediaTypes == 'image') {
                //         return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['image/*'];
                //     } elseif ($mediaTypes == 'video') {
                //         return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['video/*'];
                //     } else {
                //         throw new \Exception('Please select a media type!');
                //     }
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];
                //     dd($mediaTypes);
                //     if ($mediaTypes == 'video') {
                //         dd($mediaTypes , 'video');
                //         // return ['mp4', 'mov', 'avi'];
                       
                //     } elseif  ($mediaTypes == 'image') {
                //         // dd($mediaTypes . ',' . "image");
                //         return ['image/jpg', 'image/jpeg', 'image/png'];
                //     }else{
                //         dd($mediaTypes);
                //     }
                // }),
                // ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];
            
                //     // switch ($mediaTypes) {
                //     //     case 'video':
                //     //         // return ['video/mp4'];
                //     //         dd('video');
                //     //         break;
                //     //     case 'image':
                //     //         // return ['image/jpg', 'image/jpeg', 'image/png'];
                //     //         dd('image');
                //     //         break;
                //     //     default:
                //     //         return [];
                //     //         // dd(null);
                //     //         break;
                //     // }
                //     if ($mediaTypes == 'video') {
                //                 dd($mediaTypes , 'video');
                //                 // return ['mp4', 'mov', 'avi'];
                               
                //             } elseif  ($mediaTypes == 'image') {
                //                 dd($mediaTypes . ',' . "image");
                //                 // return ['image/jpg', 'image/jpeg', 'image/png'];
                //             }
                //             // else{
                //             //     dd($mediaTypes);
                //             // }
                // }),
                //  ->acceptedFileTypes(function ($record) {
                //         if ($record && isset($record['media_types'])) {
                //             return $record['media_types'] === 'image' ? ['image/jpg', 'image/jpeg', 'image/png'] : ['video/mp4'] ;
                //         }
                //         return [];
                //     }),
                //  ->acceptedFileTypes(function ($record) {
                //     $mediaTypes = optional($record)['media_types'];
                    
                //     if ($mediaTypes == 'image') {
                //         return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['image/*'];
                //     } elseif ($mediaTypes == 'video') {
                //         return $mediaTypes ? self::getMediaValidationRules($mediaTypes) : ['video/*'];
                //     } 
                // }),
        
                



        ]);
    }
    // public function updatedMediaTypes($value)
    // {
    //     $this->validateOnly('media', $this->getMediaValidationRules($value));
    // }

    private function getMediaValidationRules($mediaType)
    {
        $commonRules = ['file']; // Common file rules
    
        if ($mediaType === 'image') {
            return ['mimes:jpeg,png,jpg,gif'];
        } elseif ($mediaType === 'video') {
            return ['mimes:mp4,mov,avi'];
        }
    
        // Return default rules if media type is not specified
        return $commonRules;
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serial_number')
                ->label('SR. NO.')
                ->getStateUsing(function ($record) {
                    $position = $record->newQuery()->where('id', '<=', $record->id)->count();
                    return $position;
                }),
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
