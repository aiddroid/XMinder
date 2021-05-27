<?php


namespace sinri\XMindWriter\XMapContent;


use sinri\XMindWriter\core\XMapNodeEntity;
use XMLWriter;

class XMapContentEntity extends XMapNodeEntity
{
    protected $attrVersion;
    /**
     * @var XMapContentSheetEntity[] [1,n) the sheets of this workbook
     */
    protected $sheetList;

    public function __construct($version = '2.0')
    {
        $this->attrVersion = $version;
        $this->sheetList = [];
    }

    /**
     * @param XMapContentSheetEntity $sheet
     * @return XMapContentEntity
     */
    public function addSheet(XMapContentSheetEntity $sheet): XMapContentEntity
    {
        $this->sheetList[] = $sheet;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttrVersion(): string
    {
        return $this->attrVersion;
    }

    /**
     * @param string $attrVersion
     * @return XMapContentEntity
     */
    public function setAttrVersion(string $attrVersion): XMapContentEntity
    {
        $this->attrVersion = $attrVersion;
        return $this;
    }

    /**
     * @return XMapContentSheetEntity[]
     */
    public function getSheetList(): array
    {
        return $this->sheetList;
    }

    /**
     * @param XMapContentSheetEntity[] $sheetList
     * @return XMapContentEntity
     */
    public function setSheetList(array $sheetList): XMapContentEntity
    {
        $this->sheetList = $sheetList;
        return $this;
    }

    protected function nodeTag(): string
    {
        return "xmap-content";
    }

    /**
     * @param XMLWriter $xmlWriter
     */
    protected function writeThisNode(XMLWriter $xmlWriter)
    {
        $xmlWriter->startElement($this->nodeTag());
        $xmlWriter->writeAttribute('xmlns', "urn:xmind:xmap:xmlns:content:2.0");
        $xmlWriter->writeAttribute('version', $this->attrVersion);

        foreach ($this->sheetList as $sheetEntity) {
            self::writeThatNode($xmlWriter, $sheetEntity);
        }

        $xmlWriter->endElement();
    }
}