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

use kartik\mpdf\Pdf;


/**
 * LotsController implements the CRUD actions for Lots model.
 */
class LotsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index','create','update','delete',
                            'view','googlemaps','weather','generate-transaction',
                            'print'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];

    }

    public function beforeAction($action)
	{
    	languageSwitcher::init();
        return parent::beforeAction($action);
	}

    public function actionWeather(){
        $lat = $_POST['data']['coords']['latitude'];
        $lng = $_POST['data']['coords']['longitude'];

        $client = new Client();
        //
        $url = 'https://api.openweathermap.org/data/2.5/weather?';
        //
        $get = [
            'lat' => $lat,
            'lon' => $lng,
            'appid' => Yii::$app->params['openweather_key']
        ];
		// generate the POST data string
		$data = http_build_query($get, '', '&');
        //
        $request = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url.$data)
            ->send();

        // echo '<pre>'.print_r($request->getContent(),true);exit;
        $content = $request->getContent();

        $data = Json::decode($content);

        return $this->renderAjax('_weather', [
            'cityid' => $data['id'],
            'weather' => $content,
        ]);
    }

    /*
    {
    "coord":
        {
            "lon":14.2363,
            "lat":40.8696
        },
    "weather":
        [
            {
                "id":801,
                "main":"Clouds",
                "description":"few clouds",
                "icon":"02n"
            }
        ],
    "base":"stations",
    "main":
        {
            "temp":288.54,
            "feels_like":287.88,
            "temp_min":288.15,
            "temp_max":289.15,
            "pressure":1014,
            "humidity":67
        },
    "visibility":10000,
    "wind":
        {
            "speed":2.57,
            "deg":230
        },
    "clouds":
        {
            "all":20
        },
    "dt":1621110236,
    "sys":
        {
            "type":1,
            "id":6802,
            "country":"IT",
            "sunrise":1621050340,
            "sunset":1621102400
        },
    "timezone":7200,
    "id":3168327,
    "name":"San Giacomo dei Capri",
    "cod":200
    }
    */

    public function actionGooglemaps(){
        // echo '<pre>'.print_r($_POST,true);exit;
        $lat = $_POST['data']['coords']['latitude'];
        $lng = $_POST['data']['coords']['longitude'];

        //$wheater = $this->getWheater($_POST['data']['coords']);
        $model = new Lots();

        return $this->renderAjax('_gmaps', [
                'lat' => $lat,
                'lng' => $lng,
                'model' => $model,
                //'wheater' => $wheater
        ]);
    }

    /**
     * Lists all Lots models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LotsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['date' => SORT_DESC];


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Lots model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPrint($id)
    {
        $model = LotsHash::findOne($id);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_print',['model'=>$model]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            //'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
             // set mPDF properties on the fly
            'options' => ['title' => $model->lot->title],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[$model->lot->title],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionGenerateTransaction($id)
    {
        $model = $this->findModel($id);

        // trasformo l'array in json
        $json = Json::encode($model->attributes);

        // genero hash del contenuto
        // $secretKey our application or user secret, $genuineData obtained from a reliable source
        $hashdata = Yii::$app->getSecurity()->hashData($json, Yii::$app->params['secret_hash_key']);
        $hash = substr($hashdata,0,-strlen($json));

        // genero la transazione con l'hash
        $ERC20 = new Yii::$app->Erc20(1);

        // registro l'hash sulla blockchain
        // Input string must be hexadecimal string
        $txhash = $ERC20->putHashOnBlockchain($hash);

        $lotsHash = new LotsHash;
        $lotsHash->lot_id = $model->id;
        $lotsHash->hash = $hash;
        $lotsHash->txhash = $txhash;
        $lotsHash->save();

        return $this->redirect(['view', 'id' => $model->id]);

    }


    /**
     * Creates a new Lots model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lots();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lots model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lots model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = Lots::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
