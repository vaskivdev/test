<?php

namespace App\Http;

class HttpState
{
    public static function create(): State
    {
        $state = new State();
        $state->currentPage = self::getCurrentPage();
        $state->orderBy = self::getOrderBy();
        $state->order = self::getOrder();
        $state->rowsPerPage = self::getRowsPerPage();
        
        return $state;
    }

    private static function getCurrentPage(): int
    {
        if (key_exists('page', $_GET)) {
            $page = (int)$_GET['page'];
            if ($page >= 1) {
                return $page;
            }
            return 1;
        }
        return 1;
    }

    private static function getOrderBy(): ?string
    {
        if (key_exists('orderBy', $_GET)) {
            return $_GET['orderBy'];
        }
        return '';
    }

    private static function getOrder(): string
    {
        if (key_exists('order', $_GET)) {
            return ($_GET['order'] == 'desc') ? 'desc' : 'asc';
        }
        return 'asc';
    }
    
    private static function getRowsPerPage(): int
    {
        if (key_exists('limit', $_GET)) {
            $limit = (int)$_GET['limit'];
            if ($limit >= 1) {
                return $limit;
            }
            return DEFAULT_LIMIT;
        }
        return DEFAULT_LIMIT;
    }
}
