<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')->required(),
                Forms\Components\FileUpload::make('imgUrl')
                    ->required()
                    ->columns(1)
                    ->disk('cloudinary')
                    ->directory('MeoMeoShop/ProductImage'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('VND')
                    ->required(),
                Forms\Components\TextInput::make('stock_quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('species')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('category')->required(),
                Forms\Components\TextInput::make('sub_category'),
                Forms\Components\TextInput::make('brand'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\ImageColumn::make('imgUrl'),
                Tables\Columns\TextColumn::make('price')->sortable()->money('VND'),
                Tables\Columns\TextColumn::make('stock_quantity'),
                Tables\Columns\SelectColumn::make('species')
                ->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'other' => 'Other',
                ]),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('sub_category'),
                Tables\Columns\TextColumn::make('brand'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('species')
                ->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'other' => 'Other',
                ]),
                Tables\Filters\SelectFilter::make('category')
                ->options([
                    'Food' => 'Food',
                    'Clothes' => 'Clothes',
                    'Toys' => 'Toys',
                    'Vitamins' => 'Vitamins',
                    'Shampoo' => 'Shampoo',
                    'Collars' => 'Collars',
                    'Bowls' => 'Bowls',
                    'Beds' => 'Beds',
                    'Treats' => 'Treats',
                    'Container' => 'Container',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }    
}
