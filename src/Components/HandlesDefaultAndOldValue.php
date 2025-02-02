<?php

namespace ProtoneMedia\LaravelFormComponents\Components;

trait HandlesDefaultAndOldValue
{
    use HandlesBoundValues;

    private function setValue(
        string $name,
        $bind = null,
        $default = null,
        $language = null
    ) {
        if ($this->isWired()) {
            return;
        }

        $inputName = static::convertBracketsToDots($name);

        if (!$language) {
            // Don't use ?:, else a value of 0 will return default as it's falsy
            $default = $this->getBoundValue($bind, $name) ?? $default;

            return $this->value = old($inputName, $default);
        }

        if ($bind !== false) {
            $bind = $bind ?: $this->getBoundTarget();
        }

        if ($bind) {
            $default = $bind->getTranslation($name, $language, false) ?: $default;
        }

        $this->value = old("{$inputName}.{$language}", $default);
    }
}
