<?php

namespace Xefi\Faker\EnNz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnNz\Extensions\TextExtension;

final class TextExtensionTest extends TestCase
{
    protected array $paragraphs = [];

    protected function setUp(): void
    {
        parent::setUp();

        $textExtension = new TextExtension(new Randomizer());
        $this->paragraphs = (new ReflectionClass($textExtension))->getProperty('paragraphs')->getValue($textExtension);
    }

    public function testWords(): void
    {
        $sentences = array_merge(...$this->paragraphs);
        $words = array_merge(...$sentences);
        $result = $this->faker->words(count($words));

        $result = preg_split('/\s+/', $result);
        $words = array_map(function ($word) { return strtolower(preg_replace('/[.,]/', '', $word)); }, $words);

        $this->assertEqualsCanonicalizing(
            $words,
            $result
        );
    }

    public function testSentences(): void
    {
        $sentences = array_map(function ($sentence) { return implode(' ', $sentence); }, array_merge(...$this->paragraphs));

        for ($i = 0; $i < 20; $i++) {
            $this->assertContains($this->faker->sentences(1), $sentences);
        }
    }
}
