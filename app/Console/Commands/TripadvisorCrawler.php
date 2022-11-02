<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class TripadvisorCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tripadvisor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler Hanoi restaurant in Tripadvisor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $home = 'https://www.tripadvisor.com/Restaurants-g293924-Hanoi.html';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = "https://www.tripadvisor.com/Restaurants-g293924-Hanoi.html";
//        $url = "https://vnexpress.net/";
        $html = (new Client([
            'verify' => false,
            'timeout' => 30, // 30 seconds
            'headers' => [
                'content-type' => 'application/html'
                'User-Agent' => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36",
            ]
        ]))->get($url)
            ->getBody()->getContents();

        dd($html);
    }

    protected function getHtml(string $url): string
    {
        $html = (new Client([
            'verify' => false,
            'timeout' => 5, // 30 seconds
        ]))->get($url)
            ->getBody()->getContents();

        return $html;
    }

    protected function getRestaurants(){
        $html = $this->getHtml($this->home);

    }
}
