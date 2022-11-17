<?php

/** @var yii\web\View $this */

use app\models\Subject;
use app\models\SubjectSearch;
use app\models\UserHasSubject;
use co0lc0der\Lte3Widgets\CardWidget;
use co0lc0der\Lte3Widgets\CardToolsHelper;
use co0lc0der\Lte3Widgets\ProfileCardWidget;
use app\models\User as ModelsUser;
use yii\helpers\Html;
use webvimark\modules\UserManagement\models\User;



$this->title = 'My Yii Application';
$roles = ModelsUser::getRole(User::getCurrentUser()->id);
$role = $roles[0];

$subjectAmount = UserHasSubject::getCurrentSubjectAmount(User::getCurrentUser()->id);


?>
<div class="site-index">

    <div class="flex-container jumbotron text-center bg-transparent " style="display: flex;flex-direction: row; align-items: center; flex-wrap: wrap; justify-content: center; margin-bottom: 100px;">
        <div style="padding-left: 55px;padding-right: 55px;margin-left: 10px;margin-right: 10px;"> 

            <h1 class="display-4">Bienvenido!</h1>

            <p class="lead">Esta es la plataforma de cursos</p>

        </div>

    <?
        
        echo Html::beginTag('div', ['style' => 'margin-left: 80px;margin-right: 80px;']);

        ProfileCardWidget::begin([
            'name' => Yii::$app->user->identity->username,
            //TODO: Refinar la busqueda del rol principal del usuario
            // 'position' => $role['item_name'],
            'color' => 'info',
            'outline' => true,
            'rows' => [
                'Ongoing subjects' => [
                    count($subjectAmount),
                ],
                'Finished subjects'    => [
                    'No finished subjects at the time'
                ],
                'Pending Payments'    => ['3'],

            ],
        ]);


        ProfileCardWidget::end();

        echo Html::endTag('div');
        
    ?>
    </div>

    <div class="body-content">

        <div class="flex-container" style="display: flex;flex-direction: row; align-items: center; flex-wrap: wrap; justify-content: center; margin-bottom: 180px;">

            <?php

            $courses_2 = SubjectSearch::find()->all();

            if(!empty($courses_2)){
                foreach ($courses_2 as $key => $value) {

                    echo Html::beginTag('div', ['style' => 'margin: 10px; max-width: 380px;']);

                    CardWidget::begin([
                        'title' => $value->name,
                        'footer' => $value->price . ' $</br>' . Html::a('Ir al curso', ['/subject/view', 'id'=>$value->id], ['class'=>'btn btn-primary']) ,
                    ]);

                    echo $value->description;

                    CardWidget::end();

                    echo Html::endTag('div');
                }
            }
            
            ?>


        </div>

        <div class="row">

            <h3>Sobre Nosotros</h3>

            <div class="col-lg-4">
                <h2>Nuestros Cursos</h2>

                <p>Nuestros cursos son ideales para cualquier nivel de habilidad. 
                    Desde principiantes a personas mas avanzadas, todos pueden aprender 
                    algo nuevo a travez de alguno de nuestros cursos.</p>

                <p><?=Html::a('Cursos', ['/subject/index', 'id'=>$value->id], ['class'=>'btn btn-outline-secondary'])?></p>
            </div>
            <div class="col-lg-4">
                <h2>Nuestros Profesores</h2>

                <p>Nos enorgullece decir que nuestros profesores son algunos 
                    de los profesionales mas respetados de sus respectivas areas. 
                Nuestro proceso de seleccion es el tipico para la industria, 
                pero nos gusta mantener un estandar alto a la hora de elegir a quienes contratar.</p>

            </div>
            <div class="col-lg-4">
                <h2>Nuestros Alumnos</h2>

                <p>Nuestros alumnos pueden disfrutar de los mejores cursos al mejor precio. 
                    Nos gusta decir que cada dia, con la ayuda de cada uno de ellos, 
                    nos acercamos cada vez mas a ser una institucion prestigiosa pero a la vez accesible 
                    y sin ningun tipo de prejuicio. Todo el mundo puede tomar alguno de nuestros cursos.
                </p>

                <p>Proximamente estaremos habilitando un programa de becas, para que todos aquellos que no pueden acceder a nuestros puedan hacerlo</p>

            </div>
        </div> 

    </div>
</div>