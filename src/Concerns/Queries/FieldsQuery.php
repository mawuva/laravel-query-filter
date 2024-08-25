<?php

namespace Mawuva\QueryFilter\Concerns\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait FieldsQuery
{
    protected $availableFields;

    /**
     * List of fields selectable by default
     *
     * @var array
     */
    abstract protected function defaultFields(): array;

    /**
     * List of selectable fields
     *
     * @var array
     */
    abstract protected function selectableFields(): array;

    /**
     * Perform a search from query string.
     *
     * @return Builder
     */
    public function applyFieldQuery(): Builder
    {
        if (!empty($this ->defaultFields())) {
            $prependedFields = $this->prependFieldsWithTableName($this ->defaultFields(), $this ->getTableName());

            $this ->builder ->select($prependedFields);
        }

        else {
            $this ->builder ->select('*');
        }

        return $this ->builder;
    }

    protected function prependFieldsWithTableName(array $fields, string $tableName): array
    {
        return array_map(function ($field) use ($tableName) {
            return $this->prependField($field, $tableName);
        }, $fields);
    }

    protected function prependField(string $field, ?string $table = null): string
    {
        if (! $table) {
            $table = $this ->getTableName();
        }

        if (Str::contains($field, '.')) {
            return $field;
        }

        return "{$table}.{$field}";
    }

    public function getTableName()
    {
        return $this ->builder ->getModel()->getTable();
    }
}