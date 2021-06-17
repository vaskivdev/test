<?php
    
use App\Http\HttpState;
use App\Grid\DefaultConfig;
use App\Grid\HtmlDataGrid;
use App\Grid\Twig;
    
require dirname(__DIR__).'/vendor/autoload.php';

const DEFAULT_LIMIT = 9;

$rows = json_decode(file_get_contents("data.json"), true);
if ($rows == null) {
    echo Twig::renderTwig('error.html.twig', [
        'message' => "Bład krytyczny - Błędny format pliku .json"
    ]);
    exit;
}

try {
    $state = HttpState::create();

    $dataGrid = new HtmlDataGrid();
    $config = (new DefaultConfig())
        ->addIntColumn('id', 'ID')
        ->addTextColumn('name', 'Name')
        ->addIntColumn('age', 'Age')
        ->addTextColumn('company', 'Company')
        ->addCurrencyColumn('balance', 'Balance', 'USD')
        ->addTextColumn('phone', 'Phone')
        ->addTextColumn('email', 'Email');

    echo $dataGrid->withConfig($config)->render($rows, $state);
} catch (\Exception $e) {
    echo Twig::renderTwig('error.html.twig', [
        'message' => "Bład krytyczny - " . $e->getMessage()
    ]);
    exit;
} catch (\Throwable $e) { // For PHP 7
    echo Twig::renderTwig('error.html.twig', [
        'message' => "Bład krytyczny - " . $e->getMessage()
    ]);
    exit;
}