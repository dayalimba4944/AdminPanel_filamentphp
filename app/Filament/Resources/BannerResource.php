<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\WithFileUploads;
use Filament\Forms\Components\Section;

use Filament\Forms\ComponentContainer;
// use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
// use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Forms\Components\ViewField;

class BannerResource extends Resource
{
    use WithFileUploads;

    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    
    protected static ?string $navigationGroup = 'Manage Content';


    
    // public static function form(Form $form): Form
    // {
    //     // Define the common fields
    //     $commonFields = [
    //         Select::make('banner_place')
    //             ->label('Banner Place')
    //             ->required()
    //             ->options([
    //                 'Home' => 'Home',
    //                 'About_us' => 'About Us',
    //             ]),
    //         TextInput::make('title')
    //             ->label('Title')
    //             ->required()
    //             ->maxLength(255),
    //         Textarea::make('description')
    //             ->label('Description')
    //             ->maxLength(255)
    //             ->required(),
    //         Select::make('status')
    //             ->required()
    //             ->options([
    //                 '0' => 'Active',
    //                 '1' => 'Deactive',
    //             ]),
    //         Select::make('media_types')
    //             ->label('Media Type')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ])
    //             // ->onChange(function (string $value) {
    //             //     // Callback function to be called when the value of the select component changes
    //             //     if ($value === 'image' || $value === 'video') {
    //             //         // Add the media section to the form schema
    //             //         $this->form->schema->add($this->mediaSection);
    //             //     } else {
    //             //         // Remove the media section from the form schema
    //             //         $this->form->schema->forget($this->mediaSection);
    //             //     }
    //             // })
    //             ->reactive(), // Make the component reactive
    //     ];
    
    //     // Define the media-specific field
    //     $mediaField = FileUpload::make('media')
    //         ->label('Media')
    //         ->downloadable()
    //         ->imageEditor()
    //         ->required();
    
    //     // Create the section for common fields
    //     $commonSection = Section::make('')
    //         ->schema([...$commonFields])
    //         ->columns(2);
    
    //     // Create the section for media-specific field
    //     $mediaSection = Section::make('')
    //         ->schema([$mediaField])
    //         ->columns(2);
    
    //     // Initially, add only the common section
    //     $form->schema([$commonSection]);
    
    //     // // Configure the form to dynamically show/hide the media section based on media_types field value
    //     // $form->configure(function (ComponentContainer $container) use ($mediaSection) {
    //     //     $container->state(function (array $state) use ($mediaSection) {
    //     //         if (isset($state['media_types']) && ($state['media_types'] === 'image' || $state['media_types'] === 'video')) {
    //     //             $this->schema([$mediaSection]);
    //     //         } else {
    //     //             $this->removeComponent($mediaSection);
    //     //         }
    //     //     });
    //     // });

    //     // $form->scripts(function () {
    //     //     return <<<SCRIPT
    //     //     document.addEventListener('DOMContentLoaded', function () {
    //     //         const mediaTypesInput = document.getElementById('media_types');
    //     //         console.log(mediaTypesInput.value); // Corrected typo in console.log
    //     //     });
    //     //     SCRIPT;
    //     // });
    
    //     return $form;
    // }
    
    
    
    
    // public static function form(Form $form): Form
    // {
    //     // Define the form fields for the first section of the profile editing
    //     $firstSectionFields = [
    //         Select::make('banner_place')
    //             ->label('Banner Place')
    //             ->required()
    //             ->options([
    //                 'Home' => 'Home',
    //                 'About_us' => 'About Us',
    //             ]),
    //         TextInput::make('title')
    //             ->label('Title')
    //             ->required()
    //             ->maxLength(255),
    //         Textarea::make('description')
    //             ->label('Description')
    //             ->maxLength(255)
    //             ->required(),
    //         Select::make('status')
    //             ->required()
    //             ->options([
    //                 '0' => 'Active',
    //                 '1' => 'Deactive',
    //             ]),
    //         Select::make('media_types')
    //             ->label('Media Type')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ]),
    //         Select::make('Image')
    //             ->label('Image')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ])
    //     ];
    
    //     // Define the form fields for the second section of the profile editing
    //     $secondSectionFields = [
    //         Select::make('banner_place')
    //             ->label('Banner Place')
    //             ->required()
    //             ->options([
    //                 'Home' => 'Home',
    //                 'About_us' => 'About Us',
    //             ]),
    //         TextInput::make('title')
    //             ->label('Title')
    //             ->required()
    //             ->maxLength(255),
    //         Textarea::make('description')
    //             ->label('Description')
    //             ->maxLength(255)
    //             ->required(),
    //         Select::make('status')
    //             ->required()
    //             ->options([
    //                 '0' => 'Active',
    //                 '1' => 'Deactive',
    //             ]),
    //         Select::make('media_types')
    //             ->label('Media Type')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ])
    //     ];
    
    //     // // Define the schema for the first section
    //     // $form->schema($firstSectionFields);
    
    //     // // Define the schema for the second section
    //     // $form->schema($secondSectionFields);
    //     $firstSection = Section::make('First Section')
    //     ->schema($firstSectionFields)
    //     ->columns(2);

    //     // Create the second section
    //     $secondSection = Section::make('Second Section')
    //     ->schema($secondSectionFields)
    //     ->columns(2);
    
    //      $form1->schema([$firstSection,$secondSection]);
    //     $form2->schema([$firstSection,$secondSection]);
    //     return $form = [$form1 , $form2];
    // }
    

    // use Filament\Forms\ComponentContainer;
    // use Filament\Forms\Components\Section;
    // use Filament\Forms\Form;
    // use Filament\Forms\Components\Select;
    // use Filament\Forms\Components\FileUpload;
    // use Filament\Forms\Components\TextInput;
    // use Filament\Forms\Components\Textarea;
    
    public static function form(Form $form): Form
    {
        // // Define the form fields for the first section of the profile editing
        // $firstformFields = [
        //     Select::make('banner_place')
        //         ->label('Banner Place')
        //         ->required()
        //         ->options([
        //             'Home' => 'Home',
        //             'About_us' => 'About Us',
        //         ]),
        //     TextInput::make('title')
        //         ->label('Title')
        //         ->required()
        //         ->maxLength(255),
        //     Textarea::make('description')
        //         ->label('Description')
        //         ->maxLength(255)
        //         ->required(),
        //     Select::make('status')
        //         ->required()
        //         ->options([
        //             '0' => 'Active',
        //             '1' => 'Deactive',
        //         ]),
        //     Select::make('media_types')
        //         ->label('Media Type')
        //         ->required()
        //         ->options([
        //             'image' => 'Image',
        //             'video' => 'Video',
        //         ]),
        //     Select::make('Image')
        //         ->label('Image')
        //         ->required()
        //         ->options([
        //             'image' => 'Image',
        //             'video' => 'Video',
        //         ])
        // ];
    
        // Define the form fields for the second section of the profile editing
        $secondformFields = [
            Select::make('banner_place')
                ->label('Banner Place')
                ->required()
                ->options([
                    'Home' => 'Home',
                    'About_us' => 'About Us',
                ]),
            TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->label('Description')
                ->maxLength(255)
                ->required(),
            Select::make('status')
                ->required()
                ->options([
                    '0' => 'Active',
                    '1' => 'Deactive',
                ]),
                Select::make('media_types')
                ->label('Media Type')
                ->required()
                ->options([
                    'image' => 'Image',
                    'video' => 'Video',
                ])
                ,
                FileUpload::make('media')
                ->label('Media')
                ->downloadable()
                ->openable()
                ->imageEditorMode(3)
                // ->reuplodeable()
                ->imageEditor()
                ->required()
                ->reactive(function ($record, $data) {
                    return $data['media_types'] === 'image' || $data['media_types'] === 'video';
                }),
            

                ViewField::make('rating')
                ->view('filament.pages.create-banner')
        ];
    
        // // Create the first section
        // $firstSection = Section::make('First Section')
        // ->schema($firstformFields)
        // ->columns(2);

        // Create the second section
        $secondSection = Section::make('Second Section')
            ->schema($secondformFields)
            ->columns(2);

        // Add both sections to the form
        $form->schema([ $secondSection]);

        // Return the form instance
        return $form;
    }
    
    // public static function form(Form $form): Form
    // {
    //     // Create a new Form instance
    //     $form = Form::make();
    
    //     // Define the form fields for the first section of the profile editing
    //     $firstSectionFields = [
    //         Select::make('banner_place')
    //             ->label('Banner Place')
    //             ->required()
    //             ->options([
    //                 'Home' => 'Home',
    //                 'About_us' => 'About Us',
    //             ]),
    //         TextInput::make('title')
    //             ->label('Title')
    //             ->required()
    //             ->maxLength(255),
    //         Textarea::make('description')
    //             ->label('Description')
    //             ->maxLength(255)
    //             ->required(),
    //         Select::make('status')
    //             ->required()
    //             ->options([
    //                 '0' => 'Active',
    //                 '1' => 'Deactive',
    //             ]),
    //         Select::make('media_types')
    //             ->label('Media Type')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ]),
    //         Select::make('Image')
    //             ->label('Image')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ])
    //     ];
    
    //     // Define the form fields for the second section of the profile editing
    //     $secondSectionFields = [
    //         Select::make('banner_place')
    //             ->label('Banner Place')
    //             ->required()
    //             ->options([
    //                 'Home' => 'Home',
    //                 'About_us' => 'About Us',
    //             ]),
    //         TextInput::make('title')
    //             ->label('Title')
    //             ->required()
    //             ->maxLength(255),
    //         Textarea::make('description')
    //             ->label('Description')
    //             ->maxLength(255)
    //             ->required(),
    //         Select::make('status')
    //             ->required()
    //             ->options([
    //                 '0' => 'Active',
    //                 '1' => 'Deactive',
    //             ]),
    //         Select::make('media_types')
    //             ->label('Media Type')
    //             ->required()
    //             ->options([
    //                 'image' => 'Image',
    //                 'video' => 'Video',
    //             ])
    //     ];
    
    //     // Create the first section
    //     $firstSection = Section::make('First Section')
    //         ->schema($firstSectionFields)
    //         ->columns(2);
    
    //     // Create the second section
    //     $secondSection = Section::make('Second Section')
    //         ->schema($secondSectionFields)
    //         ->columns(2);
    
    //     // Add both sections to the form
    //     $form->schema([$firstSection, $secondSection]);
    
    //     return $form;
    // }

//     public static function form(Form $form): Form
// {
//     // Define the first form
//     $form1 = $form->schema(function (Form $form) {
//         $form->schema([
//             TextInput::make('field1')->label('Field 1'),
//             TextInput::make('field2')->label('Field 2'),
//         ]);
//     });

//     // Define the second form
//     $form2 = $form->schema(function (Form $form) {
//         $form->schema([
//             Textarea::make('field3')->label('Field 3'),
//             Textarea::make('field4')->label('Field 4'),
//         ]);
//     });

//     // Return an array of forms
//     return [$form1, $form2];
// }
    
    
    
    
    
    
    
    
    

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
