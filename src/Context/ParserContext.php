<?php
class ParserContext {
    private $parser;

    public function __construct(ParserInterface $parser) {
        $this->parser = $parser;
    }

    public function parse($filePath) {
        return $this->parser->parse($filePath);
    }
}
?>
