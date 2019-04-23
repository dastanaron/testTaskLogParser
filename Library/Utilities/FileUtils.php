<?php


namespace Library\Utilities;

/**
 * Class FileUtils
 * @package Library\Utilities
 */
class FileUtils
{
    /**
     * @var StringUtils
     */
    protected $filePath;

    /**
     * @var resource
     */
    protected $resource;

    /**
     * FileUtils constructor.
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        if(file_exists($filePath)) {
            $this->filePath = $filePath;
            $this->openFile('r');
        }
        else {
            throw new \InvalidArgumentException('file is not exists');
        }
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function openFile(string $mode = 'r') : self
    {
        $this->resource = fopen($this->filePath, $mode);
        return $this;
    }

    /**
     * @return bool
     */
    public function closeFile() : bool
    {
        return fclose($this->resource);
    }

    /**
     * @return StringUtils
     */
    public function getFilePath() : string
    {
        return $this->filePath;
    }

    /**
     * @param int $stringLength
     * @return \Generator
     */
    public function readFileByLine(int $stringLength = 1024) : \Generator
    {
        /*
         * Я читал в вашем документе, что нельзя использовать результат присвоения, в качестве проверки, но как сделать иначе,
         * я не знаю. Я бы мог отдельно присвоить, но тогда будет всегда считываться одна и та же строка.
         */
        while (($string = fgets($this->resource, $stringLength)) !== false) {
            yield $string;
        }
    }

    /**
     * FileUtils destructor
     */
    public function __destruct()
    {
        return $this->closeFile();
    }
}