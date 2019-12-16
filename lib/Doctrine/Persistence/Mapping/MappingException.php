<?php

declare(strict_types=1);

namespace Doctrine\Persistence\Mapping;

use Exception;
use function implode;
use function sprintf;

/**
 * A MappingException indicates that something is wrong with the mapping setup.
 */
class MappingException extends Exception
{
    /**
     * @param array<int, string> $namespaces
     *
     * @return self
     */
    public static function classNotFoundInNamespaces(
        string $className,
        array $namespaces
    ) {
        return new self(sprintf(
            "The class '%s' was not found in the chain configured namespaces %s",
            $className,
            implode(', ', $namespaces)
        ));
    }

    /**
     * @return self
     */
    public static function pathRequired()
    {
        return new self('Specifying the paths to your entities is required ' .
            'in the AnnotationDriver to retrieve all class names.');
    }

    /**
     * @return self
     */
    public static function fileMappingDriversRequireConfiguredDirectoryPath(
        ?string $path = null
    ) {
        if ($path !== null) {
            $path = '[' . $path . ']';
        }

        return new self(sprintf(
            'File mapping drivers must have a valid directory path, ' .
            'however the given path %s seems to be incorrect!',
            $path
        ));
    }

    /**
     * @return self
     */
    public static function mappingFileNotFound(string $entityName, string $fileName)
    {
        return new self(sprintf(
            "No mapping file found named '%s' for class '%s'.",
            $fileName,
            $entityName
        ));
    }

    /**
     * @return self
     */
    public static function invalidMappingFile(string $entityName, string $fileName)
    {
        return new self(sprintf(
            "Invalid mapping file '%s' for class '%s'.",
            $fileName,
            $entityName
        ));
    }

    /**
     * @return self
     */
    public static function nonExistingClass(string $className)
    {
        return new self(sprintf("Class '%s' does not exist", $className));
    }
}
