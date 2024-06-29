<?php

require_once 'CategoryManager.php';
require_once 'TransactionManager.php';

class FinanceApp {
    private $categoryManager;
    private $transactionManager;

    public function __construct() {
        $this->categoryManager = new CategoryManager();
        $this->transactionManager = new TransactionManager($this->categoryManager);
    }

    public function run() {
        echo "=======================\n";
        echo "Welcome to Finance App!\n";
        echo "=======================\n";
        

        while (true) {
            echo "1. Add income\n";
            echo "2. Add expense \n";
            echo "3. View incomes\n";
            echo "4. View expenses\n";
            echo "5. View savings\n";
            echo "6. View categories \n";
            echo "7. Manage categories (view/create categories)\n";
            echo "0. Exit\n";
            echo "Enter your option: ";

            $option = trim(fgets(STDIN));

            if($option === 0) {
                break;
            }

            switch ($option) {
                case '1':
                    
                    $this->transactionManager->addIncome();
                    break;
                case '2':
                    $this->transactionManager->addExpense();
                    break;
                case '3':
                    $this->transactionManager->viewIncomes();
                    break;
                case '4':
                    $this->transactionManager->viewExpenses();
                    break;
                case '5':
                    $this->transactionManager->viewSavings();
                    break;
                case '6':
                    $this->transactionManager->viewCategoriesSummary();
                    break;
                case '7':
                    $this->categoryManager->manageCategories();
                    break;
                default:
                    echo "Invalid option.\n";
            }
        }
    }
}

$app = new FinanceApp();
$app->run();
