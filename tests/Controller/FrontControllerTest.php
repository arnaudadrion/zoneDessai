<?php

namespace App\Tests\Controller;

use App\Entity\Features;
use App\Repository\FeaturesRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $featureRepository = static::getContainer()->get(FeaturesRepository::class);

        $features = $featureRepository->findAll();

        $this->assertContainsOnly(Features::class, $features);
        $this->assertCount(5, $features);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Test & Show');
    }
}
