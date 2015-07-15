<?php 
namespace App\Shell;

use Cake\Console\Shell;

use Cake\Core\App;
use Cake\Core\Controller;
use App\Controller\AppController;
use App\Controller\CronController;

class SocialsShell extends Shell {
    public function main() {
        $cron = new CronController();
	    $cron->launch();
    }
}