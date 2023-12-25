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
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Split;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\OrderResource\Pages;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user')->searchable(),
                
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
                Tables\Actions\EditAction::make(),
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
                    // This is the important part!
                    ->infolist([
                        // Inside, we can treat this as any info list and add all the fields we want!
                        Section::make('Personal Information')
                            ->schema([
                                TextEntry::make('id'),
                                TextEntry::make('total_amount'),
                            ])
                            ->columns(),
                        Section::make('Contact Information')
                            ->schema([
                                TextEntry::make('orderItems.id'),
                                TextEntry::make('phone_number'),
                            ])
                            ->columns(),
                        Section::make('Additional Details')
                            ->schema([
                                TextEntry::make('description'),
                            ]),
                        Section::make('Lead and Stage Information')
                            ->schema([
                                TextEntry::make('leadSource.name'),
                                TextEntry::make('pipelineStage.name'),
                            ])
                            ->columns(),
                    ]),
            ]);;
    }
    
    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //     ->state([
    //         'order' => $this->getTableRecords(),
    //     ])
    //     ->schema([
    //         RepeatableEntry::make('albums')
    //             ->hiddenLabel()
    //             ->schema([
    //                 Split::make([
    //                     Grid::make(1)
    //                         ->schema([
    //                             TextEntry::make('name')
    //                                 ->hiddenLabel(),
    //                             TextEntry::make('lyric_count')
    //                                 ->hiddenLabel(),
    //                             TextEntry::make('detail')
    //                                 ->hiddenLabel(),
    //                             RepeatableEntry::make('artists')
    //                                 ->schema([
    //                                     TextEntry::make('name')
    //                                         ->badge()
    //                                         ->hiddenLabel(),
    //                                 ]),
    //                         ])
    //                 ])->from('lg'),
    //             ]),
    //     ]);
    // }
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
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }    
}
