<?php

namespace App\Interfaces;
    
interface ColumnInterface
{
    /**
     * Zmienia tytuł kolumny, który będzie widoczny jako nagłówek.
     */
    public function withLabel(string $label): ColumnInterface;

    public function getLabel(): string;

    /**
     * Ustawia typ danych dla kolumny.
     */
    public function withDataType(DataTypeInterface $dataType): ColumnInterface;

    public function getDataType(): DataTypeInterface;

    /**
     * Ustawienie wyrównania treści znajdujących się w kolumnie.
     */
    public function withAlign(string $align): ColumnInterface;

    public function getAlign(): string;
}
