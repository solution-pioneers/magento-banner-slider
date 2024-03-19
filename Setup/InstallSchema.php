<?php 

namespace SolutionPioneers\BannerSlider\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableNameBanner = $setup->getTable('solutionpioneers_bannerslider_banner');

        if($conn->isTableExists($tableNameBanner) != true){
            $table = $conn->newTable($tableNameBanner)
                ->addColumn(
                    'banner_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    '',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'is_active', 
                    Table::TYPE_SMALLINT, 
                    null, 
                    ['nullable' => false, 'default' => '1'] 
                )->addColumn(
                    'store_id',
                    Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'primary' => true]
                )->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    []
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    []
                )->setOption(
                    'charset',
                    'utf8'
                )->addForeignKey(
                    $setup->getFkName(
                        'solutionpioneers_bannerslider_banner', 
                        'store_id', 
                        'store', 
                        'store_id'
                    ),
                    'store_id',
                    $setup->getTable('store'),
                    'store_id', 
                    Table::ACTION_CASCADE
                );
            $conn->createTable($table);
        }

        $tableNameSlider = $setup->getTable('solutionpioneers_bannerslider_slider');

        if($conn->isTableExists($tableNameSlider) != true){
            $table = $conn->newTable($tableNameSlider)
                ->addColumn(
                    'slider_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )->addColumn(
                    'banner_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'primary' => true,]
                )->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'text',
                    Table::TYPE_TEXT,
                    '',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'mobile_image',
                    Table::TYPE_TEXT,
                    '255',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'button_text',
                    Table::TYPE_TEXT,
                    '',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'url',
                    Table::TYPE_TEXT,
                    '',
                    ['nullbale'=>false,'default'=>'']
                )->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    []
                )->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    []
                )->setOption(
                    'charset',
                    'utf8'
                )->addForeignKey(
                    $setup->getFkName(
                        'solutionpioneers_bannerslider_slider',
                        'banner_id',
                        'solutionpioneers_bannerslider_banner',
                        'banner_id'
                    ),
                    'banner_id',
                    $setup->getTable('solutionpioneers_bannerslider_banner'),
                    'banner_id',
                    Table::ACTION_CASCADE
                );
            $conn->createTable($table);
        }

        $setup->endSetup();
    }
}
?>