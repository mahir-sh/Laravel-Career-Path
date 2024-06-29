<?php

require_once 'expansemanager.php';
require_once 'expanse.php';

$transactions = new expansemanager();


function displayMenu() {
    echo "\n1. Add income\n";
    echo "2. Add expense\n";
    echo "3. View incomes\n";
    echo "4. View expenses\n";
    echo "5. View savings\n";
    echo "6. View categories\n";
    echo "Enter your option: ";
}

while (true) {
    displayMenu();
    $option = trim(fgets(STDIN));

    switch ($option) {
        case 1:
            echo "Enter income amount: ";
            $amount = trim(fgets(STDIN));
            echo "Enter income category: ";
            $category = trim(fgets(STDIN));
            $transactions->addTransaction($amount, $category, 'income');
            break;
        case 2:
            echo "Enter expense amount: ";
            $amount = trim(fgets(STDIN));
            echo "Enter expense category: ";
            $category = trim(fgets(STDIN));
            $transactions->addTransaction($amount, $category, 'expense');
            break;
        case 3:
            $transactions->viewTransactions('income');
            break;
        case 4:
            $transactions->viewTransactions('expense');
            
            break;
        case 5:
            $transactions->viewSavings();
            break;
        case 6:
            $transactions->viewCategories();
            break;
        default:
            echo "Invalid option. Please try again.\n";
            break;
    }
}
