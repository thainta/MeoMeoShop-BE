<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Http;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Split;
use App\Http\Controllers\OrderController;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use App\Http\Controllers\OrderItemController;
use App\Filament\Resources\OrderResource\Pages;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             //
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        $apiCall = (new OrderItemController())->getOrderItemByOrder(1);
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label("Order Id")->searchable(),
                
                Tables\Columns\TextColumn::make('total_amount')->sortable()->money('VND'),
                Tables\Columns\SelectColumn::make('status')
                ->options([
                    'pending' => 'Pending',
                    'complete' => 'Complete',
                    'cancel' => 'Cancel',
                ]),
                Tables\Columns\TextColumn::make('order_date'),
                
                //
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('View Information')
                    ->infolist([
                        Section::make('Customer Information')
                            ->schema([
                                TextEntry::make('users.name')->label("Customer name")->listWithLineBreaks(),
                                TextEntry::make('total_amount')->label("Total price")->money('VND')->listWithLineBreaks(),                 
                            ])
                            ->columns(4),
                        RepeatableEntry::make('orderItems')
                            ->label("Products Information")
                            ->schema([
                                TextEntry::make('products.id')->label("Product Id")->listWithLineBreaks(),                                
                                TextEntry::make('products.name')->label("Name")->listWithLineBreaks(),
                                TextEntry::make('quantity')->label("Quantity")->listWithLineBreaks(),
                                TextEntry::make('subtotal')->label("Price")->money('VND')->listWithLineBreaks(), 
                            ])
                            ->columns(4) 
                    ]),
            ]);;
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
            'index' => Pages\ListOrders::route('/'),
        ];
    }    
}
