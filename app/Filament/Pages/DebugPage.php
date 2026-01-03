<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class DebugPage extends Page
{
    public ?array $data = [];

    protected static string|null|BackedEnum $navigationIcon = Heroicon::OutlinedBugAnt;

    protected static ?string $title = 'Debug - TailwindCSS Test';

    protected static ?string $navigationLabel = 'Debug';

    protected string $view = 'filament.pages.debug-page';

    public function mount(): void
    {
        //$this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(2)
                    ->gap(6)
                    ->schema([
                        Section::make('Column 1 - Form Elements')
                            ->description('Test basic form inputs and styling')
                            ->collapsible()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->placeholder('Enter your name')
                                    ->required()
                                    ->live(),

                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->placeholder('Enter your email')
                                    ->required(),

                                Select::make('color')
                                    ->label('Favorite Color')
                                    ->options([
                                        'red'    => 'Red',
                                        'blue'   => 'Blue',
                                        'green'  => 'Green',
                                        'yellow' => 'Yellow',
                                        'purple' => 'Purple',
                                    ])
                                    ->native(false),

                                Checkbox::make('subscribe')
                                    ->label('Subscribe to updates'),

                                Toggle::make('notifications')
                                    ->label('Enable notifications'),

                                ColorPicker::make('brand_color')
                                    ->label('Brand Color')
                                    ->default('#3b82f6'),
                            ])->columnSpan(1),

                        Section::make('Column 2 - More Elements')
                            ->description('Test additional form components')
                            ->collapsible()
                            ->schema([
                                Textarea::make('bio')
                                    ->label('Bio')
                                    ->placeholder('Tell us about yourself')
                                    ->rows(5),

                                Select::make('role')
                                    ->label('User Role')
                                    ->options([
                                        'admin'     => 'Administrator',
                                        'user'      => 'User',
                                        'moderator' => 'Moderator',
                                        'guest'     => 'Guest',
                                    ])
                                    ->native(false),

                                TextInput::make('website')
                                    ->label('Website URL')
                                    ->url()
                                    ->placeholder('https://example.com'),

                                Toggle::make('public_profile')
                                    ->label('Make profile public'),

                                Checkbox::make('accept_terms')
                                    ->label('I accept the terms and conditions'),
                            ])->columnSpan(1),
                    ]),

                Section::make('Tabs Example')
                    ->description('Test tabbed interface styling')
                    ->collapsible()
                    ->collapsed(false)
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tab::make('Tab 1')
                                    ->schema([
                                        TextInput::make('tab1_field')
                                            ->label('Tab 1 Field')
                                            ->placeholder('Enter something'),
                                    ]),

                                Tab::make('Tab 2')
                                    ->schema([
                                        Textarea::make('tab2_content')
                                            ->label('Tab 2 Content')
                                            ->placeholder('Enter your content'),
                                    ]),

                                Tab::make('Tab 3')
                                    ->schema([
                                        Select::make('tab3_select')
                                            ->label('Tab 3 Select')
                                            ->options([
                                                'option1' => 'Option 1',
                                                'option2' => 'Option 2',
                                                'option3' => 'Option 3',
                                            ]),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }
}
