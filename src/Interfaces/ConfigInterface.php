<?php

namespace App\Interfaces;

interface ConfigInterface
{
    /**
     * Dodaje nową kolumną do DataGrid.
     */
    public function addColumn(string $key, ColumnInterface $column): ConfigInterface;

    /**
     * Zwraca wszystkie kolumny dla danego DataGrid.
     */
    public function getColumns(): array;
}
