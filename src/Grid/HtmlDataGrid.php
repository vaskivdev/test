<?php

namespace App\Grid;

use App\Interfaces\DataGridInterface;
use App\Interfaces\StateInterface;
use App\Interfaces\ConfigInterface;
use App\Grid\Twig;
use App\Grid\Row;
use App\Grid\Cell;

final class HtmlDataGrid implements DataGridInterface
{
    private $config;
    
    public function withConfig(ConfigInterface $config): HtmlDataGrid
    {
        $this->config = $config;
        
        return $this;
    }
    
    public function render(array $rows, StateInterface $state): string
    {
        $this->sortRows($rows, $state);
        $paginated = $this->paginate($rows, $state);
        
        return Twig::renderTwig('index.html.twig', [
            'columns' => $this->config->getColumns(),
            'paginated' => $paginated,
            'orderBy' => $state->getOrderBy(),
            'isDesc' => $state->isOrderDesc()
        ]);
    }
    
    private function sortRows(array &$rows, StateInterface $state): void
    {
        $key = $state->getOrderBy();
        $isDesc = $state->isOrderDesc();
        
        if (strlen($key) > 0 && key_exists($key, $this->config->getColumns())) {
            usort($rows, function ($item1, $item2) use ($key, $isDesc) {
                if (!key_exists($key, $item1) || !key_exists($key, $item2)) {
                    return false;
                }
                
                if ($isDesc) {
                    return $item2[$key] <=> $item1[$key];
                } else {
                    return $item1[$key] <=> $item2[$key];
                }
            });
        }
    }
    
    private function paginate(array $rows, StateInterface $state): array
    {
        $total = count($rows);
        $page = $state->getCurrentPage();
        $limit = $state->getRowsPerPage();
        $totalPages = ceil($total/$limit);
        $page = max($page, 1);
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $limit;
        if ($offset < 0) {
            $offset = 0;
        }
        $rows = array_slice($rows, $offset, $limit);
        
        //przekształcenie danych do obiektów i walidacja po podzieleniu na podstrony, 
        //ponieważ nie musimy walidować wszystkie dane, które nie wyświetlane, żeby dodatkowo nie obciążać skrypt
        $items = [];
        foreach ($rows as $row) {
            $rowItem = new Row();
            
            foreach ($this->config->getColumns() as $key => $column) {
                if (key_exists($key, $row)) {
                    $cellItem = new Cell($row[$key], $column);
                } else {
                    $cellItem = new Cell(null, $column);
                }
                $rowItem->addCell($key, $cellItem);
            }
            
            $items[] = $rowItem;
        }
        
        $pageRange = 5;
        $delta = \ceil($pageRange / 2);
        if ($page - $delta > $totalPages - $pageRange) {
            $pagesInRange = \range($totalPages - $pageRange + 1, $totalPages);
        } else {
            if ($page - $delta < 0) {
                $delta = $page;
            }

            $offset = $page - $delta;
            $pagesInRange = \range($offset + 1, $offset + $pageRange);
        }
        
        return [
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'limit' => $limit,
            'items' => $items,
            'pagesInRange' => $pagesInRange,
            'defaultLimit' => DEFAULT_LIMIT
        ];
    }
}
