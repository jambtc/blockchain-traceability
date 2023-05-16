<?php

namespace app\controllers;

use Yii;
use app\models\Lots;
use app\models\LotsHash;
use app\models\search\LotsSearch;
use app\models\search\LotsHashSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\languageSwitcher;
use yii\httpclient\Client;
use yii\helpers\Json;


/**
 * LotsController implements the CRUD actions for Lots model.
 */
class ShowcaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'validate' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
	{
        $this->enableCsrfValidation = false;
    	languageSwitcher::init();
        return parent::beforeAction($action);
	}


    /**
     * Displays a single Lots model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndex($id)
    {
        $this->layout = 'landing-page';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*
    [blockHash] => 0x80d5ceb9d3fa7b383659a7814be607f1b210b136130d0d981514846372582d97
    [blockNumber] => 0x5f9f00
    [from] => 0xfe3b557e8fb62b89f4916b721be55ceb828dbd73
    [gas] => 0x200b20
    [gasPrice] => 0x31303030
    [hash] => 0xb4e7e5d2f52f96100d1919f01c1ac31823fe2f5c98e5bc92802045183f746560
    [input] => 0xc9fd45b81344e685221df7451782f302b1716321b81476d53c3b31f6742c1203
    [nonce] => 0x74
    [to] => 0xfe3b557e8fb62b89f4916b721be55ceb828dbd73
    [transactionIndex] => 0x0
    [value] => 0x1
    [v] => 0xfe7
    [r] => 0x9b8c32f45f00d09292fd1e2c7e03ac2e414087c6cea2a1eddb9cc38be8b9237
    [s] => 0x2ee36b719e5d6882484f3229e5b2aca0621614fac5ad33b07eca56fa5fa4a5ef
    */

    public function actionValidate()
    {
        $model = $this->findModel($_POST['id']);

        $ERC20 = new Yii::$app->Erc20(1);

        try {
            // recupero la ricevuta della transazione tramite txhash
            $receipt = $ERC20->getReceipt($model->txhash);
            
        } catch (Exception $e) {
            echo "<pre>" . print_r($e, true) . "</pre>";
            exit;
        }

        $validate = 2;
        $response = null;
        if (isset($receipt->blockHash)) {
            try {
                // recupero la ricevuta della transazione tramite txhash
                $blockByHash = $ERC20->getBlockByHash($receipt->blockHash);
            } catch (Exception $e) {
                echo "<pre>" . print_r($e, true) . "</pre>";
                exit;
            }
    
            if (isset($blockByHash->transactions)){
    
                $transactions = $blockByHash->transactions;
        
                $input = null;
                foreach ($transactions as $transaction)
                {
                    if ($transaction->hash == $model->txhash){
                        $input = $transaction->input;
                        $response = $transaction;
                        break;
                    }
                }
                $text = substr($input,2);
        
                if ($text === $model->hash){
                    $validate = 1;
                }
            }
        }


        

        // echo '<pre>'.print_r($receipt,true);
        // echo '<pre>'.print_r($blockByHash,true);
        // echo '<pre>'.print_r($transactions,true);
        // echo '<pre>'.print_r($input,true);
        // echo '<pre>'.print_r($text,true);
        // exit;

        return $this->renderAjax('_validate', [
            'response' => $response,
            'validate' => $validate
        ]);

    }


    /**
     * Finds the Lots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lots the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LotsHash::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
