<?php

use App\Services\ComicService;
use PHPUnit\Framework\TestCase;

class ComicTest extends TestCase
{
    /**
     * @var \App\Services\ComicService
     */
    protected $comicService;

    /**
     * Set ComicService before test
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->comicService = new ComicService();
    }

    /**
     * @test
     */
    public function testFirstComicHasNoPreviousUrl()
    {
        $comic = $this->comicService->get(1);

        $this->assertEmpty($comic['previous']);
    }

    /**
     * @test
     */
    public function testLasComicHasNoNextUrl()
    {
        $comic = $this->comicService->get();

        $this->assertEmpty($comic['next']);
    }

    /**
     * @test
     * @runInSeparateProcess
     **/
    public function testRedirectToMainWhenComicGreaterThanCurrent()
    {
        $current = $this->comicService->getComicOfTheDay();

        $greater = $current['num'] + rand(1, 100);
        $this->comicService->get($greater);

        $this->assertContains('Location: /', xdebug_get_headers());
    }

    /**
     * @test
     * @runInSeparateProcess
     **/
    public function testRedirectToGreaterSuccesfullComicWhenNotFound()
    {
        $not_found_comic = 404;
        $this->comicService->get($not_found_comic);

        $greater = $not_found_comic + 1;

        $this->assertContains("Location: /comic/$greater", xdebug_get_headers());
    }
}
