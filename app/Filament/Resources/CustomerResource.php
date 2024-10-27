<?php

namespace App\Filament\Resources;

use App\Enums\AccountOpeningStatusEnum;
use App\Enums\PermissionEnum;
use App\Filament\Actions\Customer\ApproveAction;
use App\Filament\Actions\Customer\RejectAction;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
	                ->maxLength(255),
                Forms\Components\TextInput::make('account_number')
                    ->required()
	                ->maxLength(255)
	                ->unique(ignoreRecord: true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_number')
                    ->searchable(),
	            Tables\Columns\TextColumn::make('status_account_opening')
		            ->label('Status')
		            ->badge()
		            ->sortable()
		            ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
	        ->filters([
		        \Filament\Tables\Filters\SelectFilter::make('status_account_opening')
			        ->label('Status')
			        ->options(AccountOpeningStatusEnum::getAllWithKeyValue())
			        ->placeholder('All')
	        ])
            ->actions(self::tableActions())
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(self::tableBulkActions()),
            ])
	        ->recordUrl(function ($record) {
		        return Auth::user()->can(PermissionEnum::AccountOpeningsCRUD)
			        ? Pages\EditCustomer::getUrl(['record' => $record->getKey()])
			        : null;
	        });
    }
	
	public static function canCreate(): bool
	{
		return Auth::user()->can(PermissionEnum::AccountOpeningsCRUD);
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
	
	private static function tableActions(): array
	{
		$user = Auth::user();
		
		$actions = [
			Tables\Actions\ViewAction::make(),
		];
		
		if($user->can(PermissionEnum::AccountOpeningsCRUD)) {
			$actions[] = Tables\Actions\EditAction::make()
				->visible(fn ($record) => $record->status_account_opening === AccountOpeningStatusEnum::Pending);
		}
		
		if($user->can(PermissionEnum::AccountOpeningsApprover)) {
			$actions[] = ApproveAction::make();
			$actions[] = RejectAction::make();
		}
		
		return $actions;
	}
	
	private static function tableBulkActions(): array
	{
		$user = Auth::user();
		
		if($user->can(PermissionEnum::AccountOpeningsCRUD)) {
			$actions[] = Tables\Actions\DeleteBulkAction::make();
		}
		
		return $actions ?? [];
	}
}
