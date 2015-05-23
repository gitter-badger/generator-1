<?php
/**
 *
 *
 *
 *
 */

namespace Cotya\Generator\Definition;

use Cotya\Generator;

class Parser
{
    protected $definition;
    
    protected $definitionBaseDir;

    public function __construct($definitionFilePath)
    {
        $this->definitionBaseDir = dirname($definitionFilePath);
        $this->definition = simplexml_load_file($definitionFilePath);
    }

    /**
     * @return Model[]
     */
    public function getModelDefinitions()
    {
        $modelDefinitions = [];
        foreach ($this->definition->models->children() as $modelDefinitionFileElement) {
            $modelDefinitionFilePath =
                $this->definitionBaseDir.'/'.$modelDefinitionFileElement->attributes()['filename'];
            $modelDefinitionFile = simplexml_load_file($modelDefinitionFilePath);
            $classname = (string) $modelDefinitionFile->children()[0]->attributes()['name'];
            $modelDefinition = new Model($classname, $this->getModuleDefinition());
            $modelDefinitions[] = $modelDefinition;
        }
        
        
        return $modelDefinitions;
    }

    /**
     * @return Generator\Magento\Model[]
     */
    public function getMagentoModelDefinitions()
    {
        $modelDefinitions = [];
        foreach ($this->definition->models->children() as $modelDefinitionFileElement) {
            $modelDefinitionFilePath =
                $this->definitionBaseDir.'/'.$modelDefinitionFileElement->attributes()['filename'];
            $modelDefinitionFile = simplexml_load_file($modelDefinitionFilePath);
            $classname = (string) $modelDefinitionFile->children()[0]->attributes()['name'];

            $modelDefinition = new Model(
                $classname
            );
            $magentoModelDefinition = new Generator\Magento\Model(
                $modelDefinition,
                $this->getModuleDefinition(),
                (string) $modelDefinitionFile->children()[0]->id->attributes()['column']
            );
            
            $modelDefinitions[] = $magentoModelDefinition;
        }


        return $modelDefinitions;
    }
    
    private function getModuleDefinition()
    {
        return new Module(
            (string)$this->definition->moduleName,
            (string)$this->definition->vendorName
        );
    }
}
