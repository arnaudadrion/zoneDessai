<?php

namespace App\Services\XML;

use \DOMDocument;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DomCrawler\Crawler;

// classe pour ajouter des trans-unit de tras dans des fichier XML
// peut etre elargi pour ajouter des eleements a partir de templates
class XMLTranslation
{
    private DOMDocument $dom;

    private string $transchain;

    private string $locale;

    public function __construct(
        #[Autowire('%kernel.project_dir%/translations/')]
        private string $prefix
    )
    {
        $this->dom = new DOMDocument();
        $this->dom->preserveWhiteSpace = false;
        $this->dom->formatOutput = true;
    }


    public function openDocument($docName): void
    {
        if (!file_exists($this->prefix.$docName)) {
            $this->createNewDocument($docName);
        } else {
            $this->dom->load($this->prefix.$docName);
        }
    }

    public function addTranslation(Array $docsInfos, Array $toAdd): string
    {
        $this->transchain = $docsInfos['transchain'];
        foreach ($docsInfos['langs'] as $lang) {

            $file = explode('.', $this->transchain)[0];
            $docName = $file.'.'.$lang.'.'."xlf";
            $this->openDocument($docName);
            $this->addTransUnit($toAdd, $lang);

            $this->dom->save($this->prefix.$docName);
        }

        return $this->transchain;
    }

    public function addTransUnit(Array $toAdd, $lang): void
    {
        if (!$this->transUnitIdExist()) {
            $transUnit = $this->dom->createElement('trans-unit');
            $idAttr = $this->dom->createAttribute('id');
            $idAttr->value = $this->transchain;
            $resnameAttr = $this->dom->createAttribute('resname');
            $resnameAttr->value = $this->transchain;
            $transUnit->appendChild($idAttr);
            $transUnit->appendChild($resnameAttr);

            $source = $this->dom->createElement('source', $toAdd[$lang]['source']);
            $sourceLangAttr = $this->dom->createAttribute('xml:lang');
            $sourceLangAttr->value = 'fr';
            $source->appendChild($sourceLangAttr);

            $target = $this->dom->createElement('target', $toAdd[$lang]['target']);
            $targetLangAttr = $this->dom->createAttribute('xml:lang');
            $targetLangAttr->value = $lang;
            $target->appendChild($targetLangAttr);

            $transUnit->appendChild($source);
            $transUnit->appendChild($target);

            $transUnits = $this->dom->getElementsByTagName('trans-unit');
            $lastTransUnit = $transUnits->item($transUnits->count() - 1);

            $lastTransUnit->after($transUnit);
        } else {
            $this->transchain = $this->transchain.uniqid();
            $this->addTransUnit($toAdd, $lang);
        }
    }

    public function createNewDocument($docName): void
    {
        $array = explode('.', $docName);
        $this->dom->xmlVersion = '1.0';
        $this->dom->encoding = 'UTF-8';

        // Element xliff
        $xliff = $this->dom->createElement('xliff');
        $xlfVersion = $this->dom->createAttribute('version');
        $xlfVersion->value = "1.2";
        $xlfXmlns = $this->dom->createAttribute('xmlns');
        $xlfXmlns->value = "urn:oasis:names:tc:xliff:document:1.2";
        $xliff->appendChild($xlfVersion);
        $xliff->appendChild($xlfXmlns);

        // element file
        $file = $this->dom->createElement('file');
        $original = $this->dom->createAttribute('original');
        $original->value = $array[0];
        $source = $this->dom->createAttribute('source-language');
        $source->value = "fr";
        $target = $this->dom->createAttribute('target-language');
        $target->value = $array[1];
        $datatype = $this->dom->createAttribute('datatype');
        $datatype->value = "plaintext";
        $file->appendChild($original);
        $file->appendChild($source);
        $file->appendChild($target);
        $file->appendChild($datatype);
        $xliff->appendChild($file);

        // element body
        $body = $this->dom->createElement('body');
        $file->appendChild($body);

        $this->dom->append($xliff);
    }

    public function transUnitIdExist()
    {
        $transUnits = $this->dom->getElementsByTagName('trans-unit');

        foreach ($transUnits as $transUnit) {
            if ($transUnit->getAttribute('id') === $this->transchain) {
                return true;
            }
        }

        return false;
    }
}