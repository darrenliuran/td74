<?php

namespace backend\controllers;

use backend\models\area\AreaModel;
use yii;
use yii\web\UploadedFile;

/**
 * DefaultController.php file
 * 首页
 * User: LiuRan
 * Date: 2016/5/9 0009
 * Time: 下午 3:53
 */
class DefaultController extends \backend\components\controllers\BKController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 导入城区
     */
    public function actionImportArea()
    {
        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstanceByName('import-area'); //获取上传的文件实例

            if (!is_object($file) || (strpos($file->type, 'spreadsheetml.sheet') === FALSE && strpos($file->type, 'excel') === FALSE))
            {
                echo 'error';exit;
            }

            // 读取exexl文件
            $excelReader = new \PHPExcel_Reader_Excel2007();
            $phpexcel = $excelReader->load($file->tempName)->getSheet(0);

            $importList = [];
            $allRow = $phpexcel->getHighestRow();

            for ($j = 2; $j <= $allRow; $j++)
            {
                $provinceData[(string)$phpexcel->getCell('A'.$j)->getValue()] = str_replace(' ', ' ', trim($phpexcel->getCell('B'.$j)->getValue(), ' '));

                $cityData[(string)$phpexcel->getCell('C'.$j)->getValue()] = str_replace(' ', ' ', trim($phpexcel->getCell('D'.$j)->getValue(), ' '));

                $countryData[(string)$phpexcel->getCell('E'.$j)->getValue()] = str_replace(' ', ' ', trim($phpexcel->getCell('F'.$j)->getValue(), ' '));
            }

//            foreach ($provinceData as $key => $name)
//            {
//                $areaModel = new AreaModel();
//
//                $areaModel->attributes = [
//                    'name' => $name,
//                    'code' => $key.'0000000000'
//                ];
//                $areaModel->save();
//            }

//            $provinceList = AreaModel::find()->where('parent_id = 0')->asArray()->all();
//
//            foreach ($provinceList as $province)
//            {
//                $provinceCode = substr($province['code'], 0 ,2);
//
//                foreach ($cityData as $key => $name)
//                {
//                    $provinceIndex = substr($key, 0 ,2);
//
//                    if ($provinceIndex == $provinceCode)
//                    {
//                        $areaModel = new AreaModel();
//
//                        $areaModel->attributes = [
//                            'parent_id' => $province['id'],
//                            'name' => $name,
//                            'code' => $key,
//                            'level' => 2
//                        ];
//                        $areaModel->save();
//                    }
//                }
//            }

//            $cityList = AreaModel::find()->where('level = 2')->asArray()->all();
//
//            foreach ($cityList as $city)
//            {
//                $cityCode = substr($city['code'], 0 ,4);
//
//                foreach ($countryData as $key => $name)
//                {
//                    $cityIndex = substr($key, 0 ,4);
//
//                    if ($cityCode == $cityIndex)
//                    {
//                        $areaModel = new AreaModel();
//
//                        $areaModel->attributes = [
//                            'parent_id' => $city['id'],
//                            'name' => $name,
//                            'code' => $key,
//                            'level' => 3
//                        ];
//                        $areaModel->save();
//                    }
//                }
//            }
        }

        return $this->render('importArea', [

        ]);
    }
}