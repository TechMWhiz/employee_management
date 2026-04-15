<?php
// Safe, minimal Filament stubs to help IDEs (Intelephense) without affecting runtime.

// Use eval to safely declare namespaced stub classes only when they're missing.
namespace Filament\Tables\Actions {
    if (! \class_exists(Action::class)) {
        class Action
        {
            public static function make(string $name = '')
            {
                return new self();
            }

            public function label(string $label)
            {
                return $this;
            }

            public function action(callable $callback)
            {
                return $this;
            }

            public function requiresConfirmation($value = true)
            {
                return $this;
            }

            public function color(string $color)
            {
                return $this;
            }

            public function visible($callback)
            {
                return $this;
            }
        }
    }
}

namespace Filament\Actions {
    if (! \class_exists(Action::class)) {
        class Action
        {
            public static function make(string $name = '')
            {
                return new self();
            }

            public function label(string $label)
            {
                return $this;
            }

            public function url(string $url)
            {
                return $this;
            }
        }

        class CreateAction extends Action {}
        class EditAction extends Action {}
        class DeleteAction extends Action {}
    }
}
